<x-custom-modal-component>
    <x-slot name="title">
        {{ __("Seal & Signature Details") }}
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
                                            <p class="text-muted mb-0">{{$signature->name}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Attachment Type</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$signature->attachment_type == 1 ? "Seal" : "Signature" }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Attachment</p>
                                        </div>
                                        <div class="col-sm-9">
                                            @if(isset($signature->attachment))
                                                @if(pathinfo($signature->attachment, PATHINFO_EXTENSION) === 'pdf')
                                                    <!-- Display a PDF icon and a link to the PDF -->
                                                    <a href="{{ asset('images/signature/' . $signature->attachment) }}" target="_blank">
                                                        <img src="{{ asset('images/pdf.svg') }}" alt="PDF" style="width: 40px; height: 20px;">
                                                        View File
                                                    </a>
                                                @else
                                                    <!-- If it's not a PDF, display the image -->
                                                    <img src="{{ asset('images/signature/' . $signature->attachment) }}" alt="Attachment" style="max-width: 50%;">
                                                @endif
                                            @endif
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
