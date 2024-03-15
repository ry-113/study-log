<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            講座一覧ページ
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-10">
        <x-lb.element.accordion>
            @foreach ($units as $unit)
            @if ($progressUnitIds->contains($unit->id))
            <x-lb.element.accordion.group label="{{$unit->name}}">
                @foreach ($lessons->where('unit_id', $unit->id) as $lesson)
                <p class="hover:underline">
                    <a href="{{route('lessons.show', ['id' => $lesson->id])}}">{{$lesson->name}}</a>
                </p>
                @endforeach
            </x-lb.element.accordion.group> 
            @else  
            <x-lb.element.accordion.group label="{{$unit->name}}" class="opacity-60 pointer-events-none relative" locked="true">
                @foreach ($lessons->where('unit_id', $unit->id) as $lesson)
                <p class="hover:underline opacity-40">
                    <a href="{{route('lessons.show', ['id' => $lesson->id])}}">{{$lesson->name}}</a>
                </p>
                @endforeach
            </x-lb.element.accordion.group> 
            @endif
            @endforeach

        </x-lb.element.accordion>
    </div>
</x-app-layout>
