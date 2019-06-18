<?php

namespace App\Notifications;

use App\Admin;
use App\Entities\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewCategoryNotify extends Notification
{
    use Queueable;

    protected $user;
    protected $category;

    /**
     * NewCategoryNotify constructor.
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->user = auth()->user();
        $this->category = $category;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase ($notifiable)
    {

        return [
            'user_id' => $this->user->id,
            'user_name' => $this->user->name,
            'cate_id' => $this->category->id,
            'cate_name' => $this->category->name,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
