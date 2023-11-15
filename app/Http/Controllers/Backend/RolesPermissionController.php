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
        $userRoles = Role::all();
        return view('backend.pages.roles-permission.index', compact('userRoles', 'routeList'));
    }

    public function create()
    {
        $routeList = get_route_list();
        return view('backend.pages.roles-permission.modal-body', compact('routeList'));
    }

    public function store(Request $request)
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
        $userRole = new Role();
        $userRole->role_name = $request->role_name;
        $userRole->role_slug = slugify($request->role_name);
        $userRole->permission = json_encode($routeList);
        $userRole->save();

        notify()->success('Role created successfully');
        return redirect()->back();
    }

    public function edit($id)
    {
        $userRole = Role::findOrFail($id);
        $routeList = json_decode($userRole->permission, true);
        return view('backend.pages.roles-permission.modal-body', compact('userRole', 'routeList'));
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
        $userRole->role_name = $request->role_name;
        $userRole->role_slug = slugify($request->role_name);
        $userRole->permission = json_encode($routeList);
        $userRole->save();

        notify()->success('Role updated successfully');
        return redirect()->back();
    }
}
