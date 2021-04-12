<div>
    <div class="h-16 grid grid-rows-1 grid-flow-col gap-2">
        @for ($i = 1; $i <= $totalSteps; $i++)
            <x-wizard-step :active="$i == $step">Step {{$i }}</x-wizard-step>
        @endfor
    </div>

    <div class="h-72 mt-2 border-b-2 border-gray-300">
        <div class="min-h-full">
            @include('livewire.invoices.step' . $step)
        </div>
    </div>

    <div class="flex justify-between mt-4">
        @if($step != 1)
            <x-wizard-button class="ml-4" wire:click="moveBack">Previous</x-wizard-button>
        @else
            &nbsp;
        @endif

        <x-wizard-button class="mr-4" wire:click="moveAhead">{{$step != $totalSteps ? 'Next' : 'Submit' }}</x-wizard-button>
    </div>
</div>
