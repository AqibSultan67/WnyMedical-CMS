<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FooterController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Footer::latest()->get(); 
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<button data-id="'.$row->id.'" class="editFooter btn btn-primary btn-sm py-2">Edit</button>';
                    $btn .= '<button data-id="'.$row->id.'" class="deleteFooter btn btn-danger btn-sm py-2">Delete</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.home_content.footer'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'copyright' => 'required|string|max:255',
            'powered_by' => 'required|string|max:255',
        ]);

       
        Footer::create($request->only('copyright', 'powered_by'));

        return response()->json(['success' => 'Footer added successfully']);
    }

    public function edit($id)
    {
        $footer = Footer::find($id);
        return response()->json($footer);
    }

    public function update(Request $request, $id)
    {
        $footer = Footer::find($id);
        $footer->update($request->only('copyright', 'powered_by'));
        return response()->json(['success' => 'Footer updated successfully']);
    }

    public function destroy($id)
    {
        Footer::find($id)->delete();
        return response()->json(['success' => 'Footer deleted successfully']);
    }
}
