<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        return view('backend.pages.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('backend.pages.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        if ($request->password != $request->password_confirmation) {
            notify()->error('Password and confirm password does not match');
            return back();
        }
        $user = new User();
        $user->role_id = $request->role_id;
        $user->name = $request->name;
        $user->slug = slugify($request->name);
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->status = $request->status;
        $user->password = Hash::make($request->password_confirmation);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '-' . rand(0, 9999999) . '-' . $user->slug . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('backend/images/users');
            $image->move($destinationPath, $name);
            $user->image = $name;
        }
        $user->save();
        notify()->success('User created successfully');
        return redirect('/users');
    }

    public function show($id)
    {
        $user = User::with('role')->find($id);
        return view('backend.pages.user.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('backend.pages.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->role_id = $request->role_id;
        $user->name = $request->name;
        $user->slug = slugify($request->name);
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->status = $request->status;


        if ($request->hasFile('image')) {
            if ($user->image != 'profile.svg') {
                if (file_exists(public_path('backend/images/users/' . $user->image))) {
                    @unlink(public_path('backend/images/users/' . $user->image));
                }
            }
            $image = $request->file('image');
            $name = time() . '-' . rand(0, 9999999) . '-' . $user->slug . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('backend/images/users');
            $image->move($destinationPath, $name);
            $user->image = $name;
        }
        $user->save();
        notify()->success('User updated successfully');
        return redirect('/users');
    }

    public function destroy($id)
    {
        //
    }
}
