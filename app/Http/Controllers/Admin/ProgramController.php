<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ProgramController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $programs = Program::latest();

            return DataTables::of($programs)
                ->addIndexColumn()
                ->addColumn('action', function($program) {
                    return view('admin.programs.partials.action', compact('program'))->render();
                })
                ->addColumn('status_badge', function($program) {
                    $statusConfig = [
                        'draft' => ['color' => 'yellow', 'label' => 'Draft'],
                        'upcoming' => ['color' => 'blue', 'label' => 'Upcoming'],
                        'ongoing' => ['color' => 'green', 'label' => 'Ongoing'],
                        'completed' => ['color' => 'gray', 'label' => 'Completed']
                    ];

                    $config = $statusConfig[$program->status] ?? $statusConfig['draft'];
                    return "<span class='px-2 py-1 text-xs font-semibold rounded-full bg-{$config['color']}-100 text-{$config['color']}-800'>{$config['label']}</span>";
                })
                ->addColumn('platform_badge', function($program) {
                    $platformConfig = [
                        'cinema' => ['color' => 'purple', 'icon' => 'fas fa-film'],
                        'tv' => ['color' => 'red', 'icon' => 'fas fa-tv'],
                        'streaming' => ['color' => 'blue', 'icon' => 'fas fa-play-circle'],
                        'youtube' => ['color' => 'red', 'icon' => 'fab fa-youtube'],
                        'game' => ['color' => 'green', 'icon' => 'fas fa-gamepad'],
                        'ott' => ['color' => 'indigo', 'icon' => 'fas fa-tv'],
                        'digital' => ['color' => 'teal', 'icon' => 'fas fa-desktop'],
                        'podcast' => ['color' => 'pink', 'icon' => 'fas fa-podcast'],
                    ];

                    $config = $platformConfig[$program->platform] ?? $platformConfig['streaming'];
                    $label = ucfirst($program->platform);
                    return "<span class='inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-{$config['color']}-100 text-{$config['color']}-800'>
                                <i class='{$config['icon']} mr-1'></i> {$label}
                            </span>";
                })
                ->addColumn('thumbnail_preview', function($program) {
                    if ($program->thumbnail) {
                        return '<img src="' . asset('storage/' . $program->thumbnail) . '" class="w-16 h-16 object-cover rounded">';
                    }
                    return '<div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                <i class="fas fa-film text-gray-400"></i>
                            </div>';
                })
                ->addColumn('characters_list', function($program) {
                    if ($program->characters && is_array($program->characters)) {
                        $html = '<div class="flex flex-wrap gap-1">';
                        foreach (array_slice($program->characters, 0, 3) as $character) {
                            $html .= '<span class="px-2 py-1 text-xs bg-gray-100 text-gray-700 rounded">' . $character . '</span>';
                        }
                        if (count($program->characters) > 3) {
                            $html .= '<span class="px-2 py-1 text-xs bg-gray-200 text-gray-600 rounded">+' . (count($program->characters) - 3) . '</span>';
                        }
                        $html .= '</div>';
                        return $html;
                    }
                    return '-';
                })
                ->rawColumns(['action', 'status_badge', 'platform_badge', 'thumbnail_preview', 'characters_list'])
                ->make(true);
        }

        return view('admin.programs.index');
    }

    public function create()
    {
        $characters = Character::published()->get(['id', 'name', 'slug']);
        return view('admin.programs.create', compact('characters'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'synopsis' => 'nullable|string',
            // 'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'trailer' => 'nullable|mimes:mp4,mov,avi,wmv|max:10240',
            'platform' => 'required|in:cinema,tv,streaming,youtube,game,ott,digital,podcast',
            'status' => 'required|in:draft,upcoming,ongoing,completed',
            'release_date' => 'nullable|string|max:100',
            'duration' => 'nullable|string|max:50',
            'rating' => 'nullable|string|max:20',
            'director' => 'nullable|string|max:255',
            'budget' => 'nullable|string|max:100',
            'episodes' => 'nullable|integer|min:1',
            'views' => 'nullable|integer|min:0',
            'characters' => 'nullable|array',
            'characters.*' => 'string',
            'platforms' => 'nullable|array',
            'production' => 'nullable|array',
            'gallery' => 'nullable|array',
            'order' => 'nullable|integer',
        ]);

        // Handle file uploads
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('programs/thumbnails', 'public');
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('programs', 'public');
        }

        if ($request->hasFile('trailer')) {
            $validated['trailer'] = $request->file('trailer')->store('programs/trailers', 'public');
        }

        // Process JSON fields
        if ($request->has('platforms')) {
            $platforms = [];
            foreach ($request->input('platforms', []) as $index => $platform) {
                if (!empty($platform['name'])) {
                    $platforms[] = [
                        'name' => $platform['name'],
                        'type' => $platform['type'] ?? 'other',
                        'icon' => $platform['icon'] ?? 'fas fa-globe'
                    ];
                }
            }
            $validated['platforms'] = $platforms;
        }

        if ($request->has('production')) {
            $validated['production'] = [
                'studio' => $request->input('production.studio'),
                'timeline' => $request->input('production.timeline'),
                'locations' => $request->input('production.locations', []),
                'vfx' => $request->input('production.vfx')
            ];
        }

        if ($request->hasFile('gallery')) {
            $gallery = [];
            foreach ($request->file('gallery', []) as $image) {
                if ($image->isValid()) {
                    $path = $image->store('programs/gallery', 'public');
                    $gallery[] = [
                        'src' => $path,
                        'type' => 'image',
                        'caption' => pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)
                    ];
                }
            }
            if (!empty($gallery)) {
                $validated['gallery'] = $gallery;
            }
        }

        // Filter out empty characters
        if ($request->has('characters')) {
            $validated['characters'] = array_filter($request->input('characters', []));
        }

        // Generate slug
        $validated['slug'] = Str::slug($validated['title']);

        Program::create($validated);

        return redirect()->route('programs.index')
            ->with('success', 'Program berhasil ditambahkan.');
    }

    public function show(Program $program)
    {
        // Gunakan method baru getCharactersData()
        $characterList = $program->getCharactersData();

        return view('admin.programs.show', compact('program', 'characterList'));
    }

    public function edit(Program $program)
    {
        $characters = Character::published()->get(['id', 'name', 'slug']);
        return view('admin.programs.edit', compact('program', 'characters'));
    }

    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:programs,title,' . $program->id,
            'description' => 'nullable|string',
            'synopsis' => 'nullable|string',
            // 'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'trailer' => 'nullable|mimes:mp4,mov,avi,wmv|max:10240',
            'platform' => 'required|in:cinema,tv,streaming,youtube,game,ott,digital,podcast',
            'status' => 'required|in:draft,upcoming,ongoing,completed',
            'release_date' => 'nullable|string|max:100',
            'duration' => 'nullable|string|max:50',
            'rating' => 'nullable|string|max:20',
            'director' => 'nullable|string|max:255',
            'budget' => 'nullable|string|max:100',
            'episodes' => 'nullable|integer|min:1',
            'views' => 'nullable|integer|min:0',
            'characters' => 'nullable|array',
            'characters.*' => 'string',
            'platforms' => 'nullable|array',
            'production' => 'nullable|array',
            'gallery' => 'nullable|array',
            'order' => 'nullable|integer',
        ]);

        // Handle file uploads
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($program->thumbnail) {
                Storage::disk('public')->delete($program->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('programs/thumbnails', 'public');
        }

        if ($request->hasFile('image')) {
            if ($program->image) {
                Storage::disk('public')->delete($program->image);
            }
            $validated['image'] = $request->file('image')->store('programs', 'public');
        }

        if ($request->hasFile('trailer')) {
            if ($program->trailer) {
                Storage::disk('public')->delete($program->trailer);
            }
            $validated['trailer'] = $request->file('trailer')->store('programs/trailers', 'public');
        }

        // Process JSON fields
        if ($request->has('platforms')) {
            $platforms = [];
            foreach ($request->input('platforms', []) as $platform) {
                if (!empty($platform['name'])) {
                    $platforms[] = [
                        'name' => $platform['name'],
                        'type' => $platform['type'] ?? 'other',
                        'icon' => $platform['icon'] ?? 'fas fa-globe'
                    ];
                }
            }
            $validated['platforms'] = $platforms;
        }

        if ($request->has('production')) {
            $validated['production'] = [
                'studio' => $request->input('production.studio'),
                'timeline' => $request->input('production.timeline'),
                'locations' => $request->input('production.locations', []),
                'vfx' => $request->input('production.vfx')
            ];
        }

        // Handle gallery - append new images
        $existingGallery = $program->gallery ?? [];
        $newGallery = [];

        // Keep existing gallery items
        if ($request->has('existing_gallery')) {
            foreach ($request->input('existing_gallery', []) as $index => $keep) {
                if ($keep === 'keep' && isset($existingGallery[$index])) {
                    $newGallery[] = $existingGallery[$index];
                }
            }
        }

        // Add new gallery images
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery', []) as $image) {
                if ($image->isValid()) {
                    $path = $image->store('programs/gallery', 'public');
                    $newGallery[] = [
                        'src' => $path,
                        'type' => 'image',
                        'caption' => pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)
                    ];
                }
            }
        }

        if (!empty($newGallery)) {
            $validated['gallery'] = $newGallery;
        }

        // Filter out empty characters
        if ($request->has('characters')) {
            $validated['characters'] = array_filter($request->input('characters', []));
        }

        // Generate new slug if title changed
        if ($program->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $program->update($validated);

        return redirect()->route('programs.index')
            ->with('success', 'Program berhasil diperbarui.');
    }

    public function destroy(Program $program)
    {
        // Delete files
        if ($program->thumbnail) {
            Storage::disk('public')->delete($program->thumbnail);
        }
        if ($program->image) {
            Storage::disk('public')->delete($program->image);
        }
        if ($program->trailer) {
            Storage::disk('public')->delete($program->trailer);
        }

        // Delete gallery images
        if ($program->gallery && is_array($program->gallery)) {
            foreach ($program->gallery as $image) {
                if (isset($image['src'])) {
                    Storage::disk('public')->delete($image['src']);
                }
            }
        }

        $program->delete();

        return response()->json(['success' => 'Program berhasil dihapus.']);
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids');

        if (!$ids) {
            return response()->json(['error' => 'Tidak ada program yang dipilih.'], 400);
        }

        $programs = Program::whereIn('id', $ids)->get();

        foreach ($programs as $program) {
            // Delete files
            if ($program->thumbnail) {
                Storage::disk('public')->delete($program->thumbnail);
            }
            if ($program->image) {
                Storage::disk('public')->delete($program->image);
            }
            if ($program->trailer) {
                Storage::disk('public')->delete($program->trailer);
            }

            // Delete gallery images
            if ($program->gallery && is_array($program->gallery)) {
                foreach ($program->gallery as $image) {
                    if (isset($image['src'])) {
                        Storage::disk('public')->delete($image['src']);
                    }
                }
            }

            $program->delete();
        }

        return response()->json(['success' => 'Program berhasil dihapus.']);
    }
}
