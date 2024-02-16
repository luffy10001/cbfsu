<x-crm-dropdown>
    @if(isPermission('city.edit'))
        <li>
            <a class="dropdown-item modal_open" url="{!! route('city.edit',$city->id) !!}">Edit</a>
        </li>
    @endif

    @if(isPermission('city.status'))
        @if($city->status === true)
            <li>
                <a class="dropdown-item modal_submit" url="{!! route('city.status',[$city->id,0]) !!}"  swal_text="Do you want to De-Activate this City?" swal_title="Are you sure?" swal_icon="warning" swal_button="Yes, De-Activate it!"><i class="bi bi-door-closed"></i>
                    De-Activate</a>
            </li>
        @endif
        @if($city->status === false)
            <li>
                <a class="dropdown-item modal_submit" url="{!! route('city.status',[$city->id,1]) !!}"  swal_text="Do you want to Active this City?" swal_title="Are you sure?" swal_icon="warning" swal_button="Yes, Active it!"><i class="bi bi-door-closed"></i>
                    Activate</a>
            </li>
        @endif
    @endif

    @if(isPermission('city.delete'))
        <li>
            <a class="dropdown-item modal_submit" url="{!! route('city.delete',mws_encrypt('E',$city->id)) !!}"  swal_text="Do you want to delete this record?" swal_title="Are you sure?" swal_icon="warning" swal_button="Yes"><i class="bi bi-trash text-danger"></i>  Delete</a>
        </li>
    @endif
</x-crm-dropdown>