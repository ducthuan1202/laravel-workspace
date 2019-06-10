<?php

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;

class FrontendController extends Controller
{

    protected $title;
    protected $viewFolder;
    protected $routePrefix;

    /**
     * @param $name
     * @return string
     */
    protected function getView($name = '')
    {
        if (empty($this->viewFolder)) {
            return sprintf('frontend.%s', $name);
        }
        return sprintf('frontend.%s.%s', $this->viewFolder, $name);
    }

    /**
     * @param $name
     * @return string
     */
    protected function getRoute($name = '')
    {
        if (empty($this->routePrefix)) {
            return $name;
        }
        return sprintf('%s.%s', $this->routePrefix, $name);
    }
}