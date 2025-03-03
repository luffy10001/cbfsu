<x-app-layout>
    <x-slot name="header">
        <x-table-header-component>
            <x-slot name="buttons">
                @if(isPermission('bond.create') && $slug == "customer")
                    <a href="{{route('bond.create')}}">
                        <button  class="btn testsss btn-success float-end">Request Bid Bond</button>
                    </a>
                @endif
            </x-slot>
            {{ $dataTable->filters() }}
        </x-table-header-component>
        <x-slot name="title">
            {{ __('Manage Bond') }}
        </x-slot>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-right m-3">
                    {{ Session::get('success') }}
                </div>
                <div class="mws-main-datatable">
                    <div class="table-responsive">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        {{ $dataTable->scripts() }}
    @endpush
    <script type="module">
        $(document).find('.filter-dropdown').select2();
    </script>
</x-app-layout>
