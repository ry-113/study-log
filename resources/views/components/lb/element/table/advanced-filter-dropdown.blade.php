<x-lb.element.popover position="top-0 w-[300px] mt-10 right-0">
    <x-slot name="trigger">
        <x-lb.element.button.primary>
            フィルター
            <x-lb.heroicon.s-funnel></x-lb.heroicon.s-funnel>
        </x-lb.element.button.primary>  
    </x-slot>

    <form action="{{route('progress.index')}}">
        <div class="form-group">
            <label for="status">ステータス</label>
            <select name="status" id="status" class="form-control">
                <option value="">全て</option>
                <option value="pending">進行中</option>
                <option value="completed">承認待ち</option>
                <option value="approved">承認済み</option>
            </select>
        </div>
        <div class="form-group">
            <label for="search"></label>
            <input type="text" name="search" id="search" class="form-control">
        </div>
        <div class="flex justify-end">
            <x-secondary-button type="submit">検索</x-secondary-button>
        </div>
    </form>
</x-lb.element.popover>
