<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Requests\RecordRequest;

class RecordController extends Controller
{
    public function board() {
        $records = Record::orderBy('updated_at', 'desc')->paginate(10);
        return view('records.board', compact('records'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Record::where('user_id', auth()->id())->orderBy('updated_at', 'desc')->paginate(4);
        return view('records.index', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::where('user_id', auth()->id())->get();
        return view('records.create', ['subjects' => $subjects]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RecordRequest $request)
    {
        Record::create([
            'user_id' => auth()->id(),
            'subject_id' => $request->subject_id,
            'minutes' => $request->minutes,
            'date' => $request->date,
            'title' => $request->title,
            'content' => $request->content
        ]);

        return redirect()->route('records.index')->with('success', '学習記録を保存しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(Record $record)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Record $record)
    {
        $subjects = Subject::where('user_id', auth()->id())->get();
        return view('records.edit', compact('record', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RecordRequest $request, Record $record)
    {
        $record = Record::find($request->id);
        $record->update([
            'user_id' => auth()->id(),
            'subject_id' => $request->subject_id,
            'minutes' => $request->minutes,
            'date' => $request->date,
            'title' => $request->title,
            'content' => $request->content
        ]);
        return redirect()->route('records.index')->with('success', 'データを更新しました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Record $record, Request $request)
    {
        Record::find($request->id)->delete();
        return redirect()->route('records.index')->with('success', '削除しました。');
    }
}
