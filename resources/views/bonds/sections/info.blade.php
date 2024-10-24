
<form action="{{route("bond.store")}}" method="POST" enctype="multipart/form-data" class="multiStep">
    @csrf
        <input type="hidden" name="type" value="1">
    @if($obj)
        <input type="hidden" name="bond_id" value="{{$obj->id}}">
    @endif
    <section id="hell" class="section">
        <input type="hidden" class="form-control " name="customer_id" id="customer_id" value="{{$customer->id}}">
        <div class="panel-body mt-3">
            <div class="accordion-body">
                <div class="card mb-4 mt-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0"> Effective Date </p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"> {{$customer->authority->start_date ?? ''}}  </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0"> Expiration Date Date   </p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"> {{$customer->authority->expiry_date ?? ''}}  </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0"> Territory  </p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"> {{$customer->authority->province->name ?? ''}}  </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0"> Single Project Limit  </p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"> {{$customer->authority->single_job_limit ?? ''}}  </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Aggregate Limit  </p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"> {{$customer->authority->aggregate_limit ?? ''}}  </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Design Build </p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"> {{$customer->authority->design_build==true ? 'Yes' : 'No'}}  </p>
                                {{--                                        <p class="text-muted mb-0"> {{$customer->authority->design_build ?? ''}}  </p>--}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0"> Job Duration (Years) </p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"> {{$customer->authority->job_duration ?? ''}}  </p>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0"> Warranty Period (years) </p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"> {{$customer->authority->warranty_duration ?? ''}}  </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0"> Hazmat/Asbestos </p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"> {{$customer->authority->hazmat==true ? 'Yes' : 'No'}}  </p>
                                {{--                                        <p class="text-muted mb-0"> yes  </p>--}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0"> Bid Spread % </p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"> {{$customer->authority->minimum_bid ?? ''}}  </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.stepform.footer_for_details',['first'=>false, 'last' => true])
        </div>
{{--        <div class="container p-0 mt-4">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-12">--}}
{{--                    <div class="card mb-2">--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-6 form-group">--}}
{{--                                    <label for="MonitoredBy" class="form-label">Company Name<span class="req text-danger">*</span></label>--}}
{{--                                    <input type="text" class="form-control " id="MonitoredBy" value="{{$user->name}}" disabled >--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6 form-group">--}}
{{--                                    <label for="State" class="form-label">State<span class="req text-danger">*</span></label>--}}
{{--                                    <input type="text" class="form-control " id="State" value="{{$customer->state->name}}" disabled >--}}
{{--                                 </div>--}}
{{--                                <div class="col-md-6 form-group">--}}
{{--                                    <label for="City" class="form-label">City<span class="req text-danger">*</span></label>--}}
{{--                                    <input type="text" class="form-control " id="City" value="{{$customer->city->name}}"  disabled>--}}
{{--                                 </div>--}}
{{--                                <div class="col-md-6 form-group">--}}
{{--                                    <label for="Zip" class="form-label">Zip<span class="req text-danger">*</span></label>--}}
{{--                                    <input type="text" class="form-control " id="Zip" value="{{$customer->zip}}"  disabled>--}}
{{--                                 </div>--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-12 form-group">--}}
{{--                                    <label for="address" class="form-label">Address<span class="req text-danger">*</span></label>--}}
{{--                                    <textarea class="form-control" id="address" rows="3"  disabled>{{$customer->address}}</textarea>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        @include('bonds.sections.footer',['last' => false])
    </section>
</form>
