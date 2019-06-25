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
     * @param  \App\Entities\Category $category
     * @return void
     */
    public function creating(Category $category)
    {
        $category->created_by = rand(1, 9);
        $category->slug = Str::slug($category->name);
    }

    /**
     * Handle the category "created" event.
     *
     * @param  \App\Entities\Category $category
     * @return void
     */
    public function created(Category $category)
    {
        Log::create([
            'name' => sprintf('Tạo mới %s', $this->name),
            'content' => sprintf('Tạo mới %s: <a href="javascript:void(0);"> %s </a>', $this->name, $category->name),
            'action' => Log::ACTION_CREATE
        ]);
    }

    /**
     * Handle the category "updated" event.
     *
     * @param  \App\Entities\Category $category
     * @return void
     */
    public function updated(Category $category)
    {
        $original = $category->getOriginal();
        $attributes = $category->getAttributes();

        $diff = collect($original)
            ->diff($attributes)
            ->forget(['created_at', 'updated_at'])
            ->toJson();

        Log::create([
            'name' => sprintf('Cập nhật %s', $this->name),
            'content' => sprintf('Cập nhật %s: <a href="javascript:void(0);"> %s </a>', $this->name, $category->name),
            'old_data' => $diff,
            'action' => Log::ACTION_UPDATE
        ]);
    }

    /**
     * Handle the category "deleted" event.
     *
     * @param  \App\Entities\Category $category
     * @return void
     */
    public function deleted(Category $category)
    {
        Log::create([
            'name' => sprintf('Xóa %s', $this->name),
            'content' => sprintf('Xóa %s: <a href="javascript:void(0);"> %s </a>', $this->name, $category->name),
            'action' => Log::ACTION_DELETE
        ]);
    }

}
