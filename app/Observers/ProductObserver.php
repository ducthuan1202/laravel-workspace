<?php

namespace App\Observers;

use App\Entities\Log;
use App\Entities\Product;
use Illuminate\Support\Str;

class ProductObserver
{
    protected $name = 'SẢN PHẨM';

    /**
     * Handle the product "creating" event.
     *
     * @param  \App\Entities\Product $product
     * @return void
     */
    public function creating(Product $product)
    {
        $product->created_by = auth()->id();
        $product->slug = Str::slug($product->name);
    }

    /**
     * Handle the product "created" event.
     *
     * @param  \App\Entities\Product $product
     * @return void
     */
    public function created(Product $product)
    {
//        Log::create([
//            'name' => sprintf('Tạo mới %s', $this->name),
//            'content' => sprintf('Tạo mới %s: <a href="javascript:void(0);"> %s </a>', $this->name, $product->name),
//            'action' => Log::ACTION_CREATE
//        ]);
    }

    /**
     * Handle the product "updated" event.
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
            ->forget(['created_at', 'updated_at'])
            ->toJson();

//        Log::create([
//            'name' => 'Cập nhật DANH MỤC',
//            'content' => sprintf('Cập nhật %s: <a href="javascript:void(0);"> %s </a>', $this->name, $product->name),
//            'old_data' => $diff,
//            'action' => Log::ACTION_UPDATE
//        ]);
    }

    /**
     * Handle the product "deleted" event.
     *
     * @param  \App\Entities\Product $product
     * @return void
     */
    public function deleted(Product $product)
    {
//        Log::create([
//            'name' => 'Xóa DANH MỤC',
//            'content' => sprintf('Xóa %s: <a href="javascript:void(0);"> %s </a>', $this->name, $product->name),
//            'action' => Log::ACTION_DELETE
//        ]);

        /*Mail::send('auth.emails.change_email', ['category' => $product], function ($mail) {
            $mail->from('email_from@gmail.com', 'Tên Người Gửi')
                ->to('email_to@gmail.com', 'Tên Người Nhận')
                ->subject('Tiêu đề của email');
        });*/
    }

}
