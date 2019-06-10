<?php

namespace App\Http\Controllers\Backend;


use App\Entities\Category;
use App\Http\Requests\CategoryRequest;
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
            'model' => $this->repository->getModel(),
            'data' => $this->repository->search($request->all()),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view($this->getView('form'), [
            'title' => sprintf('Tạo mới [%s].', $this->title),
            'model' => $this->repository->getModel(),
        ]);
    }

    /**
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryRequest $request)
    {
        try {

            $this->repository->getModel()->fill($request->all())->save();

            return redirect()->route($this->getRoute('index'))->with('success', sprintf('Tạo mới: [%s] thành công.', $this->title));

        } catch (\Exception $exception) {

            return back()->withInput($request->all())->withErrors(['Lỗi khi tạo mới: ', $exception->getMessage()]);

        }
    }

    /**
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Category $category)
    {
        return view($this->getView('show'), [
            'title' => sprintf('%s %s', $this->title, $category->name),
            'model' => $category,
        ]);
    }

    /**
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Category $category)
    {
        return view($this->getView('form'), [
            'title' => sprintf('%s: %s', $this->title, $category->name),
            'model' => $category,
        ]);
    }

    /**
     * @param CategoryRequest $request
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryRequest $request, Category $category)
    {
        try {

            $this->repository->setModel($category)->fill($request->all())->save();

            return back()->with('success', sprintf('Cập nhật: [%s] thành công.', $this->title));

        } catch (\Exception $exception) {

            return back()->withInput($request->all())->withErrors(['cập nhật thất bại', $exception->getMessage()]);

        }
    }

    /**
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        try {

            $category->delete();

            return back()->with('success', sprintf('Xóa [%s] thành công.', $category->name));

        } catch (\Exception $exception) {

            return back()->withErrors([sprintf('Lỗi khi xóa', $exception->getMessage())]);

        }
    }
}