<x-custom-modal-component xmlns="http://www.w3.org/1999/html">
    <x-slot name="title">
        {{ __('Add Insurer') }}
    </x-slot>

    <x-slot name="body">
        <style>
            .field-icon {
                top: 40px;
                right: 30px;
                position: absolute;
                z-index: 2;
                cursor: pointer;
            }
            .container {
                padding-top: 50px;
                margin: auto;
            }
        </style>
        <div class="modal-body">
            <form action="{!!route('insurer.store')  !!}" method="POST">
                @csrf
                <div class="row relative">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Name*</label>
                        <input type="text" class="form-control" placeholder="Name" id="name" name="name">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email*</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"/>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Phone*</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone"/>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Sate<span class="req text-danger">*</span></label>
                        <select target='select[name="city_id"]' placeholder="Select City"
                                url="{!! route('state.get-cities') !!}" params="province_id" name="province_id"
                                class="form-select changeInputMws input_province_id select2selector">
                            <option value="0">Select State</option>
                            @foreach($provinces as $row)
                                <option value="{!! $row->id !!}">{!! $row->name !!}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="city_id" class="form-label">City<span class="req text-danger">*</span></label>
                        <select name="city_id" class="form-select city_id_selector select2selector">
                            <option value="0">Select City</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="zip" class="form-label">Zip*</label>
                        <input type="text" class="form-control" id="zip" name="zip" placeholder="Zip"/>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="Underwriter" class="form-label">Underwriter Name*</label>
                        <select  placeholder="Select Underwriter" class="form-select select2selector" id="Underwriter_id" name="underwriter_id">
                            <option value="0"> Select Underwriter</option>
                            @foreach($underwriters as $obj)
                                <option value="{{$obj->id}}"> {{ $obj->name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="am_best_rating" class="form-label">AM Best Rating*</label>
                        <select  placeholder="Select AM Best Rating" class="form-select select2selector" id="am_best_rating" name="am_best_rating">
                            <option value="0"> Select AM Best Rating</option>
                            @foreach(am_best_rating() as $key => $item)
                                <option value="{{$key}}"> {{ $item }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="address" class="form-label">Address*</label>
                        <textarea class="form-control" id="address" name="address" placeholder="Address" rows="3"></textarea>
                    </div>
                </div>
                <button type="button" class="form_submit btn btn-success mt-3">Submit</button>
                <button type="button" class="btn btn-primary cancel-btn mt-3" data-bs-dismiss="modal" aria-label="Close">Cancel
                </button>
            </form>
        </div>
    </x-slot>
</x-custom-modal-component>
<script type="module">
    $(document).find('.select2selector').select2(
        {
            dropdownParent: $('#default_modal'),
        });
</script>

