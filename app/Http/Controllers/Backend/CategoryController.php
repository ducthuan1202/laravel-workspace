<?php

namespace App\Http\Controllers\Backend;


use App\Entities\Category;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Backend
 * ---------------------------------------------------------
 * @property CategoryRepository $repository
 */
class CategoryController extends BackendController
{
    protected $repository;

    /**
     * CategoryController constructor.
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->title = 'Danh mục';
        $this->viewFolder = 'category';
        $this->routePrefix = 'categories';
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view($this->getView('index'), [
            'title' => sprintf('Danh sách [%s]', $this->title),
            'params' => $request->all(),
            'model' => new Category(),
            'data' => $this->repository->search($request->all()),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Category::class);

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
        $this->authorize('store', Category::class);

        try {

            $model = new Category();
            $model->fill($request->all())->save();

            return redirect()->route($this->getRoute('index'))->with('success', sprintf('Tạo mới: [%s] thành công.', $this->title));

        } catch (\Exception $exception) {

            return back()->withInput($request->all())->withErrors(['Lỗi khi tạo mới: ', $exception->getMessage()]);

        }
    }

    /**
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Category $category)
    {
        $this->authorize('view', $category);

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

        $this->authorize('edit', $category);

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
        $this->authorize('update', $category);

        try {

            $category->fill($request->all())->save();

            return back()->with('success', sprintf('Cập nhật: [%s] thành công.', $this->title));

        } catch (\Exception $exception) {

            return back()->withInput($request->all())->withErrors(['cập nhật thất bại', $exception->getMessage()]);

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
        return new CategoryResource($category);
    }
}
