<?php

namespace App\Mail;

use App\Entities\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CategoryDeleteMailable extends Mailable
{
    use Queueable, SerializesModels;

    protected $category;

    /**
     * CategoryDelete constructor.
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Xóa Danh Mục')
            ->view('backend.mail_template.delete_category', [
                'category'=>$this->category
            ]);
    }
}
