<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\PcmOverview;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PCMOverviewController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PcmOverview::latest()->get();
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
        return view('admin.pcm_content.pcm-overview');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        try {
            PcmOverview::create([
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
        $content = PcmOverview::findOrFail($id);
        return response()->json($content);
    }

    public function update(Request $request, $id)
    {


        $content = PcmOverview::findOrFail($id);

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
        $content = PcmOverview::findOrFail($id);
        $content->delete();
        return response()->json(['success' => 'Content deleted successfully!']);
    }
}
