<x-app-layout>
    <div class="max-w-[900px] mx-auto py-10 px-[5%]">
         <h2 class="text-xl mb-3">科目を追加する</h2>
         <x-input-error :messages="$errors->all()" />
         <form action="{{route('subjects.store')}}" method="POST" class="flex flex-col items-center">
             @csrf
             <div class="mb-3">
                 <label for="name">科目名</label>
                 <input type="text" id="name" name="name" required value="{{old('name')}}">
             </div>

             <x-primary-button class="ml-auto">追加する</x-primary-button>
         </form>
        <a href="{{route('subjects.index')}}">
            <x-secondary-button>
                一覧へ戻る
            </x-secondary-button>
        </a>
     </div>
 </x-app-layout>
