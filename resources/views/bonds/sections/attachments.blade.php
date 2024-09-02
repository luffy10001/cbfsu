<form action="{{route("bond.store")}}" method="POST" enctype="multipart/form-data" class="multiStep"
      xmlns="http://www.w3.org/1999/html">
    @csrf
    <input type="hidden" name="type" value="5">
    @if($obj)
        <input type="hidden" name="bond_id" value="{{$obj->id}}">
    @endif
    <section>
        <div class="container p-0 mt-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="attachment" class="form-label">
                                        Please attach a copy of the contract, including “Insurance Requirements<span class="req text-danger">*</span>
                                    </label>

                                @if($obj && isset($obj->attachment))
                                    @if(pathinfo($obj->attachment, PATHINFO_EXTENSION) === 'pdf')
                                        <!-- Display a PDF icon and a link to the PDF -->
                                            <a href="{{ asset('images/bonds/' . $obj->attachment) }}" target="_blank">
                                                <img src="{{ asset('images/pdf.svg') }}" alt="PDF" style="width: 40px; height: 40px;">
                                                View File
                                            </a>
                                    @else
                                        <!-- If it's not a PDF, display the image -->
                                            <img src="{{ asset('images/bonds/' . $obj->attachment) }}" alt="Attachment" style="max-width: 100%;">
                                    @endif
                                        <input type="hidden"    name="attachment" value="{{ $obj->attachment ?? '' }}">

                                @endif

                                <!-- File input field -->
                                    <input type="file" class="form-control mt-2" id="attachment" name="attachment" value="{{ $obj->attachment ?? '' }}" {{ $obj ? '' : 'required="required"' }}>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="panel-body">
        @include('bonds.sections.footer',['last' => true])
    </div>
</form>

