<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::orderBy('display_order')->get();
        $users = User::all();

        return view(
            'admin.menus.index',
            compact('menus', 'users')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menus = Menu::whereNull('parent_id')->get(); // Fetch parent menus
        return view('admin.menus.create', compact('menus'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|unique:menus',
            'icon' => 'nullable|string',
            'route' => 'nullable|string',
            'parent_id' => 'nullable|exists:menus,id',
            'display_order' => 'nullable|integer',
            'level' => 'required|in:admin,client',
            'status' => 'required|boolean',
        ]);

        Menu::create([
            'title' => $request->input('title'),
            'icon' => $request->input('icon'),
            'route' => $request->input('route'),
            'parent_id' => $request->input('parent_id'),
            'display_order' => $request->input('display_order', 0),
            'level' => $request->input('level'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('menus.index')->with('success', 'Menu created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        $parentMenus = (new Menu())->parentsOnly();
        return view('admin.menus.edit', compact('menu', 'parentMenus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string',
            'icon' => 'nullable|string',
            'parent_id' => 'nullable|integer',
            'status' => 'required|boolean',
        ]);

        // Update the menu fields
        $menu->title = $request->input('title');
        $menu->icon = $request->input('icon');
        $menu->parent_id = $request->input('parent_id');
        $menu->status = (bool) $request->input('status');
        $menu->level = $request->input('level'); // Add this line for updating level
        // Save the changes
        $menu->save();

        // Redirect to the index route
        return redirect()->route('menus.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menus.index');
    }

    public function linkUser(Request $request)
    {
        $validated = $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'user_id' => 'required|exists:users,id',
            'access_level' => 'required|in:owner,employee',
        ]);

        $menu = Menu::findOrFail($validated['menu_id']);
        $user = User::findOrFail($validated['user_id']);
        $menu->users()->attach($user, ['access_level' => $validated['access_level']]);

        return response()->json(['success' => true]);
    }

    public function updateOrder(Request $request)
    {
        $menu = Menu::find($request->input('id'));
        $menu->display_order = $request->input('value');
        $menu->save();
        return response()->json(['success' => true]);
    }
}
