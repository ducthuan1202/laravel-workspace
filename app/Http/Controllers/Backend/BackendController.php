<?php
namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;

/**
 * Class BackendController
 * @package App\Http\Controllers\Backend
 * ------------------------------------------
 * @property string $title
 * @property string $viewFolder
 * @property string $routePrefix
 */
class BackendController extends Controller
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
            return sprintf('backend.%s', $name);
        }
        return sprintf('backend.%s.%s', $this->viewFolder, $name);
    }

    /**
     * @param $name
     * @return string
     */
    protected function getRoute($name = '')
    {
        if (empty($this->routePrefix)) {
            return sprintf('backend.%s', $name);
        }
        return sprintf('backend.%s.%s', $this->routePrefix, $name);
    }
}
