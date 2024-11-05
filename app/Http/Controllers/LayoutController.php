<?php

namespace App\Http\Controllers;

use App\Models\Layout; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class LayoutController extends Controller
{
    public function index()
    {
        return view('layout');
    }

    public function save(Request $request)
    {
        try {
            $request->validate([
                'html' => 'required|string',
                'css' => 'nullable|string',
            ]);


            $layout = Layout::create([
                'html' => $request->html,
                'css' => $request->css,
            ]);


            $i = 1;
            while (File::exists(resource_path("views/layout{$i}.blade.php"))) {
                $i++;
            }
            $viewName = "layout{$i}";


            $viewContent = $request->html;


            $path = resource_path("views/{$viewName}.blade.php");


            File::put($path, $viewContent);

            return response()->json(['success' => true, 'id' => $layout->id, 'view' => $viewName]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation errors:', $e->validator->errors()->all());
            return response()->json(['success' => false, 'message' => $e->validator->errors()->first()], 422);
        } catch (\Exception $e) {
            Log::error('Error saving layout: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred, please try again later.'], 500);
        }
    }


}
