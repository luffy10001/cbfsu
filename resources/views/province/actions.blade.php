<x-crm-dropdown>
    @if(isPermission('province.edit'))
        <li>
            <a class="dropdown-item modal_open" url="{!! route('province.edit',$province->id) !!}">Edit</a>
        </li>
    @endif

    @if(isPermission('province.status'))
        @if($province->status === true)
            <li>
                <a class="dropdown-item modal_submit" url="{!! route('province.status',[$province->id,0]) !!}"  swal_text="Do you want to De-Activate this Province?" swal_title="Are you sure?" swal_icon="warning" swal_button="Yes, De-Activate it!"><i class="bi bi-door-closed"></i>
                    De-Activate</a>
            </li>
        @endif
        @if($province->status === false)
            <li>
                <a class="dropdown-item modal_submit" url="{!! route('province.status',[$province->id,1]) !!}"  swal_text="Do you want to Active this Province?" swal_title="Are you sure?" swal_icon="warning" swal_button="Yes, Active it!"><i class="bi bi-door-closed"></i>
                    Activate</a>
            </li>
        @endif
    @endif

    @if(isPermission('province.delete'))
        <li>
            <a class="dropdown-item modal_submit" url="{!! route('province.delete',mws_encrypt('E',$province->id)) !!}"  swal_text="Do you want to delete this record?" swal_title="Are you sure?" swal_icon="warning" swal_button="Yes"><i class="bi bi-trash text-danger"></i>  Delete</a>
        </li>
    @endif
</x-crm-dropdown>