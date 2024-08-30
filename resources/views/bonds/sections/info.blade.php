
<form action="{{route("bond.store")}}" method="POST" enctype="multipart/form-data" class="multiStep">
    @csrf
        <input type="hidden" name="type" value="1">
    @if($obj)
        <input type="hidden" name="bond_id" value="{{$obj->id}}">
    @endif
    <section id="hell" class="section">
        <div class="container p-0 mt-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="MonitoredBy" class="form-label">Company Name<span class="req text-danger">*</span></label>
                                    <input type="text" class="form-control " id="MonitoredBy" value="{{$user->name}}" disabled >
                                    <input type="hidden" class="form-control " name="customer_id" id="customer_id" value="{{$customer->id}}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="State" class="form-label">State<span class="req text-danger">*</span></label>
                                    <input type="text" class="form-control " id="State" value="{{$customer->state->name}}" disabled >
                                 </div>
                                <div class="col-md-6 form-group">
                                    <label for="City" class="form-label">City<span class="req text-danger">*</span></label>
                                    <input type="text" class="form-control " id="City" value="{{$customer->city->name}}"  disabled>
                                 </div>
                                <div class="col-md-6 form-group">
                                    <label for="Zip" class="form-label">Zip<span class="req text-danger">*</span></label>
                                    <input type="text" class="form-control " id="Zip" value="{{$customer->zip}}"  disabled>
                                 </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="address" class="form-label">Address<span class="req text-danger">*</span></label>
                                    <textarea class="form-control" id="address" rows="3"  disabled>{{$customer->address}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('bonds.sections.footer',['last' => false])
    </section>
</form>