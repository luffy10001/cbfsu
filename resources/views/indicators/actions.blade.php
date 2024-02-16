<x-crm-dropdown>
    @if(isPermission('indicator.edit'))
        <li>
            <a class="dropdown-item modal_open" url="{!! route('indicator.edit',$indicator->id) !!}">Edit</a>
        </li>
    @endif

    @if(isPermission('indicator.status'))
        @if($indicator->status === true)
            <li>
                <a class="dropdown-item modal_submit" url="{!! route('indicator.status',[$indicator->id,0]) !!}"  swal_text="Do you want to De-Activate this Indicator?" swal_title="Are you sure?" swal_icon="warning" swal_button="Yes, De-Activate it!"><i class="bi bi-door-closed"></i>
                    De-Activate</a>
            </li>
        @endif
        @if($indicator->status === false)
            <li>
                <a class="dropdown-item modal_submit" url="{!! route('indicator.status',[$indicator->id,1]) !!}"  swal_text="Do you want to Active this Indicator?" swal_title="Are you sure?" swal_icon="warning" swal_button="Yes, Active it!"><i class="bi bi-door-closed"></i>
                    Activate</a>
            </li>
        @endif
    @endif

    @if(isPermission('indicator.delete'))
        <li>
            <a class="dropdown-item modal_submit" url="{!! route('indicator.delete',mws_encrypt('E',$indicator->id)) !!}"  swal_text="Do you want to delete this record?" swal_title="Are you sure?" swal_icon="warning" swal_button="Yes"><i class="bi bi-trash text-danger"></i>  Delete</a>
        </li>
    @endif
</x-crm-dropdown>