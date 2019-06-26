<?php

namespace App\Http\Controllers\Backend;

use App\Entities\Log;
use App\Repositories\LogRepository;
use Illuminate\Http\Request;

/**
 * Class LogController
 * @package App\Http\Controllers\Backend
 * ---------------------------------------------------------
 * @property LogRepository $repository
 */
class LogController extends BackendController
{
    protected $repository;

    /**
     * LogController constructor.
     * @param LogRepository $repository
     */
    public function __construct(LogRepository $repository)
    {
        $this->title = 'Logs';
        $this->viewFolder = 'log';
        $this->routePrefix = 'logs';
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {

        $model = new Log();

        return view($this->getView('index'), [
            'title' => sprintf('Danh sách [%s]', $this->title),
            'params' => $request->all(),
            'model' => $model,
            'data' => $model->search($request->all()),
        ]);
    }

}