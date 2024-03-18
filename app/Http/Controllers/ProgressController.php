<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Progress;
use App\Models\Lesson;
use App\Notifications\ProgressStatusNotification;


class ProgressController extends Controller
{
    public function index(Request $request) {
        $progresses = Progress::orderBy('updated_at', 'desc')->paginate(10);
        return view('progress.index', compact('progresses'));
    }

    public function update(Request $request) {
        //進捗の更新
        $user_id = auth()->id();
        $lesson_id = $request->lesson_id;
        $status = $request->status;
        $progress = Progress::where('user_id', $user_id)
                    ->where('lesson_id', $lesson_id)
                    ->whereIn('status', ['pending', 'completed'])
                    ->first();

        if($progress) {
           $progress->status = $status;
           $progress->save();
           $user = $request->user();
           $lesson = Lesson::where('id', $lesson_id)->first();
           $user->notify(new ProgressStatusNotification($user, $lesson, $status));
        }

        return redirect()->route('lesson.next', ['lesson_id' => $lesson_id]);
    }
}
