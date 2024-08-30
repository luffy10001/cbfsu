<x-crm-dropdown>
    @if(isPermission('project.edit'))
        <li>
            <a class="dropdown-item modal_open" size="xl" url="{!! route('project.edit',mws_encrypt('E',$obj->id)) !!}"><i
                        class="bi bi-pencil-square"></i>
                Edit</a>
        </li>
    @endif
    @if(isPermission('project.view'))
        <li>
            <a class="dropdown-item modal_open" size="lg" url="{!! route('project.view',mws_encrypt('E',$obj->id)) !!}"><i
                        class="bi bi-info-circle"></i>
                View</a>
        </li>
    @endif
        @if(isPermission('project.delete'))
            <li>
                <a
                        swal_title="Are you Sure!"
                        swal_icon="warning"
                        swal_text="Do you want to delete this record?"
                        swal_button="Yes"
                        cancel_button_text="No"
                        class="dropdown-item modal_submit" size="lg"
                        url="{!! route('project.delete',[$obj->id]) !!}"><i
                            class="fa fa-trash"></i>
                    Delete</a>
            </li>
        @endif

</x-crm-dropdown>
