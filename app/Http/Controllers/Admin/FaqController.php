<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;


class FaqController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Faq::latest()->get();
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
        return view('admin.patient_content.faq');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        try {
            Faq::create([
                'question' => $request->question,
                'answer' => $request->answer,
            ]);

            return response()->json(['success' => 'FAQ added successfully!']);
        } catch (\Exception $e) {
            Log::error('FAQ creation failed: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to add FAQ.'], 500);
        }
    }

    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        return response()->json($faq);
    }

    public function update(Request $request, $id)
    {
        $faq = Faq::findOrFail($id);

        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();

        return response()->json(['success' => 'FAQ updated successfully!']);
    }

    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();
        return response()->json(['success' => 'FAQ deleted successfully!']);
    }
}
