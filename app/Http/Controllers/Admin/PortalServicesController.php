<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Portal_Services;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PortalServicesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Portal_Services::latest()->get();
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

        return view('admin.patient_content.patient-portal-services');
    }

    public function store(Request $request)
    {
        Portal_Services::create($request->all());
        return response()->json(['success' => 'Content added successfully']);
    }

    public function edit($id)
    {
        $content = Portal_Services::find($id);
        return response()->json($content);
    }

    public function update(Request $request, $id)
    {
        $content = Portal_Services::find($id);
        $content->update($request->all());
        return response()->json(['success' => 'Content updated successfully']);
    }

    public function destroy($id)
    {
        Portal_Services::find($id)->delete();
        return response()->json(['success' => 'Content deleted successfully']);
    }
}
