<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use Yajra\DataTables\DataTables;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Location::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('days', function($row) {
                    return implode(', ', json_decode($row->days));
                })
                ->addColumn('times', function($row) {
                    return implode(', ', json_decode($row->times));
                })
                ->addColumn('description', function($row) {
                    return $row->description;
                })
                ->addColumn('action', function($row) {
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm py-2" data-id="' . $row->id . '">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm py-2" data-id="' . $row->id . '">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.locations_content.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'location' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'days' => 'required|array',
            'times' => 'required|array',
            'link' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        try {
            $location = Location::create([
                'location' => $request->location,
                'phone' => $request->phone,
                'address' => $request->address,
                'days' => json_encode($request->days),
                'times' => json_encode($request->times),
                'link' => $request->link,
                'description' => $request->description,
            ]);

            return response()->json(['success' => 'Location added successfully!']);
        } catch (\Exception $e) {
            \Log::error('Location creation failed: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to add location: ' . $e->getMessage()], 500);
        }
    }
    public function edit($id)
    {
       
        $location = Location::findOrFail($id);


        $location->days = json_decode($location->days, true) ?? [];
        $location->times = json_decode($location->times, true) ?? [];


        return response()->json($location);
    }
    public function update(Request $request, $id)
    {
        $location = Location::findOrFail($id);

        $request->validate([
            'location' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'days' => 'required|array',
            'times' => 'required|array',
            'link' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $location->update([
            'location' => $request->location,
            'phone' => $request->phone,
            'address' => $request->address,
            'days' => json_encode($request->days),
            'times' => json_encode($request->times),
            'link' => $request->link,
            'description' => $request->description,
        ]);

        return response()->json(['success' => 'Location updated successfully!']);
    }

    public function destroy($id)
    {
        $location = Location::findOrFail($id);
        $location->delete();
        return response()->json(['success' => 'Location deleted successfully!']);
    }
}
