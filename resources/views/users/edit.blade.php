<x-custom-modal-component>
    <x-slot name="title">
        {{ __('Edit User') }}
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
            .container{
                padding-top:50px;
                margin: auto;
            }
        </style>
        <div class="modal-body">
            <form action="{{route('users.update')}}" method="POST">
                @csrf
                <input type="hidden" class="form-control" value="{{isset($user->id) ? $user->id: '' }}" id="id" name="id">

                <div class="row">

                    <div class="form-group mb-6 col-md-6">
                        <label for="email" class="form-label">Name*</label>
                        <input type="text" class="form-control" name="name" placeholder="Name"
                               value="{{isset($user->email) ? $user->name : ''}}"/>
                    </div>

                    <div class="form-group mb-6 col-md-6">
                        <label for="email" class="form-label"> Email address* </label>
                        <input type="email" class="form-control" name="email" placeholder="Email"
                               value="{{isset($user->email) ? $user->email : ''}}"/>
                    </div>
                    <div class="col-md-6 mb-0 "  toggle="password-parent" style="position: relative">
                        <label class=" control-label">Password</label>
                        <input id="password-field" type="password" class="form-control" name="password">
                        <span class="fa fa-fw fa-eye-slash field-icon toggle-password"> </span>
                    </div>

                    <div class="col-md-6 mb-3 " toggle="password-parent"  style="position: relative">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input id="password_confirmation" type="password" class="form-control password" name="password_confirmation">
                        <span class="fa fa-fw fa-eye-slash field-icon toggle-password"> </span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="role" class="form-label">Role*</label>
                        <select  placeholder="Select a Role" class="form-select" id="role" name="role">
                            <option value="0"> Select a Role</option>
                            @foreach($roles as $role)
                                <option value="{{$role->id}}" {{ $user->role_id == $role->id ? 'selected':'' }} >{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="button" class="form_submit btn btn-success">Update</button>
                <button type="button" class="btn btn-success cancel-btn " data-bs-dismiss="modal" aria-label="Close">Cancel</button>

            </form>
        </div>
        <script type="module">
        </script>
    </x-slot>
</x-custom-modal-component>
<script type="module">
    $(document).find('#role').select2(
        {
            dropdownParent: $('#default_modal'),
        });
</script>
