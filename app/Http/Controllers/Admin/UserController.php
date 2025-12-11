<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Activitylog\Models\Activity;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::latest();

            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('action', function($user) {
                    return view('admin.users.partials.action', compact('user'))->render();
                })
                ->addColumn('status_badge', function($user) {
                    $status = $user->status === 'active' ? 'success' : 'danger';
                    $label = $user->status === 'active' ? 'Aktif' : 'Nonaktif';
                    $icon = $user->status === 'active' ? 'fa-check-circle' : 'fa-times-circle';
                    return "<span class='inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-{$status}-100 text-{$status}-800'>
                                <i class='fas {$icon} mr-1'></i> {$label}
                            </span>";
                })
                ->addColumn('photo_preview', function($user) {
                    if ($user->photo) {
                        return '<img src="' . asset('storage/' . $user->photo) . '" class="w-10 h-10 rounded-full object-cover">';
                    }
                    return '<div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>';
                })
                ->addColumn('email_verified', function($user) {
                    if ($user->email_verified_at) {
                        return '<span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    <i class="fas fa-check mr-1"></i> Verified
                                </span>';
                    }
                    return '<span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                <i class="fas fa-clock mr-1"></i> Pending
                            </span>';
                })
                ->addColumn('activity_count', function($user) {
                    $count = Activity::where('causer_id', $user->id)->count();
                    return '<a href="' . route('activity-logs.index', ['user_id' => $user->id]) . '"
                            class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 hover:bg-blue-200">
                            <i class="fas fa-history mr-1"></i> ' . $count . '
                        </a>';
                })
                ->rawColumns(['action', 'status_badge', 'photo_preview', 'email_verified', 'activity_count'])
                ->make(true);
        }

        $stats = $this->getStats();
        return view('admin.users.index', compact('stats'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:active,inactive',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Handle file upload
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('users', 'public');
        }

        // Hash password
        $validated['password'] = Hash::make($validated['password']);

        // Set email verification
        if ($request->has('verify_email')) {
            $validated['email_verified_at'] = now();
        }

        $user = User::create($validated);

        // Log activity
        activity()
            ->causedBy(auth()->user()->id)
            ->performedOn($user)
            ->withProperties(['ip' => $request->ip()])
            ->log('Created user');

        return redirect()->route('users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function show(User $user)
    {
        $user->load('activities');
        $recentActivities = $user->activities()->latest()->take(10)->get();
        $stats = $this->getUserStats($user);

        return view('admin.users.show', compact('user', 'recentActivities', 'stats'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:active,inactive',
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        $validated = $request->validate($rules);

        // Handle file upload
        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            $validated['photo'] = $request->file('photo')->store('users', 'public');
        }

        // Hash password if provided
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
            // Log activity
            activity()
                ->causedBy(auth()->user()->id)
                ->performedOn($user)
                ->withProperties(['ip' => $request->ip()])
                ->log('Updated password for user/'. $user->id);
        } else {
            unset($validated['password']);
        }

        // Handle email verification
        if ($request->has('verify_email') && !$user->email_verified_at) {
            $validated['email_verified_at'] = now();
        } elseif ($request->has('unverify_email') && $user->email_verified_at) {
            $validated['email_verified_at'] = null;
        }

        $user->update($validated);

        // Log activity
        activity()
            ->causedBy(auth()->user()->id)
            ->performedOn($user)
            ->withProperties(['ip' => $request->ip()])
            ->log('Updated user');

        return redirect()->route('users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        // Prevent deleting yourself
        if ($user->id === auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak dapat menghapus akun sendiri.'
            ], 403);
        }

        // Delete photo if exists
        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }

        $user->delete();

        // Log activity
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['deleted_user' => $user->id])
            ->log('Deleted user');

        return response()->json([
            'success' => true,
            'message' => 'User berhasil dihapus.'
        ]);
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids');

        if (!$ids) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada user yang dipilih.'
            ], 400);
        }

        // Prevent deleting yourself
        if (in_array(auth()->id(), $ids)) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak dapat menghapus akun sendiri.'
            ], 403);
        }

        $users = User::whereIn('id', $ids)->get();

        foreach ($users as $user) {
            // Delete photo if exists
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }

            $user->delete();

            // Log activity
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['deleted_user' => $user->id])
                ->log('Bulk deleted user');
        }

        return response()->json([
            'success' => true,
            'message' => count($ids) . ' user berhasil dihapus.'
        ]);
    }

    public function bulkStatus(Request $request)
    {
        $ids = $request->input('ids');
        $status = $request->input('status');

        if (!$ids) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada user yang dipilih.'
            ], 400);
        }

        User::whereIn('id', $ids)->update(['status' => $status]);

        // Log activity
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['user_ids' => $ids, 'status' => $status])
            ->log('Bulk updated user status');

        return response()->json([
            'success' => true,
            'message' => count($ids) . ' user berhasil diupdate statusnya.'
        ]);
    }

    public function export(Request $request)
    {
        $format = $request->input('format', 'csv');
        $users = User::latest()->get();

        $headers = [
            'ID', 'Name', 'Email', 'Phone', 'Status',
            'Email Verified', 'Created At', 'Updated At'
        ];

        $data = [];
        foreach ($users as $user) {
            $data[] = [
                $user->id,
                $user->name,
                $user->email,
                $user->phone ?? '',
                $user->status,
                $user->email_verified_at ? 'Yes' : 'No',
                $user->created_at->format('Y-m-d H:i:s'),
                $user->updated_at->format('Y-m-d H:i:s')
            ];
        }

        if ($format === 'csv') {
            return $this->exportToCsv($headers, $data, 'users');
        }

        return $this->exportToJson($users, 'users');
    }

    private function getStats()
    {
        return [
            'total' => User::count(),
            'active' => User::where('status', 'active')->count(),
            'inactive' => User::where('status', 'inactive')->count(),
            'verified' => User::whereNotNull('email_verified_at')->count(),
            'unverified' => User::whereNull('email_verified_at')->count(),
            'today' => User::whereDate('created_at', today())->count(),
        ];
    }

    private function getUserStats(User $user)
    {
        return [
            'total_activities' => Activity::where('causer_id', $user->id)->count(),
            'characters_created' => Activity::where('causer_id', $user->id)
                ->where('log_name', 'characters')
                ->where('description', 'like', '%created%')
                ->count(),
            'programs_created' => Activity::where('causer_id', $user->id)
                ->where('log_name', 'programs')
                ->where('description', 'like', '%created%')
                ->count(),
            'last_login' => Activity::where('causer_id', $user->id)
                ->where('description', 'like', '%logged%')
                ->latest()
                ->first()?->created_at,
            'login_count' => Activity::where('causer_id', $user->id)
                ->where('description', 'like', '%logged%')
                ->count(),
        ];
    }

    private function exportToCsv($headers, $data, $filename)
    {
        $filename = $filename . '-' . date('Y-m-d-H-i-s') . '.csv';

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');
        fputcsv($output, $headers);

        foreach ($data as $row) {
            fputcsv($output, $row);
        }

        fclose($output);
        exit;
    }

    private function exportToJson($data, $filename)
    {
        $filename = $filename . '-' . date('Y-m-d-H-i-s') . '.json';

        header('Content-Type: application/json');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        echo json_encode($data->toArray(), JSON_PRETTY_PRINT);
        exit;
    }
}
