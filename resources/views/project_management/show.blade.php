<x-custom-modal-component>
    <x-slot name="title">
        {{ __("Project Details") }}
    </x-slot>
    <x-slot name="body">
        <div class="modal-body">
            <section>
                <div class="container p-0 mt-2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Project Name</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$pm['name']??'N/A'}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Project Address</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$pm['address']??'N/A'}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Project State</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$ps['name']??'N/A'}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Project City</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$pc['name']}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Project Zip</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$pm['zip']??'N/A'}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Project Delivery Method</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$pm['delivery_method']}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Estimate Project Start Date</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$pm['start_date']??'N/A'}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Estimate Project Completion Date</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$pm['completion_date']}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Warranty Term</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$pm['warranty_terms']??'N/A'}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Liquidated Damages</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$pm['damages']}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Retainage Amount</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$pm['retain_amount']??'N/A'}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Current Backlog</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$pm['current_backlog']}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Bid Date</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$pm['bid_date']??'N/A'}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Bid Amount</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$pm['bid_amount']??'N/A'}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">GPM</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$pm['gpm']??'N/A'}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Obligee Name</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$pm['insurer_name']??'N/A'}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Obligee Address</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$pm['oblige_address']??'N/A'}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Obligee Sate</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$pm['province_name']??'N/A'}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Obligee City</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$pm['city_name']}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Obligee Zip</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$pm['oblige_zip']??'N/A'}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Engineer Name</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$pm['engineer_name']??'N/A'}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="modal-footer">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span class="btn btn btn-sm btn-primary cancel-btn" >Close </span>
            </button>
        </div>
    </x-slot>
</x-custom-modal-component>

