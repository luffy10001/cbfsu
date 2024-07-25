
@if(isPermission('roles.index') || isPermission('users.index') || isPermission('permissions.index') || isPermission('departments.index') || isPermission('roles.getPermissions'))

    <x-sidebar-dropdown>
        <x-slot name="icon">
            <svg width="18" height="18" class="mr-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16 11C17.66 11 18.99 9.66 18.99 8C18.99 6.34 17.66 5 16 5C14.34 5 13 6.34 13 8C13 9.66 14.34 11 16 11ZM8 11C9.66 11 10.99 9.66 10.99 8C10.99 6.34 9.66 5 8 5C6.34 5 5 6.34 5 8C5 9.66 6.34 11 8 11ZM8 13C5.67 13 1 14.17 1 16.5V19H15V16.5C15 14.17 10.33 13 8 13ZM16 13C15.71 13 15.38 13.02 15.03 13.05C16.19 13.89 17 15.02 17 16.5V19H23V16.5C23 14.17 18.33 13 16 13Z" fill="white"/>
            </svg>
        </x-slot>
        <x-slot name="label">
            Manage Users
        </x-slot>
        <x-slot name="activeTab">
            {!! (isCurrentRoute('roles.index') || isCurrentRoute('users.index') || isCurrentRoute('permissions.index') || isCurrentRoute('departments.index') || isCurrentRoute('roles.getPermissions'))?'show':'' !!}
        </x-slot>
        @if(isPermission('users.index'))
            <li class="nav-item  ml-3 {!! isCurrentRoute('users.index')?'live-active':'' !!}">
                <a class="nav-link " href="{{route('users.index')}}">
                    Users
                </a>
            </li>
        @endif
        @if(isPermission('roles.index'))
            <li class="nav-item  ml-3 {!! isCurrentRoute('roles.index') || isCurrentRoute('roles.getPermissions')?'live-active':'' !!}">
                <a class="nav-link  " href="{{route('roles.index')}}">
                    Roles
                </a>
            </li>
        @endif
        @if(isPermission('departments.index'))
            <li class="nav-item  ml-3 {!! isCurrentRoute('departments.index')?'live-active':'' !!}">
                <a class="nav-link " href="{{route('departments.index')}}">
                    Departments
                </a>
            </li>
        @endif
    </x-sidebar-dropdown>
@endif