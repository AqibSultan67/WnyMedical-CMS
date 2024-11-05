<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PatientDocument;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class NewPatientContentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PatientDocument::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<button data-id="'.$row->id.'" class="deleteContent btn btn-danger btn-sm py-2">Delete</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.patient_content.new-patient-content');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png',
        ]);

        if ($request->hasFile('file')) {

            $date = now()->format('dmy_His');
            $fileName = $date . '_' . $request->file->getClientOriginalName();
            $path=$request->file('file')->storeAs('patient-documents', $fileName, 'public');


            PatientDocument::create([
                'file_name' => $fileName,
                 'file_path' => $path,
            ]);

            return response()->json(['success' => 'File uploaded successfully']);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }

    public function destroy($id)
    {
        $document = PatientDocument::findOrFail($id);


        \Storage::delete('patient-documents/' . $document->file_name);


        $document->delete();

        return response()->json(['success' => 'File deleted successfully']);
    }
}
