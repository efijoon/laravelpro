<?php

namespace App\Notifications\Channels;

use Illuminate\Notifications\Notification;
use Cryptommer\Smsir\Smsir;
use \Cryptommer\Smsir\Objects\Parameters;

class SmsChannel
{
    public function send($notifable, Notification $notification)
    {
        $send = smsir::Send();

        $parameter = new Parameters('code', $notification->code);

        $send->Verify($notification->phone_number, 100000, array($parameter));
//      $send->bulk($notification->message, [$notification->phone_number], time(), env('SMSIR_LINE_NUMBER'));
    }
}
