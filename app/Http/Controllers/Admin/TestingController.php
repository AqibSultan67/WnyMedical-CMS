<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class TestingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Testing::all();
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    return '
                        <button class="btn btn-sm btn-edit edit" data-id="' . $row->id . '">Edit</button>
                        <button class="btn btn-sm btn-danger delete" data-id="' . $row->id . '">Delete</button>
                    ';
                })
                ->make(true);
        }
        return view('admin.testings.index'); // Adjust according to your view path
    }

    public function create()
    {
        // Return view if needed for creating a new record
    }

    public function store(Request $request)
    {
        $request->validate([
            'steps' => 'required|array',
            'steps.*' => 'required|string',
            'description' => 'required|array',
            'description.*' => 'required|string',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'app' => 'required|array', // Change to array if multiple apps are allowed
            'app.*' => 'string', // Validate each app entry as a string
        ]);

        $testing = new Testing();

        // Handle image upload
        $images = [];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                if ($file) {
                    $path = $file->store('images', 'public');
                    $images[] = $path; // Collect image paths into the array
                }
            }
        }

        // Assign properties
        $testing->steps = $request->steps;
        $testing->description = $request->description;
        $testing->images = $images; // Store collected images
        $testing->app = json_encode($request->app); // Store as JSON if multiple apps
        $testing->save();

        return response()->json(['success' => 'Content added successfully.']);
    }

    public function edit($id)
    {
        $testing = Testing::find($id);
        return response()->json($testing);
    }

    public function update(Request $request, $id)
    {
        \Log::info('Request Data:', $request->all());
        $request->validate([
            'steps' => 'required|array',
            'steps.*' => 'required|string',
            'description' => 'required|array',
            'description.*' => 'required|string',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'app' => 'required|array', // Change to array if multiple apps are allowed
            'app.*' => 'string', // Validate each app entry as a string
        ]);

        $testing = Testing::find($id);

        // Handle image upload if present
        if ($request->hasFile('image')) {
            // Delete previous images if needed
            foreach ($testing->images as $image) {
                Storage::disk('public')->delete($image);
            }

            $images = []; // Collect new image paths
            foreach ($request->file('image') as $file) {
                if ($file) {
                    $path = $file->store('images', 'public');
                    $images[] = $path; // Collect new image paths
                }
            }
            $testing->images = $images; // Update images with new array
        }

        // Assign other properties
        $testing->steps = $request->steps;
        $testing->description = $request->description;
        $testing->app = json_encode($request->app); // Store as JSON if multiple apps
        $testing->save();

        return response()->json(['success' => 'Content updated successfully.']);
    }

    public function destroy($id)
    {
        $testing = Testing::find($id);

        // Delete associated images
        foreach ($testing->images as $image) {
            Storage::disk('public')->delete($image);
        }

        $testing->delete();

        return response()->json(['success' => 'Content deleted successfully.']);
    }
}
