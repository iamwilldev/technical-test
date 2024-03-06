<?php

use App\Models\Navigation;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

function menus()
{
    $menu = [
        (object)[
            'name' => 'Dashboard',
            'icon' => 'ni ni-dashboard',
            'link' => route('dashboard'),
            'role' => ['admin', 'user']
        ],
    ];
}

function renderMenu($data)
{
    $currentRouteName = Route::currentRouteName();
    if (isset($data['children'])) {

        $htmlTemp = '';
        $isActive = '';
        foreach ($data['children'] as $child) {
            $htmlTemp .= renderMenu($child);
            $urlRouteName = Route::getRoutes()->match(Request::create($child['link']))->getName();
            if ($currentRouteName == $urlRouteName) {
                $isActive = 'active';
            }
        }
        $html = '<li class="nk-menu-item has-sub ' . $isActive . ' ">
        <a href="#" class="nk-menu-link nk-menu-toggle">
            <span class="nk-menu-icon"><em class="icon ni ' . $data['icon'] . '"></em></span>
            <span class="nk-menu-text">' . $data['name'] . '</span>
        </a>
        <ul class="nk-menu-sub">';
        $html .= $htmlTemp;
        $html .= '</ul></li>';
    } else {
        if (isset($data['role'])) {
            if (is_array($data['role'])) {
                if (!in_array(auth()->user()->getRoleNames()[0], $data['role'])) {
                    return '';
                }
            } else {
                if (auth()->user()->getRoleNames()[0] != $data['role']) {
                    return '';
                }
            }
        }
        $urlRouteName = Route::getRoutes()->match(Request::create($data['link']))->getName();

        $isActive = $currentRouteName == $urlRouteName ? 'active' : '';
        $html = '<li class="nk-menu-item ' . $isActive . ' ">
                    <a href="' . $data['link'] . '" class="nk-menu-link">';
        if (isset($data['icon'])) {
            $html .= '<span class="nk-menu-icon"><em class="icon ni ' . $data['icon'] . '"></em></span>';
        }

        $html .=
            '
                        <span class="nk-menu-text">' . $data['name'] . '</span>
                    </a>
                </li>';
    }
    return $html;
}

function navigations(): Collection
{
    return Navigation::tree();
}

function userNavigations($idUser = null): Collection
{
    if ($idUser) {
        $user = User::find($idUser);
    } else {
        $user = auth()->user();
    }

    if (!$user) {
        return collect([]);
    }

    $roles = $user->roles->pluck('uuid')->toArray();
    // dd($roles);

    $navigations = Navigation::tree();
    foreach ($navigations as $i => $nav) {
        if (!$nav->is_header) {
            $hasChild = isset($nav->children) && count($nav->children) > 0;

            if (!$hasChild) {
                // current nav intersection with user roles
                $navHasRole = $nav->roles->pluck('uuid')->intersect($roles)->count() > 0;

                if (!$navHasRole) {
                    $navigations->forget($i);
                }
            } else {
                $childHasRole = false;
                // dd($nav);
                foreach ($nav->children as $j => $child) {
                    $navHasRole = $child->roles->pluck('uuid')->intersect($roles)->count() > 0;

                    if (!$navHasRole) {
                        $nav->children->forget($j);
                    } else {
                        $childHasRole = true;
                    }
                }

                if (!$childHasRole) {
                    $navigations->forget($i);
                }
            }
        }
    }

    return $navigations;
}

function getCurrentRouteName(): String
{
    return Route::currentRouteName();
}

function getRouteNameFromUri(String $uri): String
{
    return Route::getRoutes()
        ->match(Request::create($uri))
        ->getName();
}

function getUriFromRouteName(String|null $routeName): String
{
    return $routeName ? route($routeName) : "#";
}

function getUriFromNavigationLink($link, $linkType, $hasChild = false): String
{
    if ($hasChild) {
        return "#";
    }

    if ($linkType == 'route') {
        return getUriFromRouteName($link);
    }
    return $link ?? "#";
}

function isCurrentNavigationActive($link, $linkType): Bool
{
    if ($linkType == 'route') {
        return getCurrentRouteName() == $link;
    }
    return Request::is($link) ?? false;
}
