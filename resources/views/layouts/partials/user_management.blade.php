@if(isPermission('roles.index') || isPermission('users.index') || isPermission('permissions.index'))
    <x-sidebar-dropdown>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
             class="feather feather-layers" aria-hidden="true">
            <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
            <polyline points="2 17 12 22 22 17"></polyline>
            <polyline points="2 12 12 17 22 12"></polyline>
        </svg>
        <x-slot name="label">
            Manage Users
        </x-slot>
        <x-slot name="activeTab">
            {!! (isCurrentRoute('roles.index') || isCurrentRoute('users.index') || isCurrentRoute('permissions.index') || isCurrentRoute('departments.index'))?'show':'' !!}
        </x-slot>
        @if(isPermission('users.index'))
            <li class="nav-item {!! isCurrentRoute('users.index')?'live-active':'' !!}">
                <a class="nav-link" href="{{route('users.index')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round" class="feather feather-users" aria-hidden="true">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    Users
                </a>
            </li>
        @endif
        @if(isPermission('roles.index'))
            <li class="nav-item {!! isCurrentRoute('roles.index')?'live-active':'' !!}">
                <a class="nav-link" href="{{route('roles.index')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round" class="feather feather-bar-chart-2" aria-hidden="true">
                        <line x1="18" y1="20" x2="18" y2="10"></line>
                        <line x1="12" y1="20" x2="12" y2="4"></line>
                        <line x1="6" y1="20" x2="6" y2="14"></line>
                    </svg>
                     Roles
                </a>
            </li>
        @endif
        @if(isPermission('departments.index'))
            <li class="nav-item {!! isCurrentRoute('departments.index')?'live-active':'' !!}">
                <a class="nav-link" href="{{route('departments.index')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round" class="feather feather-users" aria-hidden="true">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    Departments
                </a>
            </li>
        @endif
    </x-sidebar-dropdown>
@endif