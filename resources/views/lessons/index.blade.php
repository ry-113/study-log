<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            講座一覧ページ
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-10">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @foreach ($lessons as $lesson)
            <div>
                <p>タイトル {{$lesson->title}}</p>
                <p>概要 {{$lesson->description}}</p>
                <p><span>モジュール：{{$lesson->module[0]}} - 単元名：{{$lesson->unit[0]}} - カテゴリー：{{$lesson->category[0]}}</span></p>
                <p>到達目標：{{$lesson->achievement[0]}}</p>
                <p>内容 {!! $lesson->content !!}</p>
            </div>
        @endforeach
    </div>
</x-app-layout>
