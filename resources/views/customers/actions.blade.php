<x-crm-dropdown>
    @if(isPermission('customer.edit'))
        <li>
            <a class="dropdown-item" size="xl" href="{!! route('customer.edit',mws_encrypt('E',$obj->id)) !!}"><i
                        class="bi bi-pencil-square"></i>
                Edit</a>
        </li>
    @endif
    @if(isPermission('customer.view'))
        <li>
            <a class="dropdown-item" size="lg" href="{!! route('customer.view',mws_encrypt('E',$obj->id)) !!}"><i
                        class="bi bi-info-circle"></i>
                View</a>
        </li>
    @endif
    @if(isPermission('customer.status'))
       @if($obj->status === true )
            <li class="divider"></li>
            <li>
                <a
                    swal_title="Are you Sure!"
                    swal_icon="warning"
                    swal_text="Do you want to deactivate this account?"
                    swal_button="Yes"
                    cancel_button_text="No"
                    class="dropdown-item modal_submit" size="lg"
                    url="{!! route('customer.status',[$obj->user_id,'inactive']) !!}"><i
                        class="bi bi-door-closed"></i>
                    Deactivate Account</a>
            </li>
       @else
            <li class="divider"></li>
            <li>
                <a
                        swal_title="Are you Sure!"
                        swal_icon="warning"
                        swal_text="Do you want to activate this account?"
                        swal_button="Yes"
                        cancel_button_text="No"
                        class="dropdown-item modal_submit" size="lg"
                        url="{!! route('customer.status',[$obj->user_id,'active']) !!}"><i
                            class="bi bi-play"></i>
                    Activate Account</a>
            </li>
        @endif
    @endif
    @if(isPermission('customer.delete'))
        <li>
            <a
                    swal_title="Are you Sure!"
                    swal_icon="warning"
                    swal_text="Do you want to delete this account?"
                    swal_button="Yes"
                    cancel_button_text="No"
                    class="dropdown-item modal_submit" size="lg"
                    url="{!! route('customer.delete',[$obj->id]) !!}"><i
                        class="fa fa-trash"></i>
                Delete Customer</a>
        </li>
    @endif

</x-crm-dropdown>
