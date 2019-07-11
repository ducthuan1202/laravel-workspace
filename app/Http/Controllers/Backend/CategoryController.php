<?php

namespace App\Http\Controllers\Backend;


use App\Admin;
use App\Entities\Category;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Notifications\NewCategoryNotify;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Backend
 * ---------------------------------------------------------
 * @property CategoryRepository $repository
 */
class CategoryController extends BackendController
{

    /**
     * CategoryController constructor.
     * @param CategoryRepository $repository
     */
    public function __construct()
    {
        $this->middleware('check.owner')->only('edit');

        $this->title = 'Danh mục';
        $this->viewFolder = 'category';
        $this->routePrefix = 'categories';
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $model = new Category();
        return view($this->getView('index'), [
            'title' => sprintf('Danh sách [%s]', $this->title),
            'params' => $request->all(),
            'model' => $model,
            'data' => $model->search($request->all()),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        return view($this->getView('form'), [
            'title' => sprintf('Tạo mới [%s].', $this->title),
            'model' => new Category(),
        ]);
    }

    /**
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(CategoryRequest $request)
    {
        try {
            $model = new Category();
            $model->fill($request->all());
            $model->is_activate = $request->get('is_activate', 0) ? Category::BOOLEAN_TRUE : Category::BOOLEAN_FALSE;

            $model->save();

            $administrator = Admin::where('role', Admin::ROLE_ADMIN)->firstOrFail();
            $administrator->notify(new NewCategoryNotify($model));

            return redirect()->route($this->getRoute('index'))
                ->with('success', sprintf('Tạo mới: [%s] thành công.', $this->title));

        } catch (\Exception $exception) {
            return back()->withInput($request->all())
                ->withErrors(['Lỗi khi tạo mới: ', $exception->getMessage()]);
        }
    }

    /**
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Category $category)
    {
        $this->authorize('isAuthor', $category);

        return view($this->getView('show'), [
            'title' => sprintf('%s %s', $this->title, $category->name),
            'model' => $category,
        ]);
    }

    /**
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Category $category)
    {
        $this->authorize('isAuthor', $category);

        return view($this->getView('form'), [
            'title' => sprintf('%s: %s', $this->title, $category->name),
            'model' => $category,
        ]);
    }

    /**
     * @param CategoryRequest $request
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $this->authorize('isAuthor', $category);

        try {
            $category->fill($request->all());
            $category->is_activate = $request->get('is_activate', 0) ? Category::BOOLEAN_TRUE : Category::BOOLEAN_FALSE;
            $category->save();

            return redirect()->route($this->getRoute('index'))
                ->with('success', sprintf('Cập nhật: [%s] thành công.', $this->title));

        } catch (\Exception $exception) {
            return back()->withInput($request->all())
                ->withErrors(['cập nhật thất bại', $exception->getMessage()]);
        }
    }

    /**
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);

        try {
            $category->delete();
            return back()->with('success', sprintf('Xóa [%s] thành công.', $category->name));
        } catch (\Exception $exception) {
            return back()->withErrors(['Lỗi khi xóa', $exception->getMessage()]);
        }
    }

    /**
     * @param Category $category
     * @return CategoryResource
     */
    public function resource(Category $category)
    {
        # chạy ngay
        // PageOnLoadJob::dispatchNow();

        # chạy sau 3h (cần phải gọi: php artisan queue:work)
        // PageOnLoadJob::dispatch()->delay(now()->addHours(3));

        return new CategoryResource($category);
    }

}
