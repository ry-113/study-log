<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            進捗詳細ページ
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-10">
        <p>氏名：{{$progress->user->name}}</p>
        <p>モジュール名：{{$progress->module->number}} {{$progress->module->name}}</p>
        <p>講座名：{{$progress->lesson->name}}</p>
        @switch($progress->status)
            @case('pending')
                <x-lb.element.badge color="sunflower" label="進行中" />
            @break

            @case('completed')
                <x-lb.element.badge color="emerald" label="承認待ち" />
            @break

            @case('approved')
                <x-lb.element.badge color="river" label="承認済み" />
            @break
        @endswitch
        <div class="flex justify-between my-10">
            <x-secondary-button>
                <a href="{{route('progress.index')}}"> < 一覧へ戻る</a>
            </x-secondary-button>
            @if ($progress->status === 'completed')
               <form action="{{route('progress.update', ['lesson_id' => $progress->lesson_id, 'status' => 'approved'])}}" method="POST">
                    @csrf
                    @method('patch')
                    <x-secondary-button type="submit">
                    承認する 
                    </x-secondary-button>
                </form> 
            @endif
            
            
        </div>
    </div>
</x-app-layout>