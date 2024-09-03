<x-crm-dropdown>

{{--    @if(isPermission('bond.edit') != isRoleSuperAdmin($role))--}}
    @if(isPermission('bond.edit'))
        <li>
            <a class="dropdown-item " href="{!! route('bond.edit',mws_encrypt('E',$obj->id)) !!}"><i
                        class="bi bi-pencil-square"></i>
                Edit</a>
        </li>
    @endif
{{--    @if(isPermission('bond.view'))--}}
{{--        <li>--}}
{{--            <a class="dropdown-item modal_open" size="lg" url="{!! route('bond.view',$obj->id) !!}"><i--}}
{{--                        class="bi bi-info-circle"></i>--}}
{{--                View</a>--}}
{{--        </li>--}}
{{--    @endif--}}



    @if(isPermission('bond.delete'))
        <li>
            <a
                    swal_title="Are you Sure!"
                    swal_icon="warning"
                    swal_text="Do you want to delete this Bond?"
                    swal_button="Yes"
                    cancel_button_text="No"
                    class="dropdown-item modal_submit" size="lg"
                    url="{!! route('bond.delete',[$obj->id]) !!}"><i
                        class="fa fa-trash"></i>
                Delete</a>
        </li>
    @endif

</x-crm-dropdown>
