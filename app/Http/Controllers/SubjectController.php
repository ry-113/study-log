<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Requests\SubjectRequest;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::where('user_id', auth()->id())->get();
        return view('subjects.index', ['subjects' => $subjects]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubjectRequest $request)
    {
        Subject::create([
            'user_id' => auth()->id(),
            'name' => $request->name
        ]);

        return redirect()->route('subjects.index')->with('success', '科目を追加しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject, Request $request)
    {
        Subject::where('id', $request->subject_id)->delete();
        return redirect()->route('subjects.index')->with('success', '削除しました。');
    }
}
