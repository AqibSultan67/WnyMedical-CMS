<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CareerJob;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;

class CareerJobsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = CareerJob::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function($row) {

                    return now()->greaterThan($row->expired_date) ? 'Expired' : 'Open';
                })
                ->addColumn('action', function($row) {
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm py-2" data-id="' . $row->id . '">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm py-2" data-id="' . $row->id . '">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        return view('admin.careers_content.career_jobs');
    }  public function store(Request $request)
    {
        $request->validate([
            'jobTitle' => 'required|string|max:255',
            'jobType' => 'required|string|max:255',
            'expiredDate' => 'required|date',
        ]);

        try {
            $careerJob = CareerJob::create([
                'job_title' => $request->jobTitle,
                'job_type' => $request->jobType,
                'expired_date' => $request->expiredDate,
                'created_at' => now()->format('M d, Y \a\t g:ia'),
            ]);

            return response()->json(['success' => 'Job created successfully!']);
        } catch (\Exception $e) {
            Log::error('Job creation failed: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to create job.'], 500);
        }
    }

    public function edit($id)
    {
        $job = CareerJob::findOrFail($id);
        return response()->json($job);
    }

    public function update(Request $request, $id)
    {
        $job = CareerJob::findOrFail($id);

        $request->validate([
            'jobTitle' => 'required|string|max:255',
            'jobType' => 'required|string|max:255',
            'expiredDate' => 'required|date',
        ]);

        $job->job_title = $request->jobTitle;
        $job->job_type = $request->jobType;
        $job->expired_date = $request->expiredDate;
        $job->save();

        return response()->json(['success' => 'Job updated successfully!']);
    }

    public function destroy($id)
    {
        $job = CareerJob::findOrFail($id);
        $job->delete();
        return response()->json(['success' => 'Job deleted successfully!']);
    }
}
