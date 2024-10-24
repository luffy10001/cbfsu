<x-crm-dropdown>
        @if(isRoleSuperAdmin($role))
            @if(isPermission('bond.issue-docs') && $obj->bond_type == 0 && $obj->issue_doc != true)
            <li>
                <a class="dropdown-item modal_open" size="xl" url="{{ route('bond.reviewBidBondDocument',mws_encrypt('E',$obj->id)) }}"><i
                            class="bi bi-pencil-square"></i>
                    Review & Approve Bid Bond Documents</a>
            </li>

{{--            <li>--}}
{{--                <a--}}
{{--                        swal_title="Are you Sure!"--}}
{{--                        swal_icon="warning"--}}
{{--                        swal_text="Do you Want to Approve & Issue Bid Bond Documents to the Customer against the Bond?"--}}
{{--                        swal_button="Yes"--}}
{{--                        cancel_button_text="No"--}}
{{--                        class="dropdown-item modal_submit" size="lg"--}}
{{--                        url="{!! route('bond.issue-docs',mws_encrypt('E',$obj->id)) !!}"><i--}}
{{--                            class="bi bi-info-circle"></i>--}}
{{--                    Review & Approve Bid Bond Documents</a>--}}
{{--            </li>--}}
            @endif
            @if(isPermission('bond.issuePerformanceDoc') && $obj->bond_type == 1  && $obj->perf_doc_issue!=true)

                <li>
                    <a class="dropdown-item modal_open" size="xl" url="{{ route('bond.reviewPerformanceBondDocument',mws_encrypt('E',$obj->id)) }}"><i
                                class="bi bi-pencil-square"></i>
                        Review & Approve Performance Bond Documents</a>
                </li>
{{--                    <li>--}}
{{--                    <a--}}
{{--                            swal_title="Are you Sure!"--}}
{{--                            swal_icon="warning"--}}
{{--                            swal_text="Do you Want to Issue Performance & Payment Bond Documents to the Customer against the Bond?"--}}
{{--                            swal_button="Yes"--}}
{{--                            cancel_button_text="No"--}}
{{--                            class="dropdown-item modal_submit" size="lg"--}}
{{--                            url="{!! route('bond.issuePerformanceDoc',mws_encrypt('E',$obj->id)) !!}"><i--}}
{{--                                class="bi bi-info-circle"></i>--}}
{{--                        Review & Approve Performance Bond Documents</a>--}}
{{--                </li>--}}
            @endif
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
                        Performance Bond Documents </a>
                </li>
            @endif

{{--            @if(isPermission('bond.attorneyPdf'))--}}
{{--                <li>--}}
{{--                    <a class="dropdown-item " target="_blank" href="{!! route('bond.attorneyPdf',mws_encrypt('E',$obj->id)) !!}"><i--}}
{{--                                class="bi bi-info-circle"></i>--}}
{{--                        Power of Attorney Documents </a>--}}
{{--                </li>--}}
{{--            @endif--}}
        @else
            @if($obj->status != '2')
                @if(isPermission('bond.edit') && $obj->status == 0 )
                    <li>
                        <a class="dropdown-item " target="_blank" href="{!! route('bond.edit',mws_encrypt('E',$obj->id)) !!}"><i
                                    class="bi bi-pencil-square"></i>
                            Edit</a>
                    </li>
                @endif
                @if(isPermission('bond.bidBondPdf') && $obj->issue_doc==true)
                    <li>
                        <a class="dropdown-item " target="_blank"  href="{!! route('bond.bidBondPdf',mws_encrypt('E',$obj->id)) !!}"><i
                                    class="bi bi-info-circle"></i>
                            Bid Bond Documents </a>
                    </li>
                @endif
                @if(isPermission('bond.convertToPerformance') && $obj->issue_doc == true && $obj->perf_doc_issue!=true && $obj->bond_type != 1)
                    <li>
                        <a class="dropdown-item modal_open" size="lg" url="{!! route('bond.convertToPerformance',mws_encrypt('E',$obj->id)) !!}"><i
                                    class="bi bi-info-circle"></i>
                            Convert into performance bond </a>
                    </li>
                @endif
                @if(isPermission('bond.viewPerformancePaymentPdf') && $obj->perf_doc_issue==true)
                    <li>
                        <a class="dropdown-item " target="_blank" href="{!! route('bond.viewPerformancePaymentPdf',mws_encrypt('E',$obj->id)) !!}"><i
                                    class="bi bi-info-circle"></i>
                            Performance Bond Documents </a>
                    </li>
                @endif
                @if(isPermission('bond.cancelRequest'))
                    <li>
                        <a
                                swal_title="Are you Sure!"
                                swal_icon="warning"
                                swal_text="Do you Want to Cancel the Bond Request?"
                                swal_button="Yes"
                                cancel_button_text="No"
                                class="dropdown-item modal_submit" size="lg"
                                url="{!! route('bond.cancelRequest',mws_encrypt('E',$obj->id)) !!}"><i
                                    class="bi bi-info-circle"></i>
                            Cancel Request </a>
                    </li>
                @endif
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

    @if(isPermission('bond.view'))
        <li>
            <a class="dropdown-item modal_open" size="xl" url="{{ route('bond.view',mws_encrypt('E',$obj->id)) }}"><i
                        class="bi bi-eye-fill"></i>
                Details</a>
        </li>
    @endif

</x-crm-dropdown>
{{--                @if(isPermission('bond.attorneyPdf') && $obj->issue_doc==true)--}}
{{--                    <li>--}}
{{--                        <a class="dropdown-item " target="_blank" href="{!! route('bond.attorneyPdf',mws_encrypt('E',$obj->id)) !!}"><i--}}
{{--                                    class="bi bi-info-circle"></i>--}}
{{--                            Power of Attorney Documents </a>--}}
{{--                    </li>--}}
{{--                @endif--}}
