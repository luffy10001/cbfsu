<x-crm-dropdown>
    @if(isPermission('departments.edit'))
        <li>
            <a class="dropdown-item modal_open" url="{!! route('departments.edit',$department->id) !!}">Edit</a>
        </li>
    @endif
</x-crm-dropdown>