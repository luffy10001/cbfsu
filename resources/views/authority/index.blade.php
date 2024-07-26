<x-app-layout>
    <x-slot name="header">
        <x-table-header-component>
            <x-slot name="buttons">
                @if(isPermission('agent.create'))
                    <button data='{!! json_encode(['test'=>'1']) !!}' class="btn testsss btn-success float-end modal_open"  url="{{route('authority.create')}}" size="xl">Create Authority</button>
                @endif
            </x-slot>
            {{ $dataTable->filters() }}
        </x-table-header-component>
        <x-slot name="title">
            {{ __('Manage Line oF Authorities') }}
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
