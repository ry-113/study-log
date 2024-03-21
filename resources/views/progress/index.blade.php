<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            進捗一覧ページ
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-10">
        <div class="w-full" wire:init="initialize">
            @if (!$loading)
                
                <x-lb.element.table>
                    <x-slot name="header">
                        <x-lb.element.table.header title="訓練生の進捗一覧" description="課題チェック後の承認もここで行うことができます。">
                            {{-- <x-lb.element.table.search-bar /> --}}
                            <x-lb.element.table.advanced-filter-dropdown />
                        </x-lb.element.table.header>
                    </x-slot>
        
                    <x-slot name="thead">
                        <x-lb.element.table.head>ユーザー名</x-lb.element.table.head>
                        <x-lb.element.table.head class="hidden lg:table-cell">ステータス</x-lb.element.table.head>
                        <x-lb.element.table.head class="hidden lg:table-cell">モジュール・単元</x-lb.element.table.head>
                        <x-lb.element.table.head class="hidden lg:table-cell">講座</x-lb.element.table.head>
                        <x-lb.element.table.head>更新日</x-lb.element.table.head>
                        <x-lb.element.table.head></x-lb.element.table.head>
                    </x-slot>
        
                    <x-slot name="tbody">
                        
                        @foreach ($progresses as $progress)
                        
                            <x-lb.element.table.row class="hover:bg-gray-100">
                                <x-lb.element.table.cell>
                                    <div class="flex space-x-2">
                                        <x-lb.extra.avatar size="xs" name="{{ $progress->user }}"
                                             src="{{ str_starts_with(Auth::user()->profile_photo_path, 'http') ? Auth::user()->profile_photo_path : asset('storage/' . Auth::user()->profile_photo_path) }}" />
                                        <span class="text-sm font-medium leading-7 text-gray-900">
                                            {{ $progress->user->name }}
                                        </span>
                                    </div>
                                </x-lb.element.table.cell>
                                <x-lb.element.table.cell class="hidden lg:table-cell">
                                    @switch($progress->status)
                                        @case('pending')
                                            <x-lb.element.badge color="sunflower" label="進行中" />
                                        @break
        
                                        @case('completed')
                                            <x-lb.element.badge color="emerald" label="承認待ち" />
                                        @break
        
                                        @case('approved')
                                            <x-lb.element.badge color="river" label="承認済み" />
                                        @break
                                    @endswitch
                                </x-lb.element.table.cell>
                                <x-lb.element.table.cell class="hidden lg:table-cell">
                                    <span class="font-medium">
                                        {{ $progress->module->number }} {{$progress->module->name}}<br>{{$progress->unit->name}}
                                    </span>
                                </x-lb.element.table.cell>
                                <x-lb.element.table.cell class="hidden lg:table-cell">
                                    <div class="text-neutral-500 flex space-x-1 items-center">
                                        <span class="font-medium">{{ $progress->lesson->name }}</span>
                                    </div>
                                </x-lb.element.table.cell>
                                <x-lb.element.table.cell>
                                    {{ $progress->updated_at->format('Y-m-d') }}
                                </x-lb.element.table.cell>
                                <x-lb.element.table.cell>
                                    <a href="{{route('progress.show', compact('progress'))}}">詳細へ</a>
                                </x-lb.element.table.cell>
                            </x-lb.element.table.row>
                        
                        @endforeach
                    </x-slot>
        
                    <x-slot name="footer">
                        <div>
                            {{$progresses->links()}}
                        </div>
                    </x-slot>
        
                </x-lb.element.table>
            @else
                <div class="w-full flex items-center justify-center">
                    <x-lb.extra.loading.table-loading-indicator />
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
