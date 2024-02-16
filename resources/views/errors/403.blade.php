<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Manage Permissions 403') }}
        </h2>
    </x-slot>
    <div class="card">
        <div class="card-body">
            403 page Access Forbidden.
        </div>
    </div>
    @push('scripts')

    @endpush
</x-app-layout>
