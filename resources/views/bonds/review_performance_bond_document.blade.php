<x-custom-modal-component>
    <x-slot name="title">
        {{ __('Review & Approve Performance Bond Document') }}
    </x-slot>
    <style>
        .fixed-tab {
            width: 100px; /* Set a fixed width for all tabs */
            text-align: center;
        }
        .tab-height{
            height: 600px;
        }
    </style>
    <x-slot name="body">
        <div class="container mt-3">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active fixed-tab" id="tab1-tab" data-bs-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Line Of Authority</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link fixed-tab" id="tab2-tab" data-bs-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Project</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link fixed-tab" id="tab3-tab" data-bs-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false">Bid Bond</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link fixed-tab" id="tab4-tab" data-bs-toggle="tab" href="#tab4" role="tab" aria-controls="tab4" aria-selected="false">Attachment</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link fixed-tab" id="tab5-tab" data-bs-toggle="tab" href="#tab5" role="tab" aria-controls="tab4" aria-selected="false">Performance Bond</a>
                </li>
            </ul>


            <div class="tab-content " id="myTabContent">
                <div class="tab-pane fade tab-height show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                    <div class="panel-body mt-3">
                        <div class="accordion-body">
                            <div class="card mb-4 mt-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0"> Effective Date </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"> {{$bond_detail->customer->authority->start_date ?? ''}}  </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0"> Expiration Date Date   </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"> {{$bond_detail->customer->authority->expiry_date ?? ''}}  </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0"> Territory  </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"> {{$bond_detail->customer->authority->province->name ?? ''}}  </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0"> Single Project Limit  </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"> {{$bond_detail->customer->authority->single_job_limit ?? ''}}  </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0">Aggregate Limit  </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"> {{$bond_detail->customer->authority->aggregate_limit ?? ''}}  </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0">Design Build </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"> {{$bond_detail->customer->authority->design_build==true ? 'Yes' : 'No'}}  </p>
                                            {{--                                        <p class="text-muted mb-0"> {{$customer->authority->design_build ?? ''}}  </p>--}}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0"> Job Duration (Years) </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"> {{$bond_detail->customer->authority->job_duration ?? ''}}  </p>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0"> Warranty Period (years) </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"> {{$bond_detail->customer->authority->warranty_duration ?? ''}}  </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0"> Hazmat/Asbestos </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"> {{$bond_detail->customer->authority->hazmat==true ? 'Yes' : 'No'}}  </p>
                                            {{--                                        <p class="text-muted mb-0"> yes  </p>--}}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0"> Bid Spread % </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"> {{$bond_detail->customer->authority->minimum_bid ?? ''}}  </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade tab-height" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                    <div class="panel-body mt-3">
                        <div class="accordion-body">
                            <div class="card mb-4 mt-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0"> Project Name </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"> {{$bond_detail->name ?? ''}}  </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0"> Project State   </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"> {{$bond_detail->state->name ?? ''}}  </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0"> Project City  </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"> {{$bond_detail->city->name ?? ''}}  </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0"> Project Zip  </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"> {{$bond_detail->zip ?? ''}}  </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0">Project Address  </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"> {{$bond_detail->address ?? ''}}  </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0">Project Delivery Method </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"> {{$bond_detail->delivery_method}}  </p>
                                            {{--                                        <p class="text-muted mb-0"> {{$customer->authority->design_build ?? ''}}  </p>--}}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0"> Estimate Project Start Date </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"> {{$bond_detail->start_date ?? ''}}  </p>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0"> Estimate Project Completion Date </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"> {{$bond_detail->completion_date ?? ''}}  </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0"> Warranty Term </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"> {{$bond_detail->warranty_terms}}  </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0"> Liquidated Damages </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"> {{$bond_detail->damages ?? ''}}  </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0"> Retainage Amount </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"> {{$bond_detail->retain_amount ?? ''}}  </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0"> Current Backlog </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"> {{$bond_detail->current_backlog ?? ''}}  </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0"> Engineer Name </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"> {{$bond_detail->engineer_name ?? ''}}  </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0"> Oblige/Owner Name </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"> {{$bond_detail->owner_name ?? ''}}  </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0"> Oblige/Owner State </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"> {{$bond_detail->states->name ?? ''}}  </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0"> Oblige/Owner City </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"> {{$bond_detail->cities->name ?? ''}}  </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0"> Oblige/Owner Zip </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"> {{$bond_detail->owner_zip ?? ''}}  </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0"> Oblige/Owner Address </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"> {{$bond_detail->owner_address ?? ''}}  </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade tab-height" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                    <div class="panel-body mt-3">
                        <div class="accordion-body">
                            <div class="card mb-4 mt-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0"> Estimated Start Date </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"> {{$bond_detail->bid_start_date ?? ''}}  </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0"> Substantial Completion Date   </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"> {{$bond_detail->bid_completion_date ?? ''}}  </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0"> Bid Date </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"> {{$bond_detail->owner_bid_date ?? ''}}  </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0"> How Much Will You Bid $  </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"> {{$bond_detail->bid_amount ?? ''}}  </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0"> What is Your Project Cost $ </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"> {{$bond_detail->bid_project_cost ?? ''}}  </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0">GPM </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"> {{$bond_detail->gpm}}  </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0"> Amount of Bid Bond (i.e. 5%, 10%, etc.) </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"> {{$bond_detail->bid_amount_percentage ?? ''}}  </p>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0"> Warranty Period </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"> {{$bond_detail->bid_warranty_period ?? ''}}  </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0"> Liquidated Damages </p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"> {{$bond_detail->bid_damages}}  </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-heading">
                                <hr style="margin-top: 0;">
                                <h6 class="accordion-header mt-0" id="headingFive" style="background-color: #edf7fd;padding:15px">
                                    <strong> Questions </strong>
                                </h6>
                            </div>
                            <div class="panel-body">
                                <div class="accordion-body">
                                    <div class="card mb-4 mt-2">
                                        <div class="card-body">
                                            @foreach($bond_detail->customer->questions as $key => $quest)
                                                    <?php $qv= $key+1 ?>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <p class="mb-0"> <strong>{!! $quest->question ?? '' !!}</strong> </p>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <p class="text-muted mb-0"> {{ $quest->answer ?? ''}}  </p>
                                                    </div>
                                                </div>
                                                <hr>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="tab4-tab">
                    <div class="panel-body mt-3">
                        <div class="accordion-body">
                            <div class="card mb-4 mt-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p class="mb-0"> Attachment </p>
                                            </div>
                                            <div class="col-sm-8">
                                                @if(pathinfo($bond_detail->attachment, PATHINFO_EXTENSION) === 'pdf')
                                                    <!-- Display a PDF icon and a link to the PDF -->
                                                    <a href="{{ asset('images/bonds/' . $bond_detail->attachment) }}" target="_blank">
                                                        <img src="{{ asset('images/pdf.svg') }}" alt="PDF" style="width: 40px; height: 40px;">
                                                        View File
                                                    </a>
                                                @else
                                                    <a href="{{ asset('images/bonds/' . $bond_detail->attachment) }}" target="_blank">
                                                        <img src="{{ asset('images/pdf.svg') }}" alt="Image" style="width: 40px; height: 40px;">
                                                        View
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab5" role="tabpanel" aria-labelledby="tab5-tab">
                    <div class="panel-body mt-3">
                        <div class="accordion-body">
                            <div class="card mb-4 mt-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p class="mb-0"> Contract Details </p>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="text-muted mb-0"> {{$bond_detail->perf_contract_detail ?? ''}}  </p>
                                           </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p class="mb-0"> Contract Date </p>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="text-muted mb-0"> {{$bond_detail->perf_contract_date ?? ''}}  </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p class="mb-0"> Contract Amount </p>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="text-muted mb-0"> {{$bond_detail->perf_contract_amount ?? ''}}  </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p class="mb-0"> Description </p>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="text-muted mb-0"> {{$bond_detail->perf_description ?? ''}}  </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p class="mb-0"> Bond Details </p>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="text-muted mb-0"> {{$bond_detail->perf_bond_detail ?? ''}}  </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p class="mb-0"> Date </p>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="text-muted mb-0"> {{$bond_detail->perf_date ?? ''}}  </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p class="mb-0"> Amount </p>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="text-muted mb-0"> {{$bond_detail->perf_amount ?? ''}}  </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p class="mb-0"> Attached Contract Document </p>
                                            </div>
                                            <div class="col-sm-8">
                                                @if(pathinfo($bond_detail->perf_contract_document, PATHINFO_EXTENSION) === 'pdf')
                                                    <!-- Display a PDF icon and a link to the PDF -->
                                                    <a href="{{ asset('images/bonds/' . $bond_detail->perf_contract_document) }}" target="_blank">
                                                        <img src="{{ asset('images/pdf.svg') }}" alt="PDF" style="width: 40px; height: 40px;">
                                                        View File
                                                    </a>
                                                @else
                                                    <a href="{{ asset('images/bonds/' . $bond_detail->perf_contract_document) }}" target="_blank">
                                                        <img src="{{ asset('images/pdf.svg') }}" alt="Image" style="width: 40px; height: 40px;">
                                                        View
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mt-3 mb-3" style="float: right">
                                            <form id="issue-docs-form" method="post" action="{{ route('bond.issuePerformanceDoc',mws_encrypt('E',$bond_detail->id)) }}">
                                                @csrf
                                                <button class="form_submit hidden btn btn-success">
                                                    Review & Approve Bid Bond Documents
                                                </button>
                                            </form>
                                            <button class="btn btn-primary modal_submits"> Review & Approve Performance Bond Documents </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-custom-modal-component>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.modal_submits', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you Want to Issue Performance Bond Documents to the Customer against the Bond?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, do it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('.form_submit.hidden').trigger('click');
                }
            });
        });
    });

</script>
