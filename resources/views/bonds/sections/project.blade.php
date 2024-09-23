<form action="{{route("bond.store")}}" method="POST" enctype="multipart/form-data" class="multiStep"
      xmlns="http://www.w3.org/1999/html">
    @csrf
    <input type="hidden" name="type" value="2">
    @if($obj)
        <input type="hidden" name="bond_id" value="{{$obj->id}}">
    @endif
    <input type="hidden" class="form-control " name="customer_id" id="customer_id" value="{{$customer->id}}">
    <section>
        <div class="container p-0 mt-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="row">
{{--                            <div class="col-md-4 form-group">--}}
{{--                                <label for="Description" class="form-label">Job Description<span class="req text-danger">*</span></label>--}}
{{--                                <textarea class="form-control" id="Description" name="job_description" rows="3">{{$obj->job_description??''}}</textarea>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-4 form-group">--}}
{{--                                <label for="location" class="form-label">Job Location<span class="req text-danger">*</span></label>--}}
{{--                                <textarea class="form-control" id="location" name="job_location" rows="3">{{$obj->job_location??''}}</textarea>--}}
{{--                            </div>--}}
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Project Name<span class="req text-danger">*</span></label>
                                    <input type="text" class="form-control"  name="project_name" value="{{$obj->name??''}}" placeholder="Project Name"/>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="name" class="form-label">Project State<span class="req text-danger">*</span></label>
                                    <select target='select[name="city_id"]' placeholder="Select City"
                                            url="{!! route('state.get-cities') !!}" params="city_id" name="province_id"
                                            class="form-select changeInputMws input_city_id select2selector">
                                        <option value="">Select State</option>
                                            @foreach($provinces as $row)
                                                <option value="{!! $row->id !!}" @if($obj) {{$obj->state_id==$row->id ? 'selected' :''}} @endif> {!! $row->name !!}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="city_id" class="form-label">Project City<span class="req text-danger">*</span></label>
                                    <select name="city_id" class="form-select city_id_selector select2selector" >
                                        <option value="">Select City</option>
                                        @if(isset($cities))
                                            @foreach($cities as $row)
                                                <option value="{!! $row->id !!}" @if($obj) {{$obj->city_id==$row->id ? 'selected' :''}} @endif> {!! $row->name !!}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Project Zip<span class="req text-danger">*</span></label>
                                    <input type="text" class="form-control"  name="project_zip" value="{{$obj->zip??''}}" placeholder="Project Zip"/>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Project Address<span class="req text-danger">*</span></label>
                                    <input type="text" class="form-control"  name="project_address" value="{{$obj->address??''}}" placeholder="Project Address"/>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Project Delivery Method<span class="req text-danger">*</span></label>
                                    <input type="number" class="form-control"  name="project_delivery_method" value="{{$obj->delivery_method??''}}" placeholder="Project Delivery Method"/>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Estimate Project Start Date<span class="req text-danger">*</span></label>
                                    <input type="date" class="form-control"  name="est_pro_start" value="{{$obj->start_date??''}}"/>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Estimate Project Completion Date<span class="req text-danger">*</span></label>
                                    <input type="date" class="form-control"  name="est_pro_compl" value="{{$obj->completion_date??''}}"/>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Warranty Term<span class="req text-danger">*</span></label>
                                    <input type="text" class="form-control"  name="warranty_term" placeholder="Warranty Term" value="{{$obj->warranty_terms??''}}"/>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Liquidated Damages<span class="req text-danger">*</span></label>
                                    <input type="number" class="form-control"  name="liquidated_damages" placeholder="Liquidated Damages" value="{{$obj->damages??''}}"/>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Retainage Amount<span class="req text-danger">*</span></label>
                                    <input type="number" class="form-control"  name="retainage_amount" placeholder="Retainage Amount" value="{{$obj->retain_amount??''}}"/>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Current Backlog<span class="req text-danger">*</span></label>
                                    <input type="text" class="form-control"  name="current_backlog" placeholder="Current Backlog" value="{{$obj->current_backlog??''}}"/>
                                </div>
    {{--                            <div class="col-md-4 form-group">--}}
    {{--                                <label for="bid_date" class="form-label">Bid Date<span class="req text-danger">*</span></label>--}}
    {{--                                <input type="date" class="form-control" id="bid_date" name="owner_bid_date" value="{{$obj->owner_bid_date??''}}" required='required'>--}}
    {{--                            </div>--}}

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">GPM<span class="req text-danger">*</span></label>
                                    <input type="number" class="form-control" name="gpm" placeholder="GPM" value="{{$obj->gpm??''}}"/>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Engineer Name<span class="req text-danger">*</span></label>
                                    <input type="text" class="form-control"  name="engineer_name" placeholder="Engineer Name" value="{{$obj->engineer_name??''}}"/>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="owner_name" class="form-label">Oblige/Owner Name<span class="req text-danger">* </span></label>
                                    <input type="text" class="form-control " id="owner_name" name="owner_name" value="{{$obj->owner_name??''}}" required="required">
                                </div>
                                <div class="col-md-4 mb-3">
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
                                <div class="col-md-4">
                                    <label for="city_id" class="form-label">Oblige/Owner City<span class="req text-danger">*</span></label>
                                    <select name="owner_city" class="form-select  select2selector" required='required'>
                                        <option value="null">Select City</option>
                                        @foreach($cities as $row)
                                            <option value="{!! $row->id !!}" @if($obj) {{$obj->owner_city==$row->id ? 'selected' :''}} @endif> {!! $row->name !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="owner_zip" class="form-label">Oblige/Owner Zip<span class="req text-danger">*</span></label>
                                    <input type="text" class="form-control " id="owner_zip" name="owner_zip"  value="{{$obj->owner_zip??''}}" required='required'>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="owner_address" class="form-label">Oblige/Owner Address<span class="req text-danger">*</span></label>
                                    <input class="form-control" id="address" name="owner_address" value="{{$obj->owner_address??''}}">
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
