<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ダッシュボード
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-10">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <p>今週の総学習時間</p>
        <canvas id="myChart"></canvas>
        <div class="flex mt-8 justify-between">
            <div class="sm:w-[40%] w-[60%]">
              <p>今週の科目ごとの学習時間</p>
              <canvas id="pieChart"></canvas>
            </div>
        </div>

    </div>
</x-app-layout>
