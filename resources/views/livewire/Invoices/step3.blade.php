<x-wizard-heading>Message</x-wizard-heading>

<div>

    <x-label for="message" value="Add Message for Customer" class="mt-4" />
    <textarea wire:model="message" class="h-36 w-1/2 resize border rounded-md"></textarea>
    <br />
    <x-wizard-validation-error for="message" />
</div>
