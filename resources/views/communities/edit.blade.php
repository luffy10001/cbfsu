<x-custom-modal-component>
    <x-slot name="title">
            {{ __('Edit Community') }}
    </x-slot>
    <x-slot name="body">
        <div class="modal-body">
            <form action="{{route("community.update")}}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$community->id}}">
                <div class="row relative">
                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Name*</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$community->name}}">
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </x-slot>
</x-custom-modal-component>