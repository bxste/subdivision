<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Notifications\UserFollowNotification;
use App\Models\User;
use Notification;
use App\notifications\SendEmailNotification;
use App\Mail\EventCreated;

class NotificationController extends Controller
{
    public function sendnotification()
    {
        $user=User::all();
        $details=[
            'greeting'=>'Hi laravel Developer',
            'body'=>'This is the body',
            'actiontext'=>'sub',
            'actionurl'=>'/',
            'lastline'=>'this is the last line',
        ];
        dd('done');
    }
}
