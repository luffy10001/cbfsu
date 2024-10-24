<x-custom-modal-component>
    <x-slot name="title">
        {{ __('Create Seal & Signature') }}
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
            <form action="{{route('signature.store')}}" method="POST">
                @csrf
                <div class="row relative">
                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Name*</label>
                        <input type="text" class="form-control" placeholder="Name" id="name" name="name">
                    </div>

                    <div class="col-md-12 mb-0">
                        <label for="role" class="form-label">Attachment Type*</label>
                        <select  placeholder="Select Attachment Type" class="form-select" id="role" name="attachment_type">
                            <option value="0"> Select Attachment Type</option>
                            <option value="1"> Seal</option>
                            <option value="2"> Signature</option>
                        </select>
                    </div>

                    <div class="col-md-12 mt-3">
                        <label for="file" class="form-label">Attachment*</label>
                        <input type="file" class="form-control" id="file" name="attachment" placeholder=""/>
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
    $(document).find('#role').select2(
        {
            dropdownParent: $('#default_modal'),
        });
</script>

