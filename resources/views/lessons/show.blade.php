<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$lesson->name}}
        </h2>
        <p>作成日：{{$lesson->createdAt}}</p>
        <p>更新日：{{$lesson->updatedAt}}</p>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-10">
        <div>
           {!! $lesson->content !!}
        </div>

        <form action="{{ route('notify', ['lesson' => $lesson]) }}" method="post" class="bg-white p-10 rounded-lg">
            @csrf
            <x-input-label for="question">質問文がある方はこちらに入力して送信してください。</x-input-label>
            <textarea name="question" id="question" class="w-full h-40"></textarea>
            <br>
            <x-secondary-button type="submit">送信</x-secondary-button>
        </form>

        <form action="{{route('progress.update',['lesson_id' => $lesson->id, 'status' => 'completed'])}}" method="POST" class="flex justify-end my-5">
            @csrf
            @method('patch')
            <x-primary-button>次の講座へ進む ></x-primary-button>
        </form>

    </div>
</x-app-layout>
