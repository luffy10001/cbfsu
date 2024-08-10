<x-app-layout>
    <x-slot name="title">
        {{ __('Edit Insurer') }}
    </x-slot>

    <div class="modal-body mt-3">
        <form action="{!!route('insurer.update')  !!}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{$insurer->id}}">

            <h5><strong>Surety Information</strong> </h5>
            <div class="row relative custom_border">
                <div class="col-md-4 mb-3">
                    <label for="name" class="form-label">Surety Name<span class="req text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Surety Name" id="name" name="name" value="{{$insurer->name}}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="am_best_rating" class="form-label">AM Best Rating<span class="req text-danger">*</span></label>
                    <select  placeholder="Select AM Best Rating" class="form-select select2selector" id="am_best_rating" name="am_best_rating">
                        <option value="0"> Select AM Best Rating</option>
                        @foreach(am_best_rating() as $key => $item)
                            <option value="{{$key}}" @selected($key == $insurer->am_best_rating)> {{ $item }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="phone" class="form-label">Treasury Listed<span class="req text-danger">*</span></label>
                    <input type="text" class="form-control" name="treasury" placeholder="Treasury Listed" value="{{$insurer->treasury_list}}"/>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="address" class="form-label">Address<span class="req text-danger">*</span></label>
                    <input class="form-control" type="text" name="address" placeholder="Address" value="{{$insurer->address}}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="name" class="form-label">Sate<span class="req text-danger">*</span></label>
                    <select target='select[name="city_id"]' placeholder="Select City"
                            url="{!! route('state.get-cities') !!}" params="province_id" name="province_id"
                            class="form-select changeInputMws input_province_id select2selector">
                        <option value="0">Select State</option>
                        @foreach($provinces as $row)
                            <option value="{!! $row->id !!}" @selected($row->id==$insurer->state_id)>{!! $row->name !!}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="city_id" class="form-label">City<span class="req text-danger">*</span></label>
                    <select name="city_id" class="form-select city_id_selector select2selector">
                        <option value="0">Select City</option>
                        @foreach($cities as $row)
                            <option value="{!! $row->id !!}" @selected($row->id==$insurer->city_id)>{!! $row->name !!}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="zip" class="form-label">Zip<span class="req text-danger">*</span></label>
                    <input type="text" class="form-control" id="zip" name="zip" placeholder="Zip" value="{{$insurer->zip}}"/>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="zip" class="form-label">Surety Website<span class="req text-danger">*</span></label>
                    <input type="text" class="form-control" id="zip" name="website" placeholder="Surety Website" value="{{$insurer->website}}"/>
                </div>
            </div>

            <h5 class="mt-4"><strong> Bond Underwriter Information</strong> </h5>
            <div class="row mt-2 custom_border">
                <div class="col-md-4 mb-3">
                    <label for="zip" class="form-label">Contract Bond Underwriter<span class="req text-danger">*</span></label>
                    <input type="text" class="form-control" id="zip" name="cbu_name" placeholder="Contract Bond Underwriter" value="{{$insurer->cbu_name}}"/>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="zip" class="form-label">Phone<span class="req text-danger">*</span></label>
                    <input type="text" class="form-control" id="zip" name="cbu_phone" placeholder="Phone" value="{{$insurer->cbu_phone}}"/>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="zip" class="form-label">Email<span class="req text-danger">*</span></label>
                    <input type="text" class="form-control" id="zip" name="cbu_email" placeholder="Email" value="{{$insurer->cbu_email}}"/>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="zip" class="form-label">Commercial Bond Underwriter<span class="req text-danger">*</span></label>
                    <input type="text" class="form-control" id="zip" name="clbu_name" placeholder="Contract Bond Underwriter" value="{{$insurer->clbu_name}}"/>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="zip" class="form-label">Phone<span class="req text-danger">*</span></label>
                    <input type="text" class="form-control" id="zip" name="clbu_phone" placeholder="Phone" value="{{$insurer->clbu_phone}}"/>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="zip" class="form-label">Email<span class="req text-danger">*</span></label>
                    <input type="text" class="form-control" id="zip" name="clbu_email" placeholder="Email" value="{{$insurer->clbu_email}}"/>
                </div>
            </div>

            <h5 class="mt-4"><strong>Attorney's-in-Fact Information</strong> </h5>
            <div class="row mt-2 custom_border">
                <div class="col-md-4 mb-3">
                    <label for="zip" class="form-label">Attorney's-in-Fact<span class="req text-danger">*</span></label>
                    <input type="text" class="form-control" id="zip" name="attorney" placeholder="Attorney's-in-Fact" value="{{$insurer->attorney}}"/>
                </div>
            </div>
            {{--                <div class="col-md-6 mb-3">--}}
            {{--                    <label for="Underwriter" class="form-label">Underwriter Name*</label>--}}
            {{--                    <select  placeholder="Select Underwriter" class="form-select select2selector" id="Underwriter_id" name="underwriter_id">--}}
            {{--                        <option value="0"> Select Underwriter</option>--}}
            {{--                        @foreach($underwriters as $obj)--}}
            {{--                            <option value="{{$obj->id}}"> {{ $obj->name }} </option>--}}
            {{--                        @endforeach--}}
            {{--                    </select>--}}
            {{--                </div>--}}
            <button type="button" class="form_submit btn btn-success mt-3">Update</button>
            <a href="{!! route('insurer.index') !!}">
                <button type="button" class="btn btn-primary cancel-btn mt-3" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
            </a>
        </form>
    </div>

</x-app-layout>
<script type="module">
    $('.select2selector').select2({
        placeholder: 'Select an option',

    });

</script>


