<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RolesPermissionController extends Controller
{
    public function index()
    {
        $routeList = get_route_list();
        $roles = Role::all();
        return view('backend.pages.roles-permission.index', compact('roles', 'routeList'));
    }

    public function create()
    {
        $routeList = get_route_list();
        return view('backend.pages.roles-permission.create', compact('routeList'));
    }

    public function store(Request $request)
    {
        return response()->json($request->all());
        $routeList = get_route_list();
        foreach ($request->permission as $key => $value) {
            if (array_key_exists($key, $routeList)) {
                foreach ($routeList[$key] as $k => $route) {
                    if (in_array($k, $value)) {
                        $routeList[$key][$k] = true;
                    } else {
                        $routeList[$key][$k] = false;
                    }
                }
            }
        }
        $userRole = new Role();
        $userRole->name = $request->name;
        $userRole->slug = slugify($request->name);
        $userRole->permission = json_encode($routeList);
        $userRole->save();

        notify()->success('Role created successfully');
        return redirect('roles-permission');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $routeList = json_decode($role->permission, true);
        return view('backend.pages.roles-permission.edit', compact('role', 'routeList'));
    }

    public function update(Request $request, $id)
    {
        $routeList = get_route_list();
        foreach ($request->permission as $key => $value) {
            if (array_key_exists($key, $routeList)) {
                foreach ($routeList[$key] as $k => $route) {
                    if (in_array($k, $value)) {
                        $routeList[$key][$k] = true;
                    } else {
                        $routeList[$key][$k] = false;
                    }
                }
            }
        }
        $userRole = Role::findOrFail($id);
        $userRole->name = $request->name;
        $userRole->slug = slugify($request->name);
        $userRole->permission = json_encode($routeList);
        $userRole->save();

        notify()->success('Role updated successfully');
        return redirect('roles-permission');
    }
}
