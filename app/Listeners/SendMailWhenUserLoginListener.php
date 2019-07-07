<?php

namespace App\Listeners;

use App\Events\SendMailWhenUserLoginEvent;
use Illuminate\Support\Facades\Mail;

class SendMailWhenUserLoginListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle(SendMailWhenUserLoginEvent $event)
    {
        Mail::send('backend.mail_template.login', [
            'title' => 'CẢNH BÁO ĐĂNG NHẬP',
            'userLogin' => $event->user,
            'ip' => request()->ip(),
            'userAgent' => request()->userAgent(),
        ], function ($mail) {
            $mail->from('seeder6789@gmail.com', 'Hệ thống')
                ->to('ducthuan1202@gmail.com', 'Admin hệ thống')
                ->subject('Thành viên đăng nhập hệ thống');
        });
    }
}
