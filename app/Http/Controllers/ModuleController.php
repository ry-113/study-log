<?php

namespace App\Http\Controllers;

use App\Services\MicroCmsService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ModuleController extends Controller
{
    private MicroCmsService $microCms;

    public function __construct(MicroCmsService $microCms)
    {
        $this->microCms = $microCms;
    }

    public function index(): View {
        $options = [
            'orders' => ['level'],
        ];
        $modules = $this->microCms->getContents('modules', $options);
        return view('modules.index', compact('modules'));
    }
}
