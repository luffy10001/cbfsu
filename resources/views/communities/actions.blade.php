<x-crm-dropdown>
    @if(isPermission('community.edit'))
        <li>
            <a class="dropdown-item modal_open" url="{!! route('community.edit',$community->id) !!}">Edit</a>
        </li>
    @endif

    @if(isPermission('community.status'))
        @if($community->status === true)
            <li>
                <a class="dropdown-item modal_submit" url="{!! route('community.status',[$community->id,0]) !!}"  swal_text="Do you want to De-Activate this Community?" swal_title="Are you sure?" swal_icon="warning" swal_button="Yes, De-Activate it!"><i class="bi bi-door-closed"></i>
                    De-Activate</a>
            </li>
        @endif
        @if($community->status === false)
            <li>
                <a class="dropdown-item modal_submit" url="{!! route('community.status',[$community->id,1]) !!}"  swal_text="Do you want to Active this Community?" swal_title="Are you sure?" swal_icon="warning" swal_button="Yes, Active it!"><i class="bi bi-door-closed"></i>
                    Activate</a>
            </li>
        @endif
    @endif

    @if(isPermission('community.delete'))
        <li>
            <a class="dropdown-item modal_submit" url="{!! route('community.delete',mws_encrypt('E',$community->id)) !!}"  swal_text="Do you want to delete this record?" swal_title="Are you sure?" swal_icon="warning" swal_button="Yes"><i class="bi bi-trash text-danger"></i>  Delete</a>
        </li>
    @endif
</x-crm-dropdown>