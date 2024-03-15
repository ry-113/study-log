<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            モジュール一覧ページ
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-10">
        @foreach ($modules as $module)
            @if ($progressModuleIds->contains($module->id))
                <a href="{{route('lessons.index', $module->id)}}">
                    <div class="bg-white py-10 px-5 rounded-xl my-10">
                        <p class="m-0">{{$module->number}} {{$module->name}}</p>
                    </div>
                </a>
            @else
                <a href="#">
                    <div class="bg-white py-10 px-5 rounded-xl my-10">
                        <p class="m-0">{{$module->number}} {{$module->name}}</p>
                    </div>
                </a>
            @endif
        @endforeach
    </div>
</x-app-layout>
