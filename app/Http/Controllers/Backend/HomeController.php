<?php

namespace App\Http\Controllers\Backend;


use App\Entities\Category;
use App\Mail\CategoryDeleteMailable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;

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
    public function index()
    {

//        $this->authorize('isAdmin');

        return view($this->getView('index'), [
            'title' => $this->title
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function socket()
    {

        return view($this->getView('socket'), [
            'title' => 'socket io'
        ]);
    }

    /**
     * @return string
     */
    public function api()
    {

        return view($this->getView('api'), [
            'title' => 'socket io'
        ]);
    }



    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function eloquent()
    {

        $params = [
            'keyword' => 'ahihi',
            'status' => [
                'pending' => 1
            ]
        ];

        Arr::set($params, 'status.success', 2);
        dd($params);
        $keyword = Arr::get($params, 'status.success');
        dd($keyword);

        $collection = collect([
            'color' => 'orange',
            'type' => 'fruit',
            'remain' => 6
        ]);

        $diff = $collection->diffAssoc([
            'color' => 'yellow',
            'type' => 'fruit',
            'remain' => 3,
            'used' => 6
        ]);

        $d = $diff->all();
        dd($d);


        $data = collect(range(1, 9));

        return view($this->getView('eloquent'), [
            'title' => $this->title,
            'data' => $data,
        ]);

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function mailer()
    {

        try {
            Mail::to(['ducthuan1202@gmail.com'])
                ->cc('hotro247mienphi@gmail.com')
                ->bcc('thuannd@qsoftvietnam.com')
                ->send(new CategoryDeleteMailable(Category::first()));

            return view($this->getView('eloquent'), [
                'title' => $this->title,
            ]);

        } catch (\Exception $exception) {
            abort(404, 'loi roi');
        }

    }
}