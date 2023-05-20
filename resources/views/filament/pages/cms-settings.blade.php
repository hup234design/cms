<x-filament::page>

    <form wire:submit.prevent="submit">

        <div class="mb-8">
            {{ $this->form }}
        </div>

        <x-filament::button
            type="submit"
            color="success"
        >
            Save Settings
        </x-filament::button>

    </form>


</x-filament::page>
