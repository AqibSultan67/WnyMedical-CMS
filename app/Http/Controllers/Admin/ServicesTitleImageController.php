<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Services_Title_Image;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ServicesTitleImageController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Services_Title_Image::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm py-2 mb-2" data-id="' . $row->id . '">Edit</a><br>';
                    $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm py-2" data-id="' . $row->id . '">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.services_content.services-title-image');
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

                $path = $request->file('image')->storeAs('services', $imageName, 'public');

                Services_Title_Image::create(['image' => $imageName]);
            }

            return response()->json(['success' => 'Image uploaded successfully!']);
        } catch (\Exception $e) {
            Log::error('Image upload failed: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to upload image.'], 500);
        }
    }

    public function edit($id)
    {
        $slider =Services_Title_Image::findOrFail($id);
        return response()->json($slider);
    }

    public function update(Request $request, $id)
    {


        $slider = Services_Title_Image::findOrFail($id);

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $imageName = now()->timestamp . '.' . $request->image->extension();
            $request->image->storeAs('services', $imageName, 'public');
            $slider->image = $imageName;
        }

        $slider->save();
        return response()->json(['success' => 'Image updated successfully!']);
    }

    public function destroy($id)
    {
        $slider = Team::findOrFail($id);
        // if ($slider->image) {
        //     Storage::disk('public')->delete('slider-images/' . $slider->image);
        // }
        $slider->delete();
        return response()->json(['success' => 'Image deleted successfully!']);
    }

}
