<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Record;
use App\Models\Subject;

class ChartController extends Controller
{
    // public function chartGet(Request $request) {
    //     $endDate = new \DateTime();
    //     $startDate = clone $endDate;
    //     $startDate->modify('-6 days');

    //     $startDateStr = $startDate->format('Y-m-d');
    //     $endDateStr = $endDate->format('Y-m-d');

    //     $records = DB::table('records')
    //     ->selectRaw('DATE(date) as date, SUM(minutes) as total_minutes')
    //     ->where('user_id', auth()->id())
    //     ->whereBetween('date', [$startDateStr, $endDateStr])
    //     ->groupBy(DB::raw('Date(date)'))
    //     ->orderBy('date', 'asc')
    //     ->get();



    //     $subjectStudyTimes = DB::table('records')
    //     ->where('user_id', auth()->id())
    //     ->whereBetween('date', [$startDateStr, $endDateStr])
    //     ->groupBy('subject_id')
    //     ->selectRaw('SUM(minutes) as total_minutes, subject_id')
    //     ->orderBy('total_minutes', 'asc')
    //     ->get();

    //     $labels = [];
    //     $data = [];
    //     $colors = [
    //         '#FF6384', '#36A2EB', '#FFCE56', '#8E5EA2', '#FF5733',
    //         '#4BC0C0', '#FF8C00', '#7FFF00', '#6495ED', '#FFD700',
    //         '#DC143C', '#00FFFF', '#FF69B4', '#3CB371', '#FFA07A'
    //     ];

    //     foreach($subjectStudyTimes as $index => $record) {
    //         $subject = Subject::find($record->subject_id);
    //         $labels[] = $subject->name;
    //         $data[] = $record->total_minutes;
    //     }

    //     $colors = array_slice($colors, 0, count($labels));

    //     return response()->json(compact('records', 'labels', 'data', 'colors'));
    // }
}
