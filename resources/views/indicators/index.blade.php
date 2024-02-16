<x-app-layout>
    <x-slot name="header">
        <x-table-header-component>
            <x-slot name="title">
                {{ __('Performance Indicators') }}
            </x-slot>
            <x-slot name="buttons">
                <button class="btn btn-primary float-end modal_open" url="{{route('indicator.create')}}" size="md">Add Indicator</button>
                <a class="btn btn-primary float-end mr-1 " href="{{route('cbo.index')}}" size="md">CBO List</a>
            </x-slot>
            {{ $dataTable->filters() }}
        </x-table-header-component>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-right m-3" >
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
</x-app-layout>
