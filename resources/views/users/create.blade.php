<x-custom-modal-component>
    <x-slot name="title">
        {{ __('Create User') }}
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
            <form action="{{route('users.store')}}" method="POST">
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
                        <label for="role" class="form-label">Role*</label>
                        <select  placeholder="Select a Role" class="form-select" id="role" name="role">
                            <option value="0"> Select a Role</option>
                            @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <button type="button" class="form_submit btn btn-primary mt-3">Submit</button>
                <button type="button" class="btn btn-primary mt-3" data-bs-dismiss="modal" aria-label="Close">Cancel
                </button>
            </form>
        </div>
        <script type="module">
            $(document).find('.city_selector').select2(
                {
                    dropdownParent: $('#default_modal'),
                });
        </script>
    </x-slot>
</x-custom-modal-component>


