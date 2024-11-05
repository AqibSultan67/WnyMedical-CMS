<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Schedule::latest()->get();
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

        return view('admin.services_content.schedule');
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

                $path = $request->file('image')->storeAs('schedule-images', $imageName, 'public');

                Schedule::create(['image' => $imageName]);
            }

            return response()->json(['success' => 'Image uploaded successfully!']);
        } catch (\Exception $e) {
            Log::error('Image upload failed: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to upload image.'], 500);
        }
    }

    public function edit($id)
    {
        $aboutImage = Schedule::findOrFail($id);
        return response()->json($aboutImage);
    }

    public function update(Request $request, $id)
    {
        Log::debug('Update about image ID: ' . $id);
        Log::debug('Incoming data: ', $request->all());

        $aboutImage = Schedule::findOrFail($id);

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $imageName = now()->timestamp . '.' . $request->image->extension();
            $request->image->storeAs('schedule-images', $imageName, 'public');
            $aboutImage->image = $imageName;
        }

        $aboutImage->save();
        return response()->json(['success' => ' Image updated successfully!']);
    }

    public function destroy($id)
    {
        $aboutImage = Schedule::findOrFail($id);
        // if ($aboutImage->image) {
        //     Storage::disk('public')->delete('about-images/' . $aboutImage->image);
        // }
        $aboutImage->delete();
        return response()->json(['success' => ' Image deleted successfully!']);
    }
}
