<x-app-layout>

    <x-slot name="header">
        <x-table-header-component>
           
            {{ $dataTable->filters() }}
        </x-table-header-component>
    </x-slot>
    <x-slot name="title">
        {{ __('Manage Notifications') }}
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-right m-3 d-none">
                    {{ Session::get('success') }}
                </div>
                <div class="mws-main-datatable">
                    <div class="table-responsive">
                        <style>
                            .table.table-bordered.dataTable tbody td {
                                padding: 10px 4px !important;
                            }
                        </style>
                        {{ $dataTable->table() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        {{ $dataTable->scripts() }}
    @endpush
    <script>
            $(document).find('.filter-dropdown').select2();
    </script>
</x-app-layout>
