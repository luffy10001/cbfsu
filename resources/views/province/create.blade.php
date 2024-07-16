<x-custom-modal-component>
    <x-slot name="title">
            {{ __('Add State') }}
    </x-slot>
    <x-slot name="body">
        <div class="modal-body">
            <form action="{{route("state.store")}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </x-slot>
</x-custom-modal-component>