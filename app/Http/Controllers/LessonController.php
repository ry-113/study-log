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
}
