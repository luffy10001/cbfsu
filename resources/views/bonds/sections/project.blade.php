<form action="{{route("bond.store")}}" method="POST" enctype="multipart/form-data" class="multiStep"
      xmlns="http://www.w3.org/1999/html">
    @csrf
    <input type="hidden" name="type" value="2">
    @if($obj)
        <input type="hidden" name="bond_id" value="{{$obj->id}}">
    @endif
    <section>
        <div class="container p-0 mt-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="owner_name" class="form-label">Oblige/Owner Name<span class="req text-danger">* </span></label>
                                    <input type="text" class="form-control " id="owner_name" name="owner_name" value="{{$obj->owner_name??''}}" required="required">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Oblige/Owner State<span class="req text-danger">*</span></label>
                                    <select target='select[name="owner_city"]' placeholder="Select City"
                                            url="{!! route('state.get-cities') !!}" params="province_id" name="owner_state"
                                            class="form-select changeInputMws input_province_id select2selector" required='required'>
                                        <option value="null">Select State</option>
                                        @foreach($provinces as $row)
                                            <option value="{!! $row->id !!}" @if($obj) {{$obj->owner_state==$row->id ? 'selected' :''}} @endif> {!! $row->name !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="city_id" class="form-label">Oblige/Owner City<span class="req text-danger">*</span></label>
                                    <select name="owner_city" class="form-select city_id_selector select2selector" required='required'>
                                        <option value="null">Select City</option>
                                        @foreach($cities as $row)
                                            <option value="{!! $row->id !!}" @if($obj) {{$obj->owner_city==$row->id ? 'selected' :''}} @endif> {!! $row->name !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="owner_zip" class="form-label">Oblige/Owner Zip<span class="req text-danger">*</span></label>
                                    <input type="text" class="form-control " id="owner_zip" name="owner_zip"  value="{{$obj->owner_zip??''}}" required='required'>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="owner_address" class="form-label">Oblige/Owner Zip Address<span class="req text-danger">*</span></label>
                                    <textarea class="form-control" id="address" name="owner_address" rows="3">{{$obj->owner_address??''}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="Description" class="form-label">Job Description<span class="req text-danger">*</span></label>
                                    <textarea class="form-control" id="Description" name="job_description" rows="3">{{$obj->job_description??''}}</textarea>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="location" class="form-label">Job Location<span class="req text-danger">*</span></label>
                                    <textarea class="form-control" id="location" name="job_location" rows="3">{{$obj->job_location??''}}</textarea>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="bid_date" class="form-label">Bid Date<span class="req text-danger">*</span></label>
                                    <input type="date" class="form-control" id="bid_date" name="owner_bid_date" value="{{$obj->owner_bid_date??''}}" required='required'>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="panel-body">
        @include('bonds.sections.footer',['last' => false])
    </div>
    <script>
        $(document).find('.select2selector').select2();
    </script>
</form>