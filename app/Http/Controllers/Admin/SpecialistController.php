<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Specialist;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SpecialistController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Specialist::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return '
                        <label class="switch">
                            <input type="checkbox" class="toggle-status" data-id="' . $row->id . '" ' . ($row->status === 'active' ? 'checked' : '') . '>
                            <span class="slider"></span>
                        </label>
                    ';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm py-2" data-id="' . $row->id . '">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm py-2" data-id="' . $row->id . '">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        return view('admin.home_content.specialists');
    }

    public function store(Request $request)
{
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'specialist_name' => 'required|string|max:255',
        'speciality' => 'required|string',
        'specialist_description' => 'required|string',
        'status' => 'nullable|string|in:active,deactivated'
    ]);

    try {
        Log::debug('Storing new specialist data:', $request->all());

        $imageName = null;
        if ($request->hasFile('image')) {
            $timestamp = now()->format('dmy_His');
            $extension = $request->file('image')->getClientOriginalExtension();
            $imageName = $timestamp . '.' . $extension;
            $request->file('image')->storeAs('specialists', $imageName, 'public');
            Log::debug('Image uploaded:', [$imageName]);
        } else {
            Log::debug('No image uploaded.');
        }

        $slug = Str::slug($request->specialist_name, '-');

       
        $count = 1;
        $originalSlug = $slug;
        while (Specialist::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        $specialist = Specialist::create([
            'image' => $imageName,
            'specialist_name' => $request->specialist_name,
            'slug' => $slug,
            'speciality' => $request->speciality,
            'description' => $request->specialist_description,
            'status' => $request->status ?? 'active',
        ]);

        Log::debug('Specialist created successfully: ', $specialist->toArray());

        return response()->json(['success' => 'Specialist added successfully!']);
    } catch (\Exception $e) {
        Log::error('Specialist creation failed: ' . $e->getMessage());
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
    public function edit($id)
    {
        $specialist = Specialist::findOrFail($id);
        return response()->json($specialist);
    }

    public function update(Request $request, $id)
    {
        $specialist = Specialist::findOrFail($id);

        $request->validate([
            'specialist_name' => 'required|string|max:255',
            'speciality' => 'required|string',
            'specialist_description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            if ($request->hasFile('image')) {
                $imageName = now()->format('dmy_His') . '.' . $request->image->getClientOriginalExtension();
                $request->image->storeAs('specialists', $imageName, 'public');
                $specialist->image = $imageName;
            }

            $specialist->specialist_name = $request->specialist_name;
            $specialist->slug = Str::slug($request->specialist_name, '-'); // Update slug here
            $specialist->speciality = $request->speciality;
            $specialist->description = $request->specialist_description;
            $specialist->save();

            return response()->json(['success' => 'Specialist updated successfully!']);
        } catch (\Exception $e) {
            Log::error('Specialist update failed: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to update specialist.'], 500);
        }
    }

    public function destroy($id)
    {
        $specialist = Specialist::findOrFail($id);
        $specialist->delete();
        return response()->json(['success' => 'Specialist deleted successfully!']);
    }

    public function toggleStatus($id)
    {
        $specialist = Specialist::findOrFail($id);
        $specialist->status = $specialist->status === 'active' ? 'inactive' : 'active';
        $specialist->save();

        return response()->json(['success' => 'Status updated successfully.']);
    }
}
