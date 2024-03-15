<?php

namespace App\Listeners;


use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UserRegistered;
use App\Models\Progress;
use App\Models\Lesson;

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

        $lessons = Lesson::moduleLevelOne()
                ->unitLevelOne()
                ->with('module', 'unit')
                ->get();

        foreach($lessons as $lesson) {
            Progress::create([
                'lesson_id' => $lesson->id,
                'user_id'=> $user->id,
                'status' => 'pending'
            ]);
        }
    }
}
