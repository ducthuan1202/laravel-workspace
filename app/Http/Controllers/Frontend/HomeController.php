<?php

namespace App\Http\Controllers\Frontend;


class HomeController extends FrontendController
{
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->viewFolder = 'home';
        $this->routePrefix = 'home';
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view($this->getView('index'));
    }
}