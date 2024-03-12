<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$lesson->name}}
        </h2>
        <p>作成日：{{$lesson->createdAt}}</p>
        <p>更新日：{{$lesson->updatedAt}}</p>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-10">
        {!! $lesson->content !!}
    </div>
</x-app-layout>
