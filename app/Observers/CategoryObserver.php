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
            'name' => 'Tạo mới DANH MỤC',
            'content' => sprintf('Tạo mới danh mục: <a href="javascript:void(0);"> %s </a>', $category->name),
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
            ->forget('created_at')
            ->forget('updated_at')
            ->toJson();

        Log::create([
            'name' => 'Cập nhật DANH MỤC',
            'content' => sprintf('Cập nhật danh mục: <a href="javascript:void(0);"> %s </a>', $category->name),
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
            'name' => 'Xóa DANH MỤC',
            'content' => sprintf('Xóa danh mục: <a href="javascript:void(0);"> %s </a>', $category->name),
            'action' => Log::ACTION_DELETE
        ]);

        /*
         Mail::to(['ducthuan1202@gmail.com'])
            ->cc('hotro247mienphi@gmail.com')
            ->bcc('thuannd@qsoftvietnam.com')
            ->send(new CategoryDeleteMailable($category));
        */

        /**
         * Code gửi email qua Facade Laravel
         * -------------------------------------------------------------------------------------
         * Mail::send('auth.emails.change_email', ['category' => $category], function ($mail) {
         *      $mail->from('email_from@gmail.com', 'Tên Người Gửi')
         *           ->to('email_to@gmail.com', 'Tên Người Nhận')
         *           ->subject('Tiêu đề của email');
         * });
         *
         * Ngoài các thông tin trên, có thể gọi thêm các phương thức khác.
         */
    }

}
