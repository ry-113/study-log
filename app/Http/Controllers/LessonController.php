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
        $lessons = $this->microCms->getContents('lessons');

        return view('lessons.index', [
            'lessons' => $lessons,
        ]);
    }
}
