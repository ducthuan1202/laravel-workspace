<?php

namespace App\Observers;

use App\Entities\Category;
use App\Entities\Log;
use App\Mail\CategoryDeleteMailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CategoryObserver
{

    /**
     * Handle the category "creating" event.
     *
     * @param  \App\Entities\Category  $category
     * @return void
     */
    public function creating(Category $category)
    {
        $category->created_by = 1;
        $category->slug = Str::slug($category->name);
    }

    /**
     * Handle the category "created" event.
     *
     * @param  \App\Entities\Category  $category
     * @return void
     */
    public function created(Category $category)
    {
        Log::create([
            'name'=> 'Tạo mới DANH MỤC',
            'content'=> sprintf('Tạo mới danh mục: <a href="%s"> %s </a>', admin_route('categories.show', $category), $category->name),
            'action'=> Log::ACTION_CREATE
        ]);
    }

    /**
     * Handle the category "updated" event.
     *
     * @param  \App\Entities\Category  $category
     * @return void
     */
    public function updated(Category $category)
    {
        Log::create([
            'name'=> 'Cập nhật DANH MỤC',
            'content'=> sprintf('Cập nhật danh mục: <a href="%s"> %s </a>', admin_route('categories.show', $category), $category->name),
            'action'=> Log::ACTION_UPDATE
        ]);
    }

    /**
     * Handle the category "deleted" event.
     *
     * @param  \App\Entities\Category  $category
     * @return void
     */
    public function deleted(Category $category)
    {
        Log::create([
            'name'=> 'xóa DANH MỤC',
            'content'=> sprintf('Xóa danh mục: %s', $category->name),
            'action'=> Log::ACTION_DELETE
        ]);

        Mail::to('ducthuan1202@gmail.com')->send(new CategoryDeleteMailable($category));
    }

    /**
     * Handle the category "restored" event.
     *
     * @param  \App\Entities\Category  $category
     * @return void
     */
    public function restored(Category $category)
    {
        //
    }

    /**
     * Handle the category "force deleted" event.
     *
     * @param  \App\Entities\Category  $category
     * @return void
     */
    public function forceDeleted(Category $category)
    {
        //
    }
}
