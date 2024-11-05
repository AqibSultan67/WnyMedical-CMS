<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\PcmVideoLink;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PCMVIdeoLinkController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PcmVideoLink::latest()->get();
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
        return view('admin.pcm_content.pcm-video');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255'

        ]);

        try {
            PcmVideoLink::create([
                'title' => $request->title,

            ]);

            return response()->json(['success' => 'Content added successfully!']);
        } catch (\Exception $e) {
            Log::error('Content creation failed: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to add content.'], 500);
        }
    }

    public function edit($id)
    {
        $content = PcmVideoLink::findOrFail($id);
        return response()->json($content);
    }

    public function update(Request $request, $id)
    {


        $content = PcmVideoLink::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',

        ]);

        $content->title = $request->title;

        $content->save();

        return response()->json(['success' => 'Content updated successfully!']);
    }

    public function destroy($id)
    {
        $content = PcmVideoLink::findOrFail($id);
        $content->delete();
        return response()->json(['success' => 'Content deleted successfully!']);
    }
}
