<x-app-layout>
    <div class="max-w-[900px] mx-auto py-10 px-[5%] relative">
        <h2 class="text-xl mb-3">学習記録を編集する</h2>
        <x-input-error :messages="$errors->all()" />
        <form action="{{route('records.delete')}}" method="POST" class="absolute right-[15px]">
            @csrf
            @method('delete')
            <input type="hidden" name="id" value="{{$record->id}}">
            <x-secondary-button class="hover:text-red-400" type="submit">削除</x-secondary-button>
        </form>
        <form action="{{route('records.update')}}" method="POST" class="flex flex-col item-left">
            @csrf
            @method('put')
            <table class="my-10">
                <input type="hidden" value="{{$record->id}}" name="id">
               <tr class="mb-3">
                    <th><label for="subject_id">科目</label></th>
                    <td><select name="subject_id" id="subject_id" required>
                        @foreach ($subjects as $subject)
                        <option value="{{$subject->id}}" {{$record->subject_id === $subject->id ? 'selected' : ''}}>{{$subject->name}}</option>
                        @endforeach
                    </select></td>
                </tr>
                <tr class="mb-3">
                    <th><label for="minutes">学習時間（分）</label></th>
                    <td><input type="number" name="minutes" id="minutes" value="{{old('minutes',$record->minutes)}}" required></td>
                </tr>
                <tr class="mb-3">
                    <th><label for="date">日付</label></th>
                    <td><input type="date" id="date" name="date" value="{{old('date',$record->updated_at->format('Y-m-d'))}}" required></td>

                </tr>
                <tr class="mb-3">
                    <th><label for="title">タイトル</label></th>
                    <td><input type="text" id="title" name="title" required class="w-full" placeholder="タイトルを入力してください。" value="{{old('title',$record->title)}}"></td>
                </tr>
                <tr class="mb-3">
                    <th><label for="content">本文</label></th>
                    <td><textarea name="content" id="content" cols="30" rows="10" required class="w-full" placeholder="勉強した範囲や量（第○章、p.17～、テキスト名など）、学んだことなど自由に記述してください。">{{old('content', $record->content)}}</textarea></td>
                </tr>
            </table>

            <x-primary-button class="ml-auto">更新する</x-primary-button>
        </form>
        <a href="{{route('records.index')}}">
            <x-secondary-button>
                一覧へ戻る
            </x-secondary-button>
        </a>
    </div>
</x-app-layout>
