<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use DataTables;

class UserController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
//        if ($request->ajax()) {
//            $data = User::select('*');
//            return DataTables::of($data)
//                ->addColumn('user_name', function($row) {
//                    return view('admin.users.partials.user_name', compact('row'));
//                })
//                ->addColumn('email', function($row) {
//                    return view('admin.users.partials.email', compact('row'));
//                })
//                ->addColumn('role', function($row) {
//                    return $row->role->title;
//                })
//                ->addColumn('status', function($row) {
//                    return view('admin.users.partials.status', compact('row'));
//                })
//                ->addColumn('action', function($row) {
//                    return view('admin.users.partials.action', compact('row'));
//                })
//                ->rawColumns(['user_name', 'email', 'role', 'status', 'action'])
//                ->make(true);
//        }

        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required', 'integer', 'exists:roles,id'],
            'photo_path' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle the file upload if a file is provided
        $photoPath = null;
        if ($request->hasFile('photo_path')) {
            $file = $request->file('photo_path');
            $filename = Str::slug($request->name) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $photoPath = $file->storeAs('users', $filename, 'public');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo_path' => $photoPath,
            'status' => $request->status,
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('users.index')->with('message', 'User created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required', 'integer', 'exists:roles,id'],
            'photo_path' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $photoPath = null;
        if ($request->hasFile('photo_path')) {
            $file = $request->file('photo_path');
            $filename = Str::slug($request->name) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $photoPath = $file->storeAs('users', $filename, 'public');
        }

        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->photo_path = $photoPath;
        $user->status = $request->status;
        $user->role_id = $request->role_id;
        $user->save();

        return redirect()->route('users.index')->with('message', 'User has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('message', 'User has been deleted successfully.');
    }

    public function statusToggle(User $user)
    {
        if($user->status)
        {
            $user->status = false;
            $user->save();
        }
        else
        {
            $user->status = true;
            $user->save();
        }

        return redirect('/users');
    }

    public function profile(User $user)
    {

    }
}
