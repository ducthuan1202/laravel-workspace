<?php

namespace App\Http\Controllers\Backend;


use App\Admin;
use App\Entities\Category;
use App\Mail\CategoryDeleteMailable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
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
        return view($this->getView('index'), [
            'title' => $this->title,
            'admins' => Admin::get()
        ]);
    }

    public function permissions()
    {
        $adminPrefix = config('custom.backend.prefix_url');

        $data = [];
        $exclude = ['backend.login', 'backend.check_login', 'backend.logout'];

        foreach (Route::getRoutes()->get() as $route) {
            $action = $route->getAction();

            if (in_array(Arr::get($action, 'as'), $exclude)) {
                continue;
            }

            if ($adminPrefix === Arr::get($action, 'prefix')) {
                $data[] = [
                    'name' => Arr::get($action, 'as'),
                    'controller' => Arr::get($action, 'controller')
                ];
            }

        }

        DB::table('permissions')->truncate();
        DB::table('permissions')->insert($data);

        return 'Thêm danh sách quyền thành công.';
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