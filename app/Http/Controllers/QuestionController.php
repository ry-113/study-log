<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\QuestionNotification;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class QuestionController extends Controller
{
    public function notify(Request $request) {
        $user = $request->user();
        $lesson = $request->lesson;
        $question = $request->input('question');
        $user->notify(new QuestionNotification($user, $lesson, $question));

        return redirect()->back()->with('success', '質問を送信しました');
    }
}
