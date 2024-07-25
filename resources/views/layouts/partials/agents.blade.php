@if(isPermission('agent.index'))
    <x-sidebar-dropdown>
        <x-slot name="icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 4H4C2.89 4 2.01 4.89 2.01 6L2 18C2 19.11 2.89 20 4 20H20C21.11 20 22 19.11 22 18V6C22 4.89 21.11 4 20 4ZM20 18H4V12H20V18ZM20 8H4V6H20V8Z" fill="white"></path>
            </svg>
        </x-slot>

        <x-slot name="label">
            Manage Agents
        </x-slot>
        <x-slot name="activeTab">
            {!! (isCurrentRoute('agent.index'))?'show':'' !!}
        </x-slot>
        @if(isPermission('agent.index'))
            <li class="nav-item {!! isCurrentRoute('agent.index')?'live-active':'' !!}">
                <a class="nav-link" href="{{route('agent.index')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round" class="feather feather-users" aria-hidden="true">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    Agents
                </a>
            </li>
        @endif
    </x-sidebar-dropdown>
@endif
