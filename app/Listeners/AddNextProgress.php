<?php

namespace App\Listeners;

use App\Events\NextStep;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Progress;
use App\Models\Unit;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddNextProgress
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
    public function handle(NextStep $event): void
    {
        $user_id = $event->user_id;
        $unit_id = $event->unit_id;
        $module_id = $event->module_id;

        $unit_level = Unit::where('id', $unit_id)->first()->level;
        $module_level = Module::where('id', $module_id)->first()->level;
        
        //次のユニットがあるか確認、あれば開放、なければ次のモジュールを確認、あれば開放。
        $next_unit_level = $unit_level + 1;
        $nextUnits = Unit::where('module_id', $module_id)
            ->where('level', $next_unit_level)
            ->get();
        if($nextUnits->count() > 0) {
            $lessons = Lesson::where('module_id', $module_id)
                            ->whereIn('unit_id', $nextUnits->pluck('id'))
                            ->get();
            foreach($lessons as $lesson) {
                Progress::create([
                    'lesson_id' => $lesson->id,
                'module_id' => $lesson->module->id,
                'unit_id' => $lesson->unit->id,
                'user_id'=> $user_id,
                'status' => 'pending'
                ]);
            }
        } else {
            $next_module_level = $module_level + 1;
            $nextModules = Module::where('level', $next_module_level)->get();
            if($nextModules->count() > 0) {
                $lessons = Lesson::whereIn('module_id', $nextModules->pluck('id'))
                                ->unitLevelOne()
                                ->with('unit')
                                ->get();
                foreach($lessons as $lesson) {
                    Progress::create([
                        'lesson_id' => $lesson->id,
                    'module_id' => $lesson->module->id,
                    'unit_id' => $lesson->unit->id,
                    'user_id'=> $user_id,
                    'status' => 'pending'
                    ]);
                }
            }
        }
    }
}
