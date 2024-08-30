@if(isPermission('insurer.index'))
    <x-sidebar-dropdown>
        <x-slot name="icon">
            <svg width="18" height="18" class="mr-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 4H4C2.9 4 2.01 4.9 2.01 6L2 18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V8C22 6.9 21.1 6 20 6H12L10 4Z" fill="white"></path>
            </svg>
        </x-slot>

        <x-slot name="label">
            Manage Insurers
        </x-slot>
        <x-slot name="activeTab">
            {!! (isCurrentRoute('insurer.index'))|| isCurrentRoute('insurer.create') || isCurrentRoute('insurer.edit')?'show':'' !!}
        </x-slot>
        @if(isPermission('insurer.index'))
            <li class="nav-item {!! isCurrentRoute('insurer.index')|| isCurrentRoute('insurer.create') || isCurrentRoute('insurer.edit')?'live-active':'' !!}">
                <a class="nav-link" href="{{route('insurer.index')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round" class="feather feather-users" aria-hidden="true">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    Insurers
                </a>
            </li>
        @endif
    </x-sidebar-dropdown>
@endif
