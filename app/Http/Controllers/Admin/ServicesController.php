<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServicesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Service::latest()->get();
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
        return view('admin.services_content.services');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'service_title' => 'required|string|max:255',
            'service_description' => 'required|string',
            'category' => 'required|string|max:255',
            'content_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            Log::info('Storing new service data:', $request->all());

            // Handle cover image upload
            $coverImageName = null;
            if ($request->hasFile('cover_image')) {
                $timestamp = now()->format('dmy_His');
                $extension = $request->file('cover_image')->getClientOriginalExtension();
                $coverImageName = $timestamp . '.' . $extension;
                $request->file('cover_image')->storeAs('services', $coverImageName, 'public');
                Log::info('Cover image uploaded:', [$coverImageName]);
            }

            // Handle content images upload
            $contentImageNames = [];
            if ($request->hasFile('content_images')) {
                foreach ($request->file('content_images') as $image) {
                    $imageName = now()->format('dmy_His') . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('services/content', $imageName, 'public');
                    $contentImageNames[] = $imageName;
                    Log::info('Content image uploaded:', [$imageName]);
                }
            }

            // Create service
            $service = Service::create([
                'cover_image' => $coverImageName,
                'service_title' => $request->service_title,
                'slug' => Str::slug($request->service_title),
                'service_description' => $request->service_description,
                'category' => $request->category,
                'content_images' => json_encode($contentImageNames),
            ]);

            Log::info('Service created successfully: ', $service->toArray());

            return response()->json(['success' => 'Service added successfully!']);
        } catch (\Exception $e) {
            Log::error('Service creation failed: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to add service.'], 500);
        }
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return response()->json($service);
    }

    public function update(Request $request, $id)
{
    $service = Service::findOrFail($id);
    Log::info('Updating service with ID: ' . $id);


    $request->validate([
        'service_title' => 'sometimes|required|string|max:255',
        'service_description' => 'sometimes|required|string',
        'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'category' => 'sometimes|required|string|max:255',
        'content_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'existing_images' => 'nullable|array',
        'existing_images.*' => 'string',
    ]);

    try {

        if ($request->hasFile('cover_image')) {
            Log::info('New cover image uploaded.');

            if ($service->cover_image) {
                Storage::disk('public')->delete('services/' . $service->cover_image);
                Log::info('Deleted old cover image: ' . $service->cover_image);
            }

            $coverImageName = now()->format('dmy_His') . '.' . $request->cover_image->getClientOriginalExtension();
            $request->cover_image->storeAs('services', $coverImageName, 'public');
            $service->cover_image = $coverImageName;
            Log::info('Stored new cover image: ' . $coverImageName);
        }


        if ($request->hasFile('content_images')) {
            Log::info('New content images uploaded.');

            $existingContentImages = json_decode($service->content_images) ?? [];
            foreach ($existingContentImages as $existingImage) {
                Storage::disk('public')->delete('services/content/' . $existingImage);
                Log::info('Deleted existing content image: ' . $existingImage);
            }


            $contentImageNames = [];
            foreach ($request->file('content_images') as $image) {
                $imageName = now()->format('dmy_His') . '.' . $image->getClientOriginalExtension();
                $image->storeAs('services/content', $imageName, 'public');
                $contentImageNames[] = $imageName;
                Log::info('Stored new content image: ' . $imageName);
            }
            $service->content_images = json_encode($contentImageNames);
        } elseif ($request->has('existing_images')) {

            Log::info('Retaining existing images: ', $request->existing_images);
            $service->content_images = json_encode($request->existing_images);
        }

        // Update other service details
        if ($request->has('service_title')) {
            $service->service_title = $request->service_title;
            $service->slug = Str::slug($request->service_title);
            Log::info('Updated service title: ' . $service->service_title);
        }
        if ($request->has('service_description')) {
            $service->service_description = $request->service_description;
            Log::info('Updated service description.');
        }
        if ($request->has('category')) {
            $service->category = $request->category;
            Log::info('Updated category: ' . $service->category);
        }

        $service->save();
        Log::info('Service updated successfully.');

        return response()->json(['success' => 'Service updated successfully!']);
    } catch (\Exception $e) {
        Log::error('Service update failed: ' . $e->getMessage());
        return response()->json(['error' => 'Failed to update service.'], 500);
    }
}
    public function destroy($id)
    {
        $service = Service::findOrFail($id);


        if ($service->cover_image) {
            Storage::disk('public')->delete('services/' . $service->cover_image);
        }


        $existingContentImages = json_decode($service->content_images) ?? [];
        foreach ($existingContentImages as $existingImage) {
            Storage::disk('public')->delete('services/content/' . $existingImage);
        }

        $service->delete();
        return response()->json(['success' => 'Service deleted successfully!']);
    }
}
