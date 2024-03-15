@props([
    'label' => 'Accordion Label',
    'class' => 'text-md',
    'locked' => false
])

<div x-data="{ id: $id('accordion') }" class="cursor-pointer group {{$class}}">
    <button @click="setActiveAccordion(id)"
        class="flex items-center justify-between w-full p-4 text-left select-none group-hover:underline text-lg relative">
        <span>{!! $label !!}</span>

        <div class="duration-200 ease-out" :class="{ 'rotate-180': activeAccordion == id }">
            <x-lb.heroicon.o-chevron-down class="w-4 h-4 " />
        </div>
        @if($locked)
        <x-lb.heroicon.s-lock-closed class="w-6 h-6 absolute right-[50%] bottom-[50%] translate-x-[50%] translate-y-[50%]"></x-lb.heroicon.s-lock-closed>
        @endif
    </button>

    <div x-show="activeAccordion==id" x-collapse style="display:none">
        <div class="p-4 pt-0 text-neutral-500">
            {{ $slot }}
        </div>
    </div>

</div>
