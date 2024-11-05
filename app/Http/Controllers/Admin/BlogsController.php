<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Blog::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm py-2" data-id="' . $row->id . '">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm py-2" data-id="' . $row->id . '">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.media_content.press-releases');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'blog_title' => 'required|string|max:255',
            'blog_description' => 'required|string',
            'category' => 'required|string|max:255',
            'content_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        try {
            Log::info('Storing new blog data:', $request->all());

            // Handle cover image upload
            $coverImageName = null;
            if ($request->hasFile('cover_image')) {
                $timestamp = now()->format('dmy_His');
                $extension = $request->file('cover_image')->getClientOriginalExtension();
                $coverImageName = $timestamp . '.' . $extension;
                $request->file('cover_image')->storeAs('blogs', $coverImageName, 'public');
                Log::info('Cover image uploaded:', [$coverImageName]);
            }

            // Handle content images upload
            $contentImageNames = [];
            if ($request->hasFile('content_images')) {
                foreach ($request->file('content_images') as $image) {
                    $imageName = now()->format('dmy_His') . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('blogs/content', $imageName, 'public');
                    $contentImageNames[] = $imageName;
                    Log::info('Content image uploaded:', [$imageName]);
                }
            }

            // Create blog
            $blog = Blog::create([
                'cover_image' => $coverImageName,
                'blog_title' => $request->blog_title,
                'slug' => Str::slug($request->blog_title),
                'blog_description' => $request->blog_description,
                'category' => $request->category,
                'content_images' => json_encode($contentImageNames),
            ]);

            Log::info('Blog created successfully: ', $blog->toArray());

            return response()->json(['success' => 'Blog added successfully!']);
        } catch (\Exception $e) {
            Log::error('Blog creation failed: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to add blog.'], 500);
        }
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return response()->json($blog);
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        Log::info('Updating blog with ID: ' . $id);

        $request->validate([
            'blog_title' => 'sometimes|required|string|max:255',
            'blog_description' => 'sometimes|required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'category' => 'sometimes|required|string|max:255',
            'content_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'existing_images' => 'nullable|array',
            'existing_images.*' => 'string',
        ]);

        try {
            if ($request->hasFile('cover_image')) {
                Log::info('New cover image uploaded.');

                if ($blog->cover_image) {
                    Storage::disk('public')->delete('blogs/' . $blog->cover_image);
                    Log::info('Deleted old cover image: ' . $blog->cover_image);
                }

                $coverImageName = now()->format('dmy_His') . '.' . $request->cover_image->getClientOriginalExtension();
                $request->cover_image->storeAs('blogs', $coverImageName, 'public');
                $blog->cover_image = $coverImageName;
                Log::info('Stored new cover image: ' . $coverImageName);
            }

            if ($request->hasFile('content_images')) {
                Log::info('New content images uploaded.');

                $existingContentImages = json_decode($blog->content_images) ?? [];
                foreach ($existingContentImages as $existingImage) {
                    Storage::disk('public')->delete('blogs/content/' . $existingImage);
                    Log::info('Deleted existing content image: ' . $existingImage);
                }

                $contentImageNames = [];
                foreach ($request->file('content_images') as $image) {
                    $imageName = now()->format('dmy_His') . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('blogs/content', $imageName, 'public');
                    $contentImageNames[] = $imageName;
                    Log::info('Stored new content image: ' . $imageName);
                }
                $blog->content_images = json_encode($contentImageNames);
            } elseif ($request->has('existing_images')) {
                Log::info('Retaining existing images: ', $request->existing_images);
                $blog->content_images = json_encode($request->existing_images);
            }

            // Update other blog details
            if ($request->has('blog_title')) {
                $blog->blog_title = $request->blog_title;
                $blog->slug = Str::slug($request->blog_title);
                Log::info('Updated blog title: ' . $blog->blog_title);
            }
            if ($request->has('blog_description')) {
                $blog->blog_description = $request->blog_description;
                Log::info('Updated blog description.');
            }
            if ($request->has('category')) {
                $blog->category = $request->category;
                Log::info('Updated category: ' . $blog->category);
            }

            $blog->save();
            Log::info('Blog updated successfully.');

            return response()->json(['success' => 'Blog updated successfully!']);
        } catch (\Exception $e) {
            Log::error('Blog update failed: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to update blog.'], 500);
        }
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        if ($blog->cover_image) {
            Storage::disk('public')->delete('blogs/' . $blog->cover_image);
        }

        $existingContentImages = json_decode($blog->content_images) ?? [];
        foreach ($existingContentImages as $existingImage) {
            Storage::disk('public')->delete('blogs/content/' . $existingImage);
        }

        $blog->delete();
        return response()->json(['success' => 'Blog deleted successfully!']);
    }
}
