<?php

namespace App\Listeners;


use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UserRegistered;
use App\Models\Progress;

class SaveInitialProgress
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        $user = $event->user;
        Progress::create([
            'lesson_id' => '07i6lkfsj',
            'user_id'=> $user->id,
            'status' => 'pending'
        ]);
        //ここに保存したいテーブルへのデータ保存処理を記述
    }
}
