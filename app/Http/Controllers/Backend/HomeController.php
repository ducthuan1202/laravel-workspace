<?php

namespace App\Http\Controllers\Backend;


class HomeController extends BackendController
{
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->title = 'Trang thống kê';
        $this->viewFolder = 'home';
        $this->routePrefix = 'home';

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(){

        $this->authorize('isAdmin');

        return view($this->getView('index'), [
            'title'=> $this->title
        ]);
    }
}