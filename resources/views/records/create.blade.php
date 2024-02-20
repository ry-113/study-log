<x-app-layout>
   <div class="max-w-[900px] mx-auto py-10 px-[5%]">
        <h2 class="text-xl mb-3">学習記録を追加する</h2>
        <p>注：科目を登録していない場合は「科目の管理」タブから追加して下さい。</p>
        <x-input-error :messages="$errors->all()" />
        <form action="{{route('records.store')}}" method="POST" class="flex flex-col item-left">
            @csrf
            <table class="my-10">
               <tr class="mb-3">
                    <th><label for="subject_id">科目</label></th>
                    <td><select name="subject_id" id="subject_id" required>
                        <option value="">選択してください</option>
                        @foreach ($subjects as $subject)
                        <option value="{{$subject->id}}">{{$subject->name}}</option>
                        @endforeach
                    </select></td>
                </tr>
                <tr class="mb-3">
                    <th><label for="minutes">学習時間（分）</label></th>
                    <td><input type="number" name="minutes" id="minutes" required value="{{old('minutes')}}"></td>
                </tr>
                <tr class="mb-3">
                    <th><label for="date">日付</label></th>
                    <td><input type="date" id="date" name="date" required value="{{old('date')}}"></td>

                </tr>
                <tr class="mb-3">
                    <th><label for="title">タイトル</label></th>
                    <td><input type="text" id="title" name="title" required class="w-full" placeholder="タイトルを入力してください。" value="{{old('title')}}"></td>
                </tr>
                <tr class="mb-3">
                    <th><label for="content">本文</label></th>
                    <td><textarea name="content" id="content" cols="30" rows="10" required class="w-full" placeholder="勉強した範囲や量（第○章、p.17～、テキスト名など）、学んだことなど自由に記述してください。">{{old('content')}}</textarea></td>
                </tr>
            </table>

            <x-primary-button class="ml-auto">記録する</x-primary-button>
        </form>
    </div>
</x-app-layout>


