<?php

namespace App\Http\Controllers;

use App\Services\MicroCmsService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Module;
use App\Models\Progress;

class ModuleController extends Controller
{
    public function index(): View {
        $progressModuleIds = Progress::where('user_id', auth()->id())
            ->distinct('module_id')
            ->pluck('module_id');

        $modules = Module::orderBy('level')->get();
        return view('modules.index', compact('modules', 'progressModuleIds'));
    }
}
