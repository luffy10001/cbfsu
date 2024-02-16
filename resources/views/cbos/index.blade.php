<x-app-layout>
    <x-slot name="header">
        <x-table-header-component>
            <x-slot name="buttons">
                <button class="btn btn-success float-end modal_open" url="{{route('cbo.create')}}" size="md"> Add New CBO </button>
                <button class="btn btn-success float-end modal_open mr-1" url="{{route('cbo.create')}}" size="md"> CBO Targets </button>
                <a class=" btn btn-warning float-end  mr-1" href="{{route('indicator.index')}}" size="md"> Performance Indicators </a>
            </x-slot>
            {{ $dataTable->filters() }}
        </x-table-header-component>
        <x-slot name="title">
            {{ __('Manage CBOs') }}
        </x-slot>
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
