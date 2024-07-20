<x-custom-modal-component xmlns="http://www.w3.org/1999/html">
    <x-slot name="title">
        {{ __('Add Customer') }}
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
            <form action="{{route('customer.store')}}" method="POST">
                @csrf
                <div class="row relative">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Name*</label>
                        <input type="text" class="form-control" placeholder="Name" id="name" name="name">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="contact_name" class="form-label">Contact Name*</label>
                        <input type="text" class="form-control" placeholder="Contact Name" id="contact_name" name="contact_name">
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
                        <label for="zip" class="form-label">Zip*</label>
                        <input type="text" class="form-control" id="zip" name="zip" placeholder="Zip"/>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="address" class="form-label">Address*</label>
                        <textarea class="form-control" id="address" name="address" placeholder="Address" rows="3"></textarea>
                    </div>


                    <div class="col-md-6 mb-0 " toggle="password-parent" style="position: relative">
                        <label class=" control-label">Password*</label>
                        <input id="password-field" type="password" class="form-control" name="password">
                        <span class="fa fa-fw fa-eye-slash field-icon toggle-password"> </span>
                    </div>

                    <div class="col-md-6 mb-3 " toggle="password-parent" style="position: relative">
                        <label for="password_confirmation" class="form-label">Confirm Password*</label>
                        <input id="password_confirmation" type="password" class="form-control password"
                               name="password_confirmation">
                        <span class="fa fa-fw fa-eye-slash field-icon toggle-password"> </span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="positions" class="form-label">Positions Title*</label>
                        <select  placeholder="Select a Position" class="form-select" id="positions" name="positions">
                            <option value="0"> Select a positions</option>
                            @foreach(positions() as $key => $position)
                                <option value="{{$key}}">{{$position}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="agent_id" class="form-label">Agent*</label>
                        <select  placeholder="Select a Agent" class="form-select" id="agent_id" name="agent_id">
                            <option value="0"> Select a Agent</option>
                            @foreach($agents as $agent)
                                <option value="{{$agent->id}}">{{$agent->name}}</option>
                            @endforeach
                        </select>
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
    $(document).find('#role').select2(
        {
            dropdownParent: $('#default_modal'),
        });
</script>

