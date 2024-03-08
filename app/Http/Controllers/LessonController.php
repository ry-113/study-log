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
    public function index(string $id): View
    {
        $options = [
            'orders' => ['number'],
            'filters' => "module[equals]{$id}",
        ];
        $lessonsData = $this->microCms->getContents('lessons', $options);
        $units = $this->microCms->getContents('units', $options);

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

    public function show(Request $request): View {
        $lesson = $this->microCms->getSingleContent('lessons', $request->id);

        return view('lessons.show', [
            'lesson' => $lesson,
            'request' => $request
        ]);
    }
}
