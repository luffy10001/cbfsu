<x-custom-modal-component>
    <x-slot name="title">
        {{ __('Create Agent') }}
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
            <form action="{{route('agent.store')}}" method="POST">
                @csrf
                <div class="row relative">
                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Name*</label>
                        <input type="text" class="form-control" placeholder="Name" id="name" name="name">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="email" class="form-label">Email*</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"/>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="Phone" class="form-label">Phone*</label>
                        <input type="phone" class="form-control" id="Phone" name="phone" placeholder="Phone"/>
                    </div>

                    <div class="col-md-12 mb-3 " toggle="password-parent" style="position: relative">
                        <label class=" control-label">Password*</label>
                        <input id="password-field" type="password" class="form-control" name="password">
                        <span class="fa fa-fw fa-eye-slash field-icon toggle-password"> </span>
                    </div>

                    <div class="col-md-12 mb-1 " toggle="password-parent" style="position: relative">
                        <label for="password_confirmation" class="form-label">Confirm Password*</label>
                        <input id="password_confirmation" type="password" class="form-control password"
                               name="password_confirmation">
                        <span class="fa fa-fw fa-eye-slash field-icon toggle-password"> </span>
                    </div>

                </div>
                <button type="button" class="form_submit btn btn-success mt-2">Submit</button>
                <button type="button" class="btn btn-primary cancel-btn mt-2" data-bs-dismiss="modal" aria-label="Close">Cancel
                </button>
            </form>
        </div>
    </x-slot>
</x-custom-modal-component>
{{--<script type="module">--}}
{{--    // $(document).find('#role').select2(--}}
{{--    //     {--}}
{{--    //         dropdownParent: $('#default_modal'),--}}
{{--    //     });--}}
{{--</script>--}}

