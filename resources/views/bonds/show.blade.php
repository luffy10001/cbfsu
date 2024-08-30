<x-custom-modal-component>
    <x-slot name="title">
        {{ __($customer->user->name." Details") }}
    </x-slot>
    <x-slot name="body">
        <div class="modal-body">
            <section>
                <div class="container p-0 mt-2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Name</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$customer->user->name}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Email Address</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$customer->user->email}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Phone</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$customer->phone}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Positions Title</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$customer->positions}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Date Signed</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$customer->signed_in}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Zip</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$customer->zip}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">City Name</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$customer->city->name}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">State Name</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$customer->state->name}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Address</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$customer->address}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="modal-footer">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span class="btn btn btn-sm btn-primary cancel-btn" >Close </span>
            </button>
        </div>
    </x-slot>
</x-custom-modal-component>