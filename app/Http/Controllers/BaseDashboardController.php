<?php

namespace App\Http\Controllers;

// use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class BaseDashboardController extends Controller
{
    protected $layout;
    protected $title;
    protected $breadcrumbs = [];
    protected $data = [];

    public function __construct()
    {
        $this->layout = 'layouts.dashboard.vertical';
        $this->breadcrumbs = [
            new BreadCrumb(route('dashboard'), 'Dashboard'),
        ];

        $this->title = 'Dashboard';
    }

    public function getLayout()
    {
        return $this->layout;
    }

    public function getBreadcrumbs()
    {
        return $this->breadcrumbs;
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function changeLayout(Request $request)
    {
        $layout = $request->input('layout_type');

        $this->setLayout($layout);
        Session::put('layout', $layout);

        return redirect()->back();
    }

    public function setBreadcrumbs($breadcrumbs)
    {
        $this->breadcrumbs = $breadcrumbs;
    }

    public function addBreadcrumb($breadcrumb)
    {
        $this->breadcrumbs[] = $breadcrumb;
    }

    public function removeBreadcrumb($index)
    {
        unset($this->breadcrumbs[$index]);
    }

    public function clearBreadcrumbs()
    {
        $this->breadcrumbs = [];
    }

    public function setTitle($title)
    {
        $this->title = $title . ' | ' . config('app.name');
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function addData($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function removeData($key)
    {
        unset($this->data[$key]);
    }

    public function clearData()
    {
        $this->data = [];
    }

    public function renderDatatable($datatable, $view)
    {
        $this->data['layout'] = $this->getLayout();
        $this->data['title'] = $this->title;
        $this->data['breadcrumbs'] = $this->getBreadcrumbs();

        return $datatable->render($view, $this->data);
    }

    public function renderView($view, $additionalData = [])
    {
        $this->data['layout'] = $this->getLayout();
        $this->data['title'] = $this->title;
        $this->data['breadcrumbs'] = $this->getBreadcrumbs();

        $this->data = array_merge($this->data, $additionalData);

        return view($view, $this->data);
    }
}

class BreadCrumb
{
    public $link;
    public $name;
    public $active;

    public function __construct($link, $name)
    {
        $this->link = $link;
        $this->name = $name;

        $linkRouteName = Route::getRoutes()->match(Request::create($link))->getName();
        $currentRouteName = Route::currentRouteName();

        $this->active = $currentRouteName == $linkRouteName;
    }
}
