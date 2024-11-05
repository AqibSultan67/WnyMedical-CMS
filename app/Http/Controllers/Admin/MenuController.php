<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;

class MenuController extends Controller
{
    public function index(Request $request)
{
    if ($request->ajax()) {

        $data = Menu::whereNull('parent_id')->latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                return '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm py-2" data-id="' . $row->id . '">Edit</a>
                        <a href="javascript:void(0)" class="delete btn btn-danger btn-sm py-2" data-id="' . $row->id . '">Delete</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    $menus = Menu::with('submenus')->get();
    return view('admin.menus.index', compact('menus'));
}
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'parent_id' => 'nullable|exists:menus,id',
    ]);

    try {
        $menu = Menu::create($request->all());
        return response()->json([
            'success' => 'Menu added successfully!',
            'id' => $menu->id,
            'parent_id' => $menu->parent_id,
            'name' => $menu->name
        ]);
    } catch (\Exception $e) {
        Log::error('Menu creation failed: ' . $e->getMessage());
        return response()->json(['error' => 'Failed to add menu.'], 500);
    }
}

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return response()->json($menu);
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:menus,id',
        ]);

        $menu->update($request->all());

        return response()->json(['success' => 'Menu updated successfully!']);
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();
        return response()->json(['success' => 'Menu deleted successfully!']);
    }
    public function getSubcategories(Request $request, $id)
{
    if ($request->ajax()) {

        $subcategories = Menu::where('parent_id', $id)->get();
        return response()->json($subcategories);
    }
}
}
