<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            進捗一覧ページ
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-10">
        @foreach ($progresses as $progress)
            <p>{{$progress}}</p>
            {{-- ここにテーブルを作る --}}
        @endforeach
        <div>
            {{$progresses->links()}}
        </div>
    </div>
</x-app-layout>
