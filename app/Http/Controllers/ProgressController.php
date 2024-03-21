<?php

namespace App\Http\Controllers;

use App\Events\NextStep;
use Illuminate\Http\Request;
use App\Models\Progress;
use App\Models\Lesson;
use App\Notifications\ProgressStatusNotification;


class ProgressController extends Controller
{
    public function index(Request $request) {
        $status = $request->input('status');
        $searchQuery = $request->input('search');
        $loading = true;
        $progresses = Progress::query();
        if($status) {
            $progresses->where('status', $status);
        }
        if ($searchQuery) {
            $progresses = $progresses
                ->whereHas('user', function ($query) use ($searchQuery) {
                    $query->where('name', 'like', "%{$searchQuery}%");
                })
                ->orWhereHas('lesson', function ($query) use ($searchQuery) {
                    $query->where('name', 'like', "%{$searchQuery}%");
                });
        }
        
        $progresses = $progresses->orderBy('updated_at', 'desc')->paginate(10);
        $loading = false;
        return view('progress.index', compact('progresses', 'loading'));
    }

    public function show(Progress $progress) {
        return view('progress.show', compact('progress'));
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
        
        $module_id = $progress->module_id;
        $unit_id = $progress->unit_id;

        $progresses = Progress::where('user_id', $user_id)
                            ->where('unit_id', $unit_id)
                            ->get();
        $allApproved = true;
        foreach($progresses as $progress) {
            if($progress->status !== 'approved') {
                $allApproved = false;
                break;
            }
        }
        if($allApproved) {
            event(new NextStep($user_id, $unit_id, $module_id));
        }

        if($status === 'completed') {
            return redirect()->route('lesson.next', ['lesson_id' => $lesson_id]);
        } elseif ($status === 'approved') {
            return redirect()->route('progress.index')->with('success', '訓練生の講座完了を承認しました。');
        }
    }
}
