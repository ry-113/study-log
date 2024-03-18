<?php

namespace App\Http\Controllers;

use App\Services\MicroCmsService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Lesson;
use App\Models\Unit;
use App\Models\Progress;

class LessonController extends Controller
{
    private MicroCmsService $microCms;

    public function __construct(MicroCmsService $microCms)
    {
        $this->microCms = $microCms;
    }

    /**
     * 記事一覧を取得
     * @return View
     */
    public function index(string $id): View
    {
        $lessons = Lesson::with('unit')->whereHas('unit', function ($query) use ($id) {
            $query->where('module_id', $id);
        })->orderBy('level')->get();
        $units = Unit::where('module_id', $id)->orderBy('level')->get();

        $progressUnitIds = Progress::where('user_id', auth()->id())
            ->distinct('unit_id')
            ->pluck('unit_id');
        
        return view('lessons.index',compact('lessons', 'units', 'progressUnitIds'));
    }

    public function show(Request $request): View {
        $lesson = $this->microCms->getSingleContent('lessons', $request->id);

        return view('lessons.show', compact('lesson', 'request'));
    }

    public function next(Request $request) {
        $lesson_id = $request->lesson_id;
        //現在の講座情報を取得
        $currentLesson = Lesson::where('id', $lesson_id)->first();
        $module_id = $currentLesson->module_id;
        $unit_id = $currentLesson->unit_id;
        $level = $currentLesson->level;
        
        //次にやるべき講座を取得
        $nextLevel = $level + 1;
        $nextLesson = Lesson::where('module_id', $module_id)
                        ->where('unit_id', $unit_id)
                        ->where('level', $nextLevel)
                        ->first();
        if($nextLesson) {
            return redirect()->route('lessons.show', ['id' => $nextLesson->id]);
        } else {
            return redirect()->route('lessons.index', ['module_id' => $module_id])->with('success', 'この単元の講座がすべて終了しました。指導員のチェックが終了次第、次の単元が解放されます。');
        }
    }
}
