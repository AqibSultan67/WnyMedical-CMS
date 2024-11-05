<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\MediaLink;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MediaLinkController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = MediaLink::latest()->get();
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
        return view('admin.media_content.video-links');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'link' => 'required',
            'description' => 'required',

        ]);

        try {
            MediaLink::create([
                'title' => $request->title,
                'link' => $request->link,
                'description' => $request->description,

            ]);

            return response()->json(['success' => 'Content added successfully!']);
        } catch (\Exception $e) {
            Log::error('Content creation failed: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to add content.'], 500);
        }
    }

    public function edit($id)
    {
        $content = MediaLink::findOrFail($id);
        return response()->json($content);
    }

    public function update(Request $request, $id)
    {


        $content = MediaLink::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'link' => 'required',
            'description' => 'required',


        ]);

        $content->title = $request->title;
        $content->link = $request->link;
        $content->description = $request->description;

        $content->save();

        return response()->json(['success' => 'Content updated successfully!']);
    }

    public function destroy($id)
    {
        $content = MediaLink::findOrFail($id);
        $content->delete();
        return response()->json(['success' => 'Content deleted successfully!']);
    }
}
