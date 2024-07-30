<x-custom-modal-component xmlns="http://www.w3.org/1999/html">
    <x-slot name="title">
        {{ __('Edit Customer') }}
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
            <form action="{{route('customer.update')}}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$customer->id}}">
                <div class="row relative">
                    <div class="col-md-4 mb-3">
                        <label for="name" class="form-label">Name*</label>
                        <input type="text" class="form-control" placeholder="Name" id="name" name="name"
                        value="{{$customer->user->name}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="contact_name" class="form-label">Contact Name*</label>
                        <input type="text" class="form-control" placeholder="Contact Name" id="contact_name"
                               name="contact_name" value="{{$customer->contact_name}}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="email" class="form-label">Email*</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                               value="{{$customer->user->email}}" />
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="phone" class="form-label">Phone*</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone"
                               value="{{$customer->phone}}"/>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="name" class="form-label">Sate<span class="req text-danger">*</span></label>
                        <select target='select[name="city_id"]' placeholder="Select City"
                                url="{!! route('state.get-cities') !!}" params="province_id" name="province_id"
                                class="form-select changeInputMws input_province_id select2selector">
                            <option value="0">Select State</option>
                            @foreach($provinces as $row)
                                <option value="{!! $row->id !!}" @selected( $customer->state_id==$row->id) >{!! $row->name !!}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="city_id" class="form-label">City<span class="req text-danger">*</span></label>
                        <select name="city_id" class="form-select city_id_selector select2selector">
                            <option value="0">Select City</option>
                            @foreach($cities as $row)
                                <option value="{!! $row->id !!}" @selected( $customer->city_id==$row->id) >{!! $row->name !!}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="zip" class="form-label">Zip*</label>
                        <input type="text" class="form-control" id="zip" name="zip" placeholder="Zip"
                               value="{{$customer->zip}}"/>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="positions" class="form-label">Positions Title*</label>
                        <select  placeholder="Select a Position" class="form-select select2selector" id="positions" name="positions">
                            <option value="0"> Select a positions</option>
                            @foreach(positions() as $key => $position)
                                <option value="{{$key}}" @selected($key== $customer->positions)>{{$position}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="agent_id" class="form-label">Service Agent Name*</label>
                        <select  placeholder="Select a Agent" class="form-select select2selector" id="agent_id" name="agent_id">
                            <option value="0"> Select a Agent</option>
                            @foreach($agents as $agent)
                                <option value="{{$agent->id}}" @selected($agent->id== $customer->agent_id)> {{ $agent->name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-0 " toggle="password-parent" style="position: relative">
                        <label class=" control-label">Password*</label>
                        <input id="password-field" type="password" class="form-control" name="password">
                        <span class="fa fa-fw fa-eye-slash field-icon toggle-password"> </span>
                    </div>

                    <div class="col-md-4 mb-3 " toggle="password-parent" style="position: relative">
                        <label for="password_confirmation" class="form-label">Confirm Password*</label>
                        <input id="password_confirmation" type="password" class="form-control password"
                               name="password_confirmation">
                        <span class="fa fa-fw fa-eye-slash field-icon toggle-password"> </span>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="address" class="form-label">Address*</label>
                        <textarea class="form-control" id="address" name="address" placeholder="Address" rows="3">{{$customer->address}}</textarea>
                    </div>
                </div>
                <button type="button" class="form_submit btn btn-success mt-2">Submit</button>
                <button type="button" class="btn btn-primary cancel-btn mt-2" data-bs-dismiss="modal" aria-label="Close">Cancel
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

