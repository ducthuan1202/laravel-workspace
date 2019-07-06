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
use Illuminate\Support\Collection;
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $model = new Product();

        return view($this->getView('index'), [
            'title' => sprintf('Danh sách [%s]', $this->title),
            'params' => $request->all(),
            'model' => $model,
            'data' => $model->search($request->all()),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function create(Request $request)
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
    public function store(ProductRequest $request)
    {

        try {
            /** @var Product $model */
            $model = Product::firstOrNew(['id' => (int)$request->get('id')]);

            $model->fill($request->all());
            $model->is_feature = $request->get('is_feature') ? Product::IS_FEATURE : Product::IS_NOT_FEATURE;
            $model->status = $request->get('status') ? Product::STATUS_ACTIVATE : Product::STATUS_DEACTIVATE;
            $model->save();

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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function getData(Request $request)
    {

        $model = new Product();

        return response()->json([
            'success' => true,
            'code' => 200,
            'data' => view($this->getView('partials._table_ajax'), [
                'params' => $request->all(),
                'data' => $model->search($request->all()),
            ])->render()
        ]);
    }
}
