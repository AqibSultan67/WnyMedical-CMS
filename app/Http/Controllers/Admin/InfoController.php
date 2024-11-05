<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Info;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class InfoController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Info::latest()->get();
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
        return view('admin.home_content.info');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location_title' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        try {
            Info::create([
                'title' => $request->title,
                'description' => $request->description,
                'location_title' => $request->location_title,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
            ]);

            return response()->json(['success' => 'Info added successfully!']);
        } catch (\Exception $e) {
            Log::error('Info creation failed: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to add info.'], 500);
        }
    }

    public function edit($id)
    {
        $info = Info::findOrFail($id);
        return response()->json($info);
    }

    public function update(Request $request, $id)
    {
        Log::debug('Update info ID: ' . $id);
        Log::debug('Incoming data: ', $request->all());

        $info = Info::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location_title' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        $info->title = $request->title;
        $info->description = $request->description;
        $info->location_title = $request->location_title;
        $info->address = $request->address;
        $info->phone = $request->phone;
        $info->email = $request->email;
        $info->save();

        return response()->json(['success' => 'Info updated successfully!']);
    }

    public function destroy($id)
    {
        $info = Info::findOrFail($id);
        $info->delete();
        return response()->json(['success' => 'Info deleted successfully!']);
    }
}
