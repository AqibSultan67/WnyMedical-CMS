<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Practice;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PracticeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Practice::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm py-2" data-id="' . $row->id . '">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm py-2" data-id="' . $row->id . '">Delete</a>';
                    return $btn;
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.home_content.practices');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        try {
            $imageName = null;
            if ($request->file('image')) {
                $timestamp = now()->format('dmy_His');
                $extension = $request->file('image')->getClientOriginalExtension();
                $imageName = $timestamp . '.' . $extension;

                $request->file('image')->storeAs('practices', $imageName, 'public');
            }

            Practice::create([
                'image' => $imageName,
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'description' => $request->description,
            ]);

            return response()->json(['success' => 'Practice added successfully!']);
        } catch (\Exception $e) {
            Log::error('Practice creation failed: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to add practice.'], 500);
        }
    }

    public function edit($id)
    {
        $practice = Practice::findOrFail($id);
        return response()->json($practice);
    }

    public function update(Request $request, $id)
    {
        Log::debug('Update practice ID: ' . $id);
        Log::debug('Incoming data: ', $request->all());

        $practice = Practice::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = now()->format('dmy_His') . '.' . $request->image->getClientOriginalExtension();
            $request->image->storeAs('practices', $imageName, 'public');
            $practice->image = $imageName;
        }

        $practice->title = $request->title;
        $practice->subtitle = $request->subtitle;
        $practice->description = $request->description;
        $practice->save();

        return response()->json(['success' => 'Practice updated successfully!']);
    }

    public function destroy($id)
    {
        $practice = Practice::findOrFail($id);


        // if ($practice->image) {
        //     Storage::disk('public')->delete('practices/' . $practice->image);
        // }

        $practice->delete();
        return response()->json(['success' => 'Practice deleted successfully!']);
    }
}
