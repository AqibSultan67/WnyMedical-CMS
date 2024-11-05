<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class HomeContentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Content::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<button data-id="'.$row->id.'" class="editContent btn btn-primary btn-sm py-2">Edit</button>';
                    $btn .= '<button data-id="'.$row->id.'" class="deleteContent btn btn-danger btn-sm py-2">Delete</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.home_content.content');
    }

    public function store(Request $request)
    {
        Content::create($request->all());
        return response()->json(['success' => 'Content added successfully']);
    }

    public function edit($id)
    {
        $content = Content::find($id);
        return response()->json($content);
    }

    public function update(Request $request, $id)
    {
        $content = Content::find($id);
        $content->update($request->all());
        return response()->json(['success' => 'Content updated successfully']);
    }

    public function destroy($id)
    {
        Content::find($id)->delete();
        return response()->json(['success' => 'Content deleted successfully']);
    }
}
