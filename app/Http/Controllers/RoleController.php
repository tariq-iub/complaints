<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with('menus')->get();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate(request(),[
            'title' => 'required|string',
        ]);

        $role = new Role();
        $role->title = $request->input('title');
        $role->save();

        return redirect()->route('roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $menus =  Menu::where('status', true)
            ->orderBy('id', 'asc')
            ->orderBy('display_order', 'asc')
            ->get();

        return view('admin.roles.edit', compact('role', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }

    public function attachModalBody($id)
    {
        $role = Role::find($id);
        $ids = $role->menus()
            ->where('status', true)
            ->pluck('menus.id')
            ->toArray();

        $menus = Menu::whereNotIn('id', $ids)->where('id', '!=', 1)->get();
        return response()->json([
            'list' => view('admin.roles.partials.menus_attachment_body',['menus' => $menus])->render(),
            'message' => 'success',
        ]);
    }

    public function detachModalBody($id)
    {
        $role = Role::find($id);
        $menus = $role->menus()
            ->where('status', true)
            ->where('menus.id', '!=', 1)
            ->get();

        return response()->json([
            'list' => view('admin.roles.partials.menus_attachment_body',['menus' => $menus])->render(),
            'message' => 'success',
        ]);
    }

    public function roleMenuAttachment(Request $request)
    {
        $role = Role::find($request->input('role_id'));
        $role->menus()->attach($request->input('menu_ids'));
        return redirect()->route('roles.index')->with(['message' => 'Menus has been attached successfully.']);
    }

    public function roleMenuDetachment(Request $request)
    {
        $role = Role::find($request->input('role_id'));
        $role->menus()->detach($request->input('menu_ids'));
        return redirect()->route('roles.index')->with(['message' => 'Menus has been detached successfully.']);
    }
}
