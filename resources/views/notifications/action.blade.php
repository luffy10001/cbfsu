<x-crm-dropdown>
    @if(isPermission('notifications.show'))
        <li>
            <a class="dropdown-item" href="{!! route('notifications.show',mws_encrypt('E',$notification->id)) !!}"><i
                        class="bi bi-eye-fill"></i> View</a>
        </li>
    @endif
</x-crm-dropdown>