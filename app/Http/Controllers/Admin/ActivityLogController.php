<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
use App\Models\Character;
use App\Models\Program;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $activities = Activity::with('causer')->latest();

            return DataTables::of($activities)
                ->addIndexColumn()
                ->addColumn('time', function($activity) {
                    return $activity->created_at->format('d M Y H:i:s');
                })
                ->addColumn('user', function($activity) {
                    if ($activity->causer) {
                        return '<div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8">
                                        <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                            <span class="text-sm font-medium text-gray-700">' . substr($activity->causer->name, 0, 2) . '</span>
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">' . $activity->causer->name . '</p>
                                        <p class="text-xs text-gray-500">' . $activity->causer->email . '</p>
                                    </div>
                                </div>';
                    }
                    return '<span class="text-gray-500">System</span>';
                })
                ->addColumn('description', function($activity) {
                    return '<div>
                                <span class="font-medium text-gray-900">' . $activity->description . '</span>
                                <div class="text-xs text-gray-500">' . $activity->log_name . ' | ' . $activity->subject_type . '</div>
                            </div>';
                })
                ->addColumn('properties', function($activity) {
                    $properties = $activity->properties->count();
                    if ($properties > 0) {
                        return '<button onclick="showProperties(' . $activity->id . ')"
                                class="inline-flex items-center px-3 py-1 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
                                <i class="fas fa-eye mr-1"></i> Lihat (' . $properties . ')
                            </button>';
                    }
                    return '<span class="text-gray-400">-</span>';
                })
                ->addColumn('ip', function($activity) {
                    $ip = $activity->getExtraProperty('ip');
                    return $ip ? '<span class="text-xs font-mono bg-gray-100 px-2 py-1 rounded">' . $ip . '</span>' : '-';
                })
                ->addColumn('action', function($activity) {
                    return view('admin.activity-logs.partials.action', compact('activity'))->render();
                })
                ->rawColumns(['user', 'description', 'properties', 'ip', 'action'])
                ->make(true);
        }

        $stats = $this->getStats();
        return view('admin.activity-logs.index', compact('stats'));
    }

    public function show(Activity $activity)
    {
        $activity->load('causer');

        // Get subject model if available
        $subject = null;
        if ($activity->subject_type && $activity->subject_id) {
            $modelClass = $activity->subject_type;
            if (class_exists($modelClass)) {
                $subject = $modelClass::withTrashed()->find($activity->subject_id);
            }
        }

        return view('admin.activity-logs.show', compact('activity', 'subject'));
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();

        return response()->json([
            'success' => true,
            'message' => 'Log activity berhasil dihapus.'
        ]);
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids');

        if (!$ids) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada log yang dipilih.'
            ], 400);
        }

        Activity::whereIn('id', $ids)->delete();

        return response()->json([
            'success' => true,
            'message' => count($ids) . ' log berhasil dihapus.'
        ]);
    }

    public function clearAll(Request $request)
    {
        $days = $request->input('days', 30);
        $cutoffDate = now()->subDays($days);

        $count = Activity::where('created_at', '<', $cutoffDate)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Log activity yang lebih tua dari ' . $days . ' hari berhasil dihapus. (' . $count . ' log)'
        ]);
    }

    public function export(Request $request)
    {
        $format = $request->input('format', 'csv');
        $activities = Activity::with('causer')->latest()->get();

        $headers = [
            'Timestamp', 'User', 'Email', 'Description', 'Log Name',
            'Subject Type', 'Subject ID', 'IP Address', 'User Agent', 'Properties'
        ];

        $data = [];
        foreach ($activities as $activity) {
            $data[] = [
                $activity->created_at->format('Y-m-d H:i:s'),
                $activity->causer ? $activity->causer->name : 'System',
                $activity->causer ? $activity->causer->email : '',
                $activity->description,
                $activity->log_name,
                $activity->subject_type,
                $activity->subject_id,
                $activity->getExtraProperty('ip'),
                $activity->getExtraProperty('user_agent'),
                json_encode($activity->properties->toArray())
            ];
        }

        if ($format === 'csv') {
            return $this->exportToCsv($headers, $data);
        }

        return $this->exportToJson($activities);
    }

    private function getStats()
    {
        return [
            'total' => Activity::count(),
            'today' => Activity::whereDate('created_at', today())->count(),
            'users' => Activity::distinct('causer_id')->count('causer_id'),
            'characters' => Activity::where('log_name', 'characters')->count(),
            'programs' => Activity::where('log_name', 'programs')->count(),
            'users_activity' => Activity::where('log_name', 'users')->count(),
        ];
    }

    private function exportToCsv($headers, $data)
    {
        $filename = 'activity-logs-' . date('Y-m-d-H-i-s') . '.csv';

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

    private function exportToJson($activities)
    {
        $filename = 'activity-logs-' . date('Y-m-d-H-i-s') . '.json';

        header('Content-Type: application/json');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        echo json_encode($activities->toArray(), JSON_PRETTY_PRINT);
        exit;
    }
}
