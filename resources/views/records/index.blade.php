<x-app-layout>
<div class="max-w-[900px] mx-auto py-10 px-[5%]">
    @if (count($records) > 0)
    <ol class="relative border-s border-gray-200 dark:border-gray-700">
        @foreach ($records as $record)
            <li class="mb-10 ms-6">
                <a href="{{route('records.edit',['record' => $record]) }}">
                    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-700 dark:border-gray-600">
                        <div class="items-start justify-between mb-3 sm:flex">
                            <div class="text-lg text-gray-500 dark:text-gray-300">{{$record->title}}</div>
                            <div class="flex flex-col gap-1">
                                <time class="mb-1 text-sm font-normal text-gray-400 sm:order-last sm:mb-0">学習日：{{$record->date}}</time>
                                <time class="mb-1 text-sm font-normal text-gray-400 sm:order-last sm:mb-0">更新：{{$record->updated_at->format('Y-m-d H:i')}}</time>
                            </div>
                        </div>
                        <div class="p-3 font-normal text-gray-500 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-600 dark:border-gray-500 dark:text-gray-300">
                            <p>{{$record->subject->name}}</p>
                            <p>{{$record->minutes}}分</p>
                            <p>{{$record->content}}</p>
                        </div>
                    </div>
                </a>
            </li>
        @endforeach
    </ol>
    @else
    <p class="text-gray-500 absolute top-[50%] left-[50%] translate-x-[-50%]">学習記録がありません。「新しい記録」タブから追加できます。</p>
    @endif

    <div class="mt-1 mb-1 row justify-content-center">
        {{ $records->links() }}
    </div>
</div>

</x-app-layout>
