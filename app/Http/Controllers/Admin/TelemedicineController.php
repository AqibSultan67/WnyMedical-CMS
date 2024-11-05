<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Telemedicine;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class TelemedicineController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Telemedicine::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm" data-id="' . $row->id . '">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" class="btn btn-danger btn-sm delete" data-id="' . $row->id . '">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.patient_content.telemedicine');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|array',
            'title.*' => 'required|string',
            'description' => 'required|array',
            'description.*' => 'required|string',
            'image' => 'sometimes|array',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'app' => 'required|array',
            'app.*' => 'required|string',
        ]);

        foreach ($request->title as $key => $title) {
            $description = new Telemedicine();
            $description->title = $title;
            $description->description = $request->description[$key];

            if ($request->hasFile('image.' . $key)) {
                $image = $request->file('image.' . $key);
                $date = date('dmy');
                $time = date('His');
                $imageName = $date . '_' . $time . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('images', $imageName, 'public');
                $description->image = $imagePath;
            }

            $description->app = $request->app[$key];
            $description->save();
        }

        return response()->json(['success' => 'Description added successfully.']);
    }

    public function destroy($id)
    {
        try {
            $description = Telemedicine::findOrFail($id);

            if ($description->image && Storage::disk('public')->exists($description->image)) {
                Storage::disk('public')->delete($description->image);
            }

            $description->delete();
            return response()->json(['success' => 'Description deleted successfully.']);

        } catch (\Exception $e) {
            \Log::error('Error deleting description: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to delete description'], 500);
        }
    }
}
