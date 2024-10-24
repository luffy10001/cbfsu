<x-crm-dropdown>
    @if(isPermission('signature.edit'))
        <li>
            <a class="dropdown-item modal_open" size="md" url="{!! route('signature.edit',mws_encrypt('E',$signature->id)) !!}"><i
                        class="bi bi-pencil-square"></i>
                Edit</a>
        </li>
    @endif

    @if(isPermission('signature.view'))
        <li>
            <a class="dropdown-item modal_open" size="lg" url="{!! route('signature.view',mws_encrypt('E',$signature->id)) !!}"><i
                        class="bi bi-info-circle"></i>
                View</a>
        </li>
    @endif

    @if(isPermission('signature.delete'))
        <li>
            <a
                    swal_title="Are you Sure!"
                    swal_icon="warning"
                    swal_text="Do you want to delete this Seal & Signature?"
                    swal_button="Yes"
                    cancel_button_text="No"
                    class="dropdown-item modal_submit" size="lg"
                    url="{!! route('signature.delete',[mws_encrypt('E',$signature->id)]) !!}"><i
                        class="fa fa-trash"></i>
                Delete User</a>
        </li>
    @endif

</x-crm-dropdown>
