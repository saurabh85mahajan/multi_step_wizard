<div>
    <x-wizard-heading>Select Customer</x-wizard-heading>

    <div>
        <x-label for="customer_id" value="Customer" class="mt-4" />

        <select class="block mt-1 w-1/4" wire:model.defer="customer_id">
            <option value="">--Select Customer--</option>
            @foreach ($customers as $key => $value)
                <option value="{{$key}}">{{$value}}</option>
            @endforeach
        </select>

        <x-wizard-validation-error for="customer_id" />
    </div>
</div>