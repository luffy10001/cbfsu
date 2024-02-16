<x-custom-modal-component>
    <x-slot name="title">
            {{ __('Add Service') }}
    </x-slot>
    <x-slot name="body">
        <div class="modal-body">
            <form action="{{route("service.store")}}" method="POST">
                @csrf
                <div class="row relative">
                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Name*</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </x-slot>
</x-custom-modal-component>