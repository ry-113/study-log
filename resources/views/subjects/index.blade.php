<x-app-layout>
    <div class="max-w-[900px] mx-auto py-10 px-[5%] flex flex-col">
        <x-primary-button class="ml-auto"><a href="/subjects/create">追加 +</a></x-primary-button>
        <h1 class="text-xl">科目一覧</h1>
        @if (count($subjects) > 0)
        <ul class="mt-3 w-[70vw] max-w-[500px] mx-auto">
            @foreach ($subjects as $subject)
                <li class="mt-2 flex justify-between items-center bg-white p-8 rounded-2xl">
                    <span>{{$subject->name}}</span>
                    <form action="/subjects/delete" method="POST">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="subject_id" value="{{$subject->id}}">
                        <x-secondary-button class="hover:text-red-400" type="submit">削除</x-secondary-button>
                    </form>
                </li>
            @endforeach
        </ul>
        @else
        <div class="mt-3">
           <p>現在、科目が登録されていません。</p>
           <p>右上の追加ボタンから作成できます。</p>
        </div>

        @endif
    </div>

</x-app-layout>
