<?php

namespace App\Observers;

use App\Entities\Category;
use App\Entities\Log;
use Illuminate\Support\Str;

class CategoryObserver
{
    protected $name = 'DANH MỤC';

    /**
     * Handle the category "creating" event.
     *
     * @param \App\Entities\Category $category
     * @return void
     */
    public function creating(Category $category)
    {
        $category->created_by = auth()->id();
        $category->slug = Str::slug($category->name);
    }

    /**
     * Handle the category "creating" event.
     *
     * @param Category $category
     */
    public function saving(Category $category)
    {
        $category->is_activate = request()->get('is_activate', 0) ? Category::BOOLEAN_TRUE : Category::BOOLEAN_FALSE;
    }

    /**
     * Handle the category "created" event.
     *
     * @param \App\Entities\Category $category
     * @return void
     */
    public function created(Category $category)
    {
        Log::create([
            'name' => sprintf('Tạo mới %s', $this->name),
            'content' => sprintf('<a href="javascript:void(0);"> %s </a>', $category->name),
            'action' => Log::ACTION_CREATE
        ]);
    }

    /**
     * Handle the category "updated" event.
     *
     * @param \App\Entities\Category $category
     * @return void
     */
    public function updated(Category $category)
    {
        Log::create([
            'name' => sprintf('Cập nhật %s', $this->name),
            'content' => sprintf('<a href="javascript:void(0);"> %s </a>', $category->name),
            'old_data' => collect($category->getOriginal())->diff($category->getAttributes())->forget(['created_at', 'updated_at'])->toJson(),
            'action' => Log::ACTION_UPDATE
        ]);
    }

    /**
     * Handle the category "deleted" event.
     *
     * @param \App\Entities\Category $category
     * @return void
     */
    public function deleted(Category $category)
    {
        Log::create([
            'name' => sprintf('Xóa %s', $this->name),
            'content' => sprintf('<a href="javascript:void(0);"> %s </a>', $category->name),
            'action' => Log::ACTION_DELETE
        ]);
    }

}
