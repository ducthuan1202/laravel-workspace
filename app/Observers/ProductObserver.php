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
     * @param \App\Entities\Product $product
     * @return void
     */
    public function creating(Product $product)
    {
        $product->created_by = auth()->id();
        $product->slug = Str::slug($product->name);
    }

    /**
     * Handle the product "saving" event.
     *
     * @param Product $product
     */
    public function saving(Product $product)
    {
        $product->is_feature = request()->is_feature ? Product::IS_FEATURE : Product::IS_NOT_FEATURE;
        $product->status = request()->status ? Product::STATUS_ACTIVATE : Product::STATUS_DEACTIVATE;
    }

    /**
     * Handle the product "created" event.
     *
     * @param \App\Entities\Product $product
     * @return void
     */
    public function created(Product $product)
    {
        Log::create([
            'name' => sprintf('Tạo mới %s', $this->name),
            'content' => sprintf('Tạo mới <a href="javascript:void(0);"> %s </a>', $product->name),
            'action' => Log::ACTION_CREATE
        ]);
    }

    /**
     * Handle the product "updated" event.
     *
     * @param \App\Entities\Product $product
     * @return void
     */
    public function updated(Product $product)
    {
        Log::create([
            'name' => 'Cập nhật ' . $this->name,
            'content' => sprintf('<a href="javascript:void(0);"> %s </a>', $product->name),
            'old_data' => collect($product->getOriginal())->diff($product->getAttributes())->forget(['created_at', 'updated_at'])->toJson(),
            'action' => Log::ACTION_UPDATE
        ]);
    }

    /**
     * Handle the product "deleted" event.
     *
     * @param \App\Entities\Product $product
     * @return void
     */
    public function deleted(Product $product)
    {
        Log::create([
            'name' => 'Xóa ' . $this->name,
            'content' => sprintf('<a href="javascript:void(0);"> %s </a>', $product->name),
            'action' => Log::ACTION_DELETE
        ]);

        /*Mail::send('auth.emails.change_email', ['category' => $product], function ($mail) {
            $mail->from('email_from@gmail.com', 'Tên Người Gửi')
                ->to('email_to@gmail.com', 'Tên Người Nhận')
                ->subject('Tiêu đề của email');
        });*/
    }

}
