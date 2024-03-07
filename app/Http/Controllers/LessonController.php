<?php

namespace App\Http\Controllers;

use App\Services\MicroCmsService;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
    public function index(): View
    {
        $lessonsData = $this->microCms->getContents('lessons');
        $units = $this->microCms->getContents('units');

        //取得したlessonsDataをunit_idごとにグルーピング
        $lessons = [];
        foreach ($lessonsData as $lesson) {
            $unitId = $lesson->unit->id;

            if (!isset($lessons[$unitId])) {
                $lessons[$unitId] = [];
            }

            $lessons[$unitId][] = $lesson;
        }
        
        return view('lessons.index', [
            'lessons' => $lessons,
            'units' => $units
        ]);
    }

    public function show(Request $request, string $id): View {
        $lesson = $this->microCms->getSingleContent('lessons', $id);

        return view('lessons.show', [
            'lesson' => $lesson,
            'request' => $request
        ]);
    }
}
