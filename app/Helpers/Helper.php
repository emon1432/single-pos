<?php

//slug generate
function slugify($text)
{
    // replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, '-');

    // remove duplicate -
    $text = preg_replace('~-+~', '-', $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}


//get all route list
function get_route_list()
{
    //get all routes
    $routes = \Route::getRoutes();
    $routeList = [];
    foreach ($routes as $route) {
        $routeName = explode('.', $route->getName());
        if (isset($routeName[1])) {
            $routeList[$routeName[0]][] = $routeName[1];
        }
    }
    //remove duplicate routes
    foreach ($routeList as $key => $value) {
        $routeList[$key] = array_unique($value);
    }
    // return response()->json($routeList);

    //remove unnecessary routes
    unset($routeList['login']);
    unset($routeList['logout']);
    unset($routeList['register']);
    unset($routeList['password']);
    unset($routeList['verification']);
    unset($routeList['password']);
    unset($routeList['user-profile-information']);
    unset($routeList['user-password']);
    unset($routeList['two-factor']);
    unset($routeList['profile']);
    unset($routeList['sanctum']);
    unset($routeList['livewire']);
    unset($routeList['ignition']);
    unset($routeList['store']);
    unset($routeList['get']);
    unset($routeList['bank-account']);
    unset($routeList['income-source']);
    unset($routeList['expense-category']);
    unset($routeList['user-role']);
    unset($routeList['pos']);

    //sort ascending
    ksort($routeList);


    //set all routes to false
    foreach ($routeList as $key => $value) {
        $routeList[$key] = array_fill_keys($value, false);
    }

    return $routeList;
}

function check_permission($routeName)
{
    if (auth()->user()->user_role == 1)
        return true;

    $routeName = explode('.', $routeName);
    if (!isset($routeName[1])) return true;
    $authUserPermissions = auth()->user()->role->permission;
    $authUserPermissions = json_decode($authUserPermissions, true);
    if (isset($authUserPermissions[$routeName[0]][$routeName[1]])) {
        if ($authUserPermissions[$routeName[0]][$routeName[1]] == true) {
            return true;
        } else {
            return false;
        }
    } else {
        return true;
    }
}

function main_menu_permission($menuName)
{
    if (auth()->user()->user_role == 1)
        return true;

    $authUserPermissions = auth()->user()->role->permission;
    $authUserPermissions = json_decode($authUserPermissions, true);
    if (isset($authUserPermissions[$menuName])) {
        foreach ($authUserPermissions[$menuName] as $key => $value) {
            if ($value == true) {
                return true;
            }
        }
        return false;
    }
}
