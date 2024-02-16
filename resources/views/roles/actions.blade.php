<x-crm-dropdown>
    @if(isPermission('roles.edit'))
        <li>
            <a class="dropdown-item modal_open" url="{!! route('roles.edit',$role->id) !!}">Edit</a>
        </li>
    @endif
    @if(isPermission('roles.getPermissions'))
        <li>
            <a class="dropdown-item " href="{!! route('roles.getPermissions',$role->id) !!}">Role Permissions</a>
        </li>
    @endif
    @if(isPermission('roles.visibility'))
        <li>
            <a class="dropdown-item modal_open" url="{!! route('roles.visibility',$role->id) !!}">Role Visibility</a>
        </li>
    @endif
</x-crm-dropdown>