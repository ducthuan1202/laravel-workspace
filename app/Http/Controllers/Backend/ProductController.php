<?php

namespace App\Http\Controllers\Backend;


use App\Admin;
use App\Entities\Category;
use App\Entities\Product;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\CategoryResource;
use App\Jobs\PageOnLoadJob;
use App\Notifications\NewCategoryNotify;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

/**
 * Class ProductController
 * @package App\Http\Controllers\Backend
 */
class ProductController extends BackendController
{
    protected $repository;

    /**
     * ProductController constructor.
     */
    public function __construct()
    {
        $this->title = 'Sản phẩm';
        $this->viewFolder = 'product';
        $this->routePrefix = 'products';
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function getData(Request $request)
    {
        $cookieProductSearchParams = Cookie::get('product_search_params');
        $cookieProductSearchParams = json_decode($cookieProductSearchParams, true);
        if(!$cookieProductSearchParams){
            $cookieProductSearchParams = $request->all();
        } else {
            $cookieProductSearchParams = array_merge($cookieProductSearchParams, $request->all());
        }

        Cookie::queue('product_search_params', json_encode($cookieProductSearchParams), 60*24*30);


        $model = new Product();

        return response()->json([
            'success' => true,
            'code' => 200,
            'data' => view($this->getView('partials._table_ajax'), [
                'params' => $cookieProductSearchParams,
                'model' => $model,
                'data' => $model->search($cookieProductSearchParams),
            ])->render()
        ]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $model = new Product();
        $params = Cookie::get('product_search_params', '');
        $params = json_decode($params, true);

        return view($this->getView('index'), [
            'title' => sprintf('Danh sách [%s]', $this->title),
            'params' => $params,
            'model' => $model,
            'data' => $model->search($request->all()),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function openForm(Request $request)
    {
        /** @var Product $model */
        $model = Product::firstOrNew(['id' => (int)$request->get('id')]);

        /** tự động tăng view lên 1 đơn vị */
        // $model->increment('views');

        $categoryModel = new Category();

        return response()->json([
            'success' => true,
            'model' => $model,
            'data' => view($this->getView('form'), [
                'model' => $model,
                'categories' => $categoryModel->list(),
            ])->render()
        ]);

    }

    /**
     * @param ProductRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function saveForm(ProductRequest $request)
    {

        try {

            Product::firstOrNew(['id' => (int)$request->get('id')])
                ->fill($request->all())
                ->save();

            return response()->json([
                'success' => true,
                'data' => 'lưu thành công',
            ]);

        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'data' => $exception->getMessage()]);
        }
    }

    /**
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Product $product)
    {
        $this->authorize('isAdmin', $product);

        try {

            $product->delete();

            return response()->json(['success' => true, 'data' => 'Xóa thành công',]);

        } catch (\Exception $exception) {

            return response()->json(['success' => false, 'data' => $exception->getMessage()]);

        }
    }


}
