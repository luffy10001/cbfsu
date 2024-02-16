<x-crm-dropdown>
    @if(isPermission('log.detail'))
        <li>
            <a class="dropdown-item modal_open" size="xl" url="{!! route('log.detail',$log->id) !!}"><i
                        class="bi bi-info-circle"></i>
                Detail</a>
        </li>
    @endif


</x-crm-dropdown>
