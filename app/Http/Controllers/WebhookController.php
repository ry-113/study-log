<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Module;
use App\Models\Unit;
use App\Models\Lesson;

class WebhookController extends Controller
{
    public function handleModuleWebhook(Request $request) {
        Log::info('Module Webhook:', $request->all());
        $body = $request->all();
        $contentId = $body['id'];
        $contentData = $body['contents']['new']['publishValue'];
        Log::info($contentData);
        $module = Module::updateOrCreate(
            ['id' => $contentId],
            $contentData
        );
        if($module->wasRecentlyCreated) {
            //新規作成後の処理
        } else {
            //更新後の処理
        }
        return response()->noContent();
    }

    public function handleUnitWebhook(Request $request) {
        Log::info('Unit Webhook:', $request->all());
        $body = $request->all();
        $contentId = $body['id'];
        $contentData = $body['contents']['new']['publishValue'];
        Log::info($contentData);
        $unit = Unit::updateOrCreate(
            ['id' => $contentId],
            [
                'id' => $contentData['id'],
                'module_id' => $contentData['module']['id'],
                'level' => $contentData['level'],
                'name' => $contentData['name'],
                'achievement' => $contentData['achievement'],
                'description' => $contentData['description'] ?? null,
            ]
        );
        if($unit->wasRecentlyCreated) {
            //新規作成後の処理
        } else {
            //更新後の処理
        }
        return response()->noContent();
    }

    public function handleLessonWebhook(Request $request) {
        Log::info('Lesson Webhook:', $request->all());
        $body = $request->all();
        $contentId = $body['id'];
        $contentData = $body['contents']['new']['publishValue'];
        Log::info($contentData);
        $lesson = Lesson::updateOrCreate(
            ['id' => $contentId],
            [
                'id' => $contentData['id'],
                'module_id' => $contentData['module']['id'],
                'unit_id' => $contentData['unit']['id'],
                'level' => $contentData['level'],
                'name' => $contentData['name'],
                'achievement' => $contentData['achievement'],
                'description' => $contentData['description'] ?? null,
            ]
        );
        if($lesson->wasRecentlyCreated) {
            //新規作成後の処理
        } else {
            //更新後の処理
        }
        return response()->noContent();
    }
}
