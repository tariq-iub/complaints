<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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
        $users = User::paginate(50);
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
            'photo_path' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:1024'],
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
        $validating_array = [
            'name' => ['required', 'string', 'max:255'],
            'role_id' => ['required', 'integer', 'exists:roles,id'],
            'photo_path' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:1024'],
        ];

        if($request->input('changePasswordCheck') != null)
        {
            $validating_array['password'] = ['required', 'string', 'min:8', 'confirmed'];
        }

        $validator = Validator::make($request->all(), $validating_array);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($user->photo_path && Storage::disk('public')->exists($user->photo_path)) {
            Storage::disk('public')->delete($user->photo_path);
        }

        $photoPath = null;
        if ($request->hasFile('photo_path')) {
            $file = $request->file('photo_path');
            $filename = Str::slug($request->name) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $photoPath = $file->storeAs('users', $filename, 'public');
        }

        $user->name = $request->name;
        if($request->input('changePasswordCheck') != null)
            $user->password = Hash::make($request->password);
        $user->cnic_no = $request->cnic_no;
        $user->contact_no = $request->contact_no;
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
        $user->status = !$user->status;
        $user->save();

        return redirect('/users');
    }

    public function profile(User $user)
    {
        return $user;
    }
}
