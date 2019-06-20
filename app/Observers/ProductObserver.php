<?php

namespace App\Observers;

use App\Entities\Category;
use App\Entities\Log;
use App\Entities\Product;
use App\Mail\CategoryDeleteMailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ProductObserver
{

    /**
     * Handle the category "creating" event.
     *
     * @param  \App\Entities\Product $product
     * @return void
     */
    public function creating(Product $product)
    {
        $product->created_by = rand(1, 9);
        $product->slug = Str::slug($product->name);
    }

    /**
     * Handle the category "created" event.
     *
     * @param  \App\Entities\Product $product
     * @return void
     */
    public function created(Product $product)
    {
        Log::create([
            'name' => 'Tạo mới DANH MỤC',
            'content' => sprintf('Tạo mới SẢN PHẨM: <a href="javascript:void(0);"> %s </a>', $product->name),
            'action' => Log::ACTION_CREATE
        ]);
    }

    /**
     * Handle the category "updated" event.
     *
     * @param  \App\Entities\Product $product
     * @return void
     */
    public function updated(Product $product)
    {
        $original = $product->getOriginal();
        $attributes = $product->getAttributes();

        $diff = collect($original)
            ->diff($attributes)
            ->forget('created_at')
            ->forget('updated_at')
            ->toJson();

        Log::create([
            'name' => 'Cập nhật DANH MỤC',
            'content' => sprintf('Cập nhật SẢN PHẨM: <a href="javascript:void(0);"> %s </a>', $product->name),
            'old_data' => $diff,
            'action' => Log::ACTION_UPDATE
        ]);
    }

    /**
     * Handle the category "deleted" event.
     *
     * @param  \App\Entities\Product $product
     * @return void
     */
    public function deleted(Product $product)
    {
        Log::create([
            'name' => 'Xóa DANH MỤC',
            'content' => sprintf('Xóa SẢN PHẨM: <a href="javascript:void(0);"> %s </a>', $product->name),
            'action' => Log::ACTION_DELETE
        ]);

        /*Mail::send('auth.emails.change_email', ['category' => $product], function ($mail) {
            $mail->from('email_from@gmail.com', 'Tên Người Gửi')
                ->to('email_to@gmail.com', 'Tên Người Nhận')
                ->subject('Tiêu đề của email');
        });*/
    }

}
