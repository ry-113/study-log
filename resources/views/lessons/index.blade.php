<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            講座一覧ページ
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-10">
        <x-lb.element.accordion>
            @foreach ($units as $unit)
            <x-lb.element.accordion.group label="{{$unit->name}}">
                @if (isset($lessons[$unit->id]))
                    @foreach ($lessons[$unit->id] as $lesson)
                    <p class="hover:underline"><a href="{{route('lessons.show', $lesson->id)}}">{{$lesson->title}}</a></p>
                    @endforeach
                @endif
            </x-lb.element.accordion.group>
            @endforeach

        </x-lb.element.accordion>
    </div>
</x-app-layout>
