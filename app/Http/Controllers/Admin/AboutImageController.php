<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutImage;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AboutImageController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = AboutImage::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm py-2" data-id="' . $row->id . '">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm py-2" data-id="' . $row->id . '">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.about_content.about_image');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        try {
            if ($request->file('image')) {
                $timestamp = now()->format('dmy_His');
                $extension = $request->file('image')->getClientOriginalExtension();
                $imageName = $timestamp . '.' . $extension;

                $path = $request->file('image')->storeAs('about-images', $imageName, 'public');

                AboutImage::create(['image' => $imageName]);
            }

            return response()->json(['success' => 'Image uploaded successfully!']);
        } catch (\Exception $e) {
            Log::error('Image upload failed: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to upload image.'], 500);
        }
    }

    public function edit($id)
    {
        $aboutImage = AboutImage::findOrFail($id);
        return response()->json($aboutImage);
    }

    public function update(Request $request, $id)
    {
        Log::info('Update about image ID: ' . $id); // Log the image ID being updated
        Log::info('Incoming data: ', $request->all()); // Log all incoming request data

        // Find the existing image record
        $aboutImage = AboutImage::findOrFail($id);
        Log::info('Existing image record retrieved: ', $aboutImage->toArray()); // Log the existing record

        // Validate the request
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Allow for no image upload
        ]);

        // Check if there's a file to upload
        if ($request->hasFile('image')) {
            Log::info('New image file received: ' . $request->image->getClientOriginalName()); // Log the name of the new image

            // Store the new image
            $imageName = now()->timestamp . '.' . $request->image->extension();
            $request->image->storeAs('about-images', $imageName, 'public');

            // Update the image field in the model
            $aboutImage->image = $imageName;
            Log::info('Image updated in the record: ' . $imageName); // Log the updated image name
        } else {
            Log::info('No new image uploaded, keeping the existing one: ' . $aboutImage->image); // Log if no new image was uploaded
        }

        // Save the updated model
        $aboutImage->save();
        Log::info('About image updated successfully for ID: ' . $id); // Log successful update

        return response()->json(['success' => 'About image updated successfully!']);
    }
    public function destroy($id)
    {
        $aboutImage = AboutImage::findOrFail($id); // Update to AboutImage
        // if ($aboutImage->image) {
        //     Storage::disk('public')->delete('about-images/' . $aboutImage->image);
        // }
        $aboutImage->delete();
        return response()->json(['success' => 'About image deleted successfully!']);
    }
}
