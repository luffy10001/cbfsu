<x-custom-modal-component>
    <x-slot name="title">
        {{ __('Assignment History for '.$user->name." - ".$user->role->name) }}
    </x-slot>
    <x-slot name="body">
        <div class="modal-body">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100 text-right m-3">
                            {{ Session::get('success') }}
                        </div>
                        <div>
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{ $dataTable->scripts() }}
    </x-slot>


</x-custom-modal-component>


