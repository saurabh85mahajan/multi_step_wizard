<div>
    <x-wizard-heading>Enter Amount</x-wizard-heading>

    <!-- <div>">
</div> -->

    <div x-data="{  isFixed: @entangle('isFixed').defer }">
        <x-label for="isFixed" value="Invoice Type" class="mt-4" />
        <input @click="isFixed = true" name="isFixed" type="radio" value="1" x-bind:checked="isFixed"  /> Fixed Price
        <br />
        <input @click="isFixed = false" name="isFixed" type="radio" value="0" x-bind:checked="!isFixed"  /> Hourly

        <div x-show="isFixed">
            <x-label for="amount" value="Amount" class="mt-4" />
            <x-input class="block mt-1 w-1/4" type="number" name="amount" wire:model.defer="amount" required />
            <x-wizard-validation-error for="amount" />
        </div>

        <div x-show="!isFixed">
            <div class="flex justify-start">
                <div>
                    <x-label for="hours" value="Total Hours" class="mt-4" />
                    <x-input class="block mt-1 w-full" type="number" name="hours" wire:model.lazy="hours" required />
                    <x-wizard-validation-error for="hours" />
                </div>

                <div class="ml-4">
                    <x-label for="rate" value="Hourly Rate" class="mt-4" />
                    <x-input class="block mt-1 w-full" type="number" name="rate" wire:model.lazy="rate" required />
                    <x-wizard-validation-error for="rate" />
                </div>
            </div>
            <span>Total Amount: {{$calculatedAmount}}</span>
        </div>
    </div>
</div>