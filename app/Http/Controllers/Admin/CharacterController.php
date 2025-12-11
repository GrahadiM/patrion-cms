<?php

namespace App\Http\Controllers\Admin;

use App\Models\Character;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class CharacterController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $characters = Character::latest();

            return DataTables::of($characters)
                ->addIndexColumn()
                ->addColumn('action', function($character) {
                    return view('admin.characters.partials.action', compact('character'))->render();
                })
                ->addColumn('status_badge', function($character) {
                    $status = $character->status === 'published' ? 'success' : 'warning';
                    $label = $character->status === 'published' ? 'Published' : 'Draft';
                    return "<span class='px-2 py-1 text-xs font-semibold rounded-full bg-{$status}-100 text-{$status}-800'>{$label}</span>";
                })
                ->addColumn('image_preview', function($character) {
                    if ($character->image) {
                        return '<img src="' . asset('storage/' . $character->image) . '" class="w-16 h-16 object-cover rounded">';
                    }
                    return '<div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>';
                })
                ->addColumn('colors_preview', function($character) {
                    if ($character->colors && is_array($character->colors)) {
                        $html = '<div class="flex space-x-1">';
                        foreach ($character->colors as $color) {
                            $html .= '<div class="w-6 h-6 rounded-full border border-gray-300" style="background-color: ' . $color . '"></div>';
                        }
                        $html .= '</div>';
                        return $html;
                    }
                    return '-';
                })
                ->rawColumns(['action', 'status_badge', 'image_preview', 'colors_preview'])
                ->make(true);
        }

        return view('admin.characters.index');
    }

    public function create()
    {
        return view('admin.characters.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:characters',
            'full_name' => 'nullable|string|max:255',
            'region' => 'nullable|string|max:255',
            'philosophy' => 'nullable|string',
            'height' => 'nullable|string|max:50',
            'weight' => 'nullable|string|max:50',
            'artifact' => 'nullable|string|max:255',
            'power' => 'nullable|string|max:255',
            'island' => 'nullable|string|max:255',
            'origin' => 'nullable|string|max:255',
            'dna' => 'nullable|string|max:255',
            'attitude' => 'nullable|string',
            'character' => 'nullable|string',
            'colors' => 'nullable|array',
            'colors.*' => 'string|regex:/^#[0-9A-F]{6}$/i',
            'color_names' => 'nullable|array',
            'color_names.*' => 'string|max:100',
            // 'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            // 'thumbnail' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            // 'video' => 'nullable|mimes:mp4,mov,avi,wmv|max:10240',
            'description' => 'nullable|string',
            'status' => 'required|in:draft,published',
        ]);

        // dd($request->all());

        // Handle file uploads
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('characters', 'public');
        }

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('characters/thumbnails', 'public');
        }

        if ($request->hasFile('video')) {
            $validated['video'] = $request->file('video')->store('characters/videos', 'public');
        }

        // Generate slug
        $validated['slug'] = Str::slug($validated['name']);

        Character::create($validated);

        return redirect()->route('characters.index')->with('success', 'Karakter berhasil ditambahkan.');
    }

    public function show(Character $character)
    {
        return view('admin.characters.show', compact('character'));
    }

    public function edit(Character $character)
    {
        return view('admin.characters.edit', compact('character'));
    }

    public function update(Request $request, Character $character)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:characters,name,' . $character->id,
            'full_name' => 'nullable|string|max:255',
            'region' => 'nullable|string|max:255',
            'philosophy' => 'nullable|string',
            'height' => 'nullable|string|max:50',
            'weight' => 'nullable|string|max:50',
            'artifact' => 'nullable|string|max:255',
            'power' => 'nullable|string|max:255',
            'island' => 'nullable|string|max:255',
            'origin' => 'nullable|string|max:255',
            'dna' => 'nullable|string|max:255',
            'attitude' => 'nullable|string',
            'character' => 'nullable|string',
            'colors' => 'nullable|array',
            'colors.*' => 'string|regex:/^#[0-9A-F]{6}$/i',
            'color_names' => 'nullable|array',
            'color_names.*' => 'string|max:100',
            // 'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            // 'thumbnail' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            // 'video' => 'nullable|mimes:mp4,mov,avi,wmv|max:10240',
            'description' => 'nullable|string',
            'status' => 'required|in:draft,published',
        ]);

        // Handle file uploads
        if ($request->hasFile('image')) {
            // Delete old image
            if ($character->image) {
                Storage::disk('public')->delete($character->image);
            }
            $validated['image'] = $request->file('image')->store('characters', 'public');
        }

        if ($request->hasFile('thumbnail')) {
            if ($character->thumbnail) {
                Storage::disk('public')->delete($character->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('characters/thumbnails', 'public');
        }

        if ($request->hasFile('video')) {
            if ($character->video) {
                Storage::disk('public')->delete($character->video);
            }
            $validated['video'] = $request->file('video')->store('characters/videos', 'public');
        }

        // Generate new slug if name changed
        if ($character->name !== $validated['name']) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $character->update($validated);

        return redirect()->route('characters.index')->with('success', 'Karakter berhasil diperbarui.');
    }

    public function destroy(Character $character)
    {
        // Delete files
        if ($character->image) {
            Storage::disk('public')->delete($character->image);
        }
        if ($character->thumbnail) {
            Storage::disk('public')->delete($character->thumbnail);
        }
        if ($character->video) {
            Storage::disk('public')->delete($character->video);
        }

        $character->delete();

        return response()->json(['success' => 'Karakter berhasil dihapus.']);
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids');

        if (!$ids) {
            return response()->json(['error' => 'Tidak ada karakter yang dipilih.'], 400);
        }

        $characters = Character::whereIn('id', $ids)->get();

        foreach ($characters as $character) {
            // Delete files
            if ($character->image) {
                Storage::disk('public')->delete($character->image);
            }
            if ($character->thumbnail) {
                Storage::disk('public')->delete($character->thumbnail);
            }
            if ($character->video) {
                Storage::disk('public')->delete($character->video);
            }

            $character->delete();
        }

        return response()->json(['success' => 'Karakter berhasil dihapus.']);
    }
}
