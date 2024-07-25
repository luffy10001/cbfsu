@if(isPermission('insurer.index'))
    <x-sidebar-dropdown>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
             class="feather feather-layers" aria-hidden="true">
            <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
            <polyline points="2 17 12 22 22 17"></polyline>
            <polyline points="2 12 12 17 22 12"></polyline>
        </svg>
        <x-slot name="label">
            Manage Insurers
        </x-slot>
        <x-slot name="activeTab">
            {!! (isCurrentRoute('insurer.index'))?'show':'' !!}
        </x-slot>
        @if(isPermission('insurer.index'))
            <li class="nav-item {!! isCurrentRoute('insurer.index')?'live-active':'' !!}">
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