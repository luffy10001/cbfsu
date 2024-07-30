<x-crm-dropdown>
    @if(isPermission('users.edit'))
        <li>
            <a class="dropdown-item modal_open" size="md" url="{!! route('users.edit',$user->id) !!}"><i
                        class="bi bi-pencil-square"></i>
                Edit</a>
        </li>
    @endif
    @if(isPermission('users.view'))
        <li>
            <a class="dropdown-item modal_open" size="lg" url="{!! route('users.view',$user->id) !!}"><i
                        class="bi bi-info-circle"></i>
                View</a>
        </li>
    @endif
    @if(isPermission('users.status'))
       @if($user->status == true)
            <li class="divider"></li>
            <li>
                <a
                    swal_title="Are you Sure!"
                    swal_icon="warning"
                    swal_text="Do you want to deactivate this account?"
                    swal_button="Yes"
                    cancel_button_text="No"
                    class="dropdown-item modal_submit" size="lg"
                    url="{!! route('users.status',[$user->id,'inactive']) !!}"><i
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
                        url="{!! route('users.status',[$user->id,'active']) !!}"><i
                            class="bi bi-play"></i>
                    Activate Account</a>
            </li>
        @endif
    @endif
    @if(isPermission('users.delete'))
        <li>
            <a
                    swal_title="Are you Sure!"
                    swal_icon="warning"
                    swal_text="Do you want to delete this account?"
                    swal_button="Yes"
                    cancel_button_text="No"
                    class="dropdown-item modal_submit" size="lg"
                    url="{!! route('users.delete',[$user->id]) !!}"><i
                        class="fa fa-trash"></i>
                Delete User</a>
        </li>
    @endif

</x-crm-dropdown>
