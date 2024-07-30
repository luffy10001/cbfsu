<x-crm-dropdown>
    @if(isPermission('agent.edit'))
        <li>
            <a class="dropdown-item modal_open" size="md" url="{!! route('agent.edit',$obj->id) !!}"><i
                        class="bi bi-pencil-square"></i>
                Edit</a>
        </li>
    @endif
    @if(isPermission('agent.view'))
        <li>
            <a class="dropdown-item modal_open" size="lg" url="{!! route('agent.view',$obj->id) !!}"><i
                        class="bi bi-eye-fill"></i>
                View</a>
        </li>
    @endif
    @if(isPermission('agent.status'))
       @if($obj->status ===true)
            <li class="divider"></li>
            <li>
                <a
                    swal_title="Are you Sure!"
                    swal_icon="warning"
                    swal_text="Do you want to deactivate this account?"
                    swal_button="Yes"
                    cancel_button_text="No"
                    class="dropdown-item modal_submit" size="lg"
                    url="{!! route('agent.status',[$obj->user_id,'inactive']) !!}"><i
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
                    url="{!! route('agent.status',[$obj->user_id,'active']) !!}"><i
                        class="bi bi-play"></i>
                Activate Account</a>
            </li>
        @endif
    @endif
    @if(isPermission('agent.delete'))
        <li>
            <a
                    swal_title="Are you Sure!"
                    swal_icon="warning"
                    swal_text="Do you want to delete this account?"
                    swal_button="Yes"
                    cancel_button_text="No"
                    class="dropdown-item modal_submit" size="lg"
                    url="{!! route('agent.delete',[$obj->id]) !!}"><i
                        class="fa fa-trash"></i>
                Delete Agent</a>
        </li>
    @endif
</x-crm-dropdown>
