<x-app-layout>
    <x-slot name="title">
        {{ __('Create Insurer') }}
    </x-slot>

    <div class="modal-body mt-3">
        <form action="{!!route('insurer.store')  !!}" method="POST">
            @csrf
            <h5 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight font-weight-bold">Surety Information</h5>
            <div class="mt-2">
                <div class="card">
                    <div class="card-body">
                        <div class="row relative">
                            <div class="col-md-4 mb-3">
                                <label for="name" class="form-label">Surety Name<span class="req text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Surety Name" id="name" name="name">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="am_best_rating" class="form-label">AM Best Rating<span class="req text-danger">*</span></label>
                                <select  placeholder="Select AM Best Rating" class="form-select select2selector" id="am_best_rating" name="am_best_rating">
                                    <option value="0"> Select AM Best Rating</option>
                                    @foreach(am_best_rating() as $key => $item)
                                        <option value="{{$key}}"> {{ $item }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="phone" class="form-label">Treasury Listed<span class="req text-danger">*</span></label>
                                <input type="text" class="form-control" name="treasury" placeholder="Treasury Listed"/>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="address" class="form-label">Address<span class="req text-danger">*</span></label>
                                <input class="form-control" type="text" name="address" placeholder="Address" >
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="name" class="form-label">State<span class="req text-danger">*</span></label>
                                <select target='select[name="city_id"]' placeholder="Select City"
                                        url="{!! route('state.get-cities') !!}" params="province_id" name="province_id"
                                        class="form-select changeInputMws input_province_id select2selector">
                                    <option value="0">Select State</option>
                                    @foreach($provinces as $row)
                                        <option value="{!! $row->id !!}">{!! $row->name !!}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="city_id" class="form-label">City<span class="req text-danger">*</span></label>
                                <select name="city_id" class="form-select city_id_selector select2selector">
                                    <option value="0">Select City</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="zip" class="form-label">Zip<span class="req text-danger">*</span></label>
                                <input type="text" class="form-control" id="zip" name="zip" placeholder="Zip"/>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="zip" class="form-label">Surety Website<span class="req text-danger">*</span></label>
                                <input type="text" class="form-control" id="zip" name="website" placeholder="Surety Website"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h5 class="mt-2 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight font-weight-bold">Bond Underwriter Information</h5>
            <div class="mt-2">
                <div class="card">
                    <div class="card-body">
                        <div class="row mt-2">
                            <div class="col-md-4 mb-3">
                                <label for="zip" class="form-label">Contract Bond Underwriter<span class="req text-danger">*</span></label>
                                <input type="text" class="form-control" id="zip" name="cbu_name" placeholder="Contract Bond Underwriter"/>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="zip" class="form-label">Phone<span class="req text-danger">*</span></label>
                                <input type="text" class="form-control" id="zip" name="cbu_phone" placeholder="Phone"/>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="zip" class="form-label">Email<span class="req text-danger">*</span></label>
                                <input type="text" class="form-control" id="zip" name="cbu_email" placeholder="Email"/>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="zip" class="form-label">Commercial Bond Underwriter<span class="req text-danger">*</span></label>
                                <input type="text" class="form-control" id="zip" name="clbu_name" placeholder="Contract Bond Underwriter"/>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="zip" class="form-label">Phone<span class="req text-danger">*</span></label>
                                <input type="text" class="form-control" id="zip" name="clbu_phone" placeholder="Phone"/>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="zip" class="form-label">Email<span class="req text-danger">*</span></label>
                                <input type="text" class="form-control" id="zip" name="clbu_email" placeholder="Email"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h5 class="mt-2 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight font-weight-bold">Attorney's-in-Fact Information</h5>
            <div class="mt-2">
                <div class="card">
                    <div class="card-body">
                        <div class="row mt-2">
                            <div class="col-md-4 mb-3">
                                <label for="zip" class="form-label">Attorney's-in-Fact<span class="req text-danger">*</span></label>
                                <input type="text" class="form-control" id="zip" name="attorney" placeholder="Attorney's-in-Fact"/>
                            </div>
                        </div>
                    </div>
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
            <button type="button" class="form_submit btn btn-success mt-3">Submit</button>
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

