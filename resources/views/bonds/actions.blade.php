<x-crm-dropdown>
    @if(isPermission('bond.edit'))
        <li>
            <a class="dropdown-item " target="_blank" href="{!! route('bond.edit',mws_encrypt('E',$obj->id)) !!}"><i
                        class="bi bi-pencil-square"></i>
                Edit</a>
        </li>
    @endif

    @if(isRoleSuperAdmin($role))
        @if(isPermission('bond.bidBondPdf'))
            <li>
                <a class="dropdown-item " target="_blank"  href="{!! route('bond.bidBondPdf',mws_encrypt('E',$obj->id)) !!}"><i
                            class="bi bi-info-circle"></i>
                    Bid Bond Documents </a>
            </li>
        @endif
        @if(isPermission('bond.viewPerformancePaymentPdf'))
            <li>
                <a class="dropdown-item " target="_blank" href="{!! route('bond.viewPerformancePaymentPdf',mws_encrypt('E',$obj->id)) !!}"><i
                            class="bi bi-info-circle"></i>
                    Payment & Performance Bond Documents </a>
            </li>
        @endif

        @if(isPermission('bond.attorneyPdf'))
            <li>
                <a class="dropdown-item " target="_blank" href="{!! route('bond.attorneyPdf',mws_encrypt('E',$obj->id)) !!}"><i
                            class="bi bi-info-circle"></i>
                    Power of Attorney Documents </a>
            </li>
        @endif
    @else
            @if(isPermission('bond.bidBondPdf') && $obj->issue_doc===true)
                <li>
                    <a class="dropdown-item " target="_blank"  href="{!! route('bond.bidBondPdf',mws_encrypt('E',$obj->id)) !!}"><i
                                class="bi bi-info-circle"></i>
                        Bid Bond Documents </a>
                </li>
            @endif
            @if(isPermission('bond.viewPerformancePaymentPdf') && $obj->issue_doc===true)
                <li>
                    <a class="dropdown-item " target="_blank" href="{!! route('bond.viewPerformancePaymentPdf',mws_encrypt('E',$obj->id)) !!}"><i
                                class="bi bi-info-circle"></i>
                        Payment & Performance Bond Documents </a>
                </li>
            @endif

            @if(isPermission('bond.attorneyPdf') && $obj->issue_doc===true)
                <li>
                    <a class="dropdown-item " target="_blank" href="{!! route('bond.attorneyPdf',mws_encrypt('E',$obj->id)) !!}"><i
                                class="bi bi-info-circle"></i>
                        Power of Attorney Documents </a>
                </li>
            @endif
        @endif


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
