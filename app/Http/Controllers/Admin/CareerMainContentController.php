<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CareerContent;
use Yajra\DataTables\DataTables;

class CareerMainContentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = CareerContent::latest()->get();
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
        return view('admin.careers_content.career_main_content');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        try {
            CareerContent::create([
                'title' => $request->title,
                'content' => $request->content,
            ]);

            return response()->json(['success' => 'Content added successfully!']);
        } catch (\Exception $e) {
            Log::error('Content creation failed: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to add content.'], 500);
        }
    }

    public function edit($id)
    {
        $content = CareerContent::findOrFail($id);
        return response()->json($content);
    }

    public function update(Request $request, $id)
    {


        $content = CareerContent::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $content->title = $request->title;
        $content->content = $request->content;
        $content->save();

        return response()->json(['success' => 'Content updated successfully!']);
    }

    public function destroy($id)
    {
        $content = CareerContent::findOrFail($id);
        $content->delete();
        return response()->json(['success' => 'Content deleted successfully!']);
    }
}
