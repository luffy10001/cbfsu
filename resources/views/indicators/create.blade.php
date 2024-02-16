<x-custom-modal-component>
    <x-slot name="title">
            {{ __('Add Indicator') }}
    </x-slot>
    <x-slot name="body">
        <div class="modal-body">
            <form action="{{route("indicator.store")}}" method="POST">
                @csrf
                <div class="row relative">
                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Name*</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="service" class="form-label">Service*</label>
                        <select  placeholder="Select a Service" class="form-select" id="service" name="service">
                            <option value="0"> Select a Service</option>
                            @foreach($service as $row)
                                <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </x-slot>
</x-custom-modal-component>
<script type="module">
    $(document).find('#service').select2({
        dropdownParent: $('#default_modal'),
    });
</script>