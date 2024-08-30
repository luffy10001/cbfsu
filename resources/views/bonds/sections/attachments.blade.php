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
                                <div class="col-md-6 form-group">
                                    <label for="attachment" class="form-label">Please attach copy of contract, including “Insurance Requirements<span class="req text-danger">*</span></label>
                                    <input type="file" class="form-control " id="attachment" name="attachment" value="" required="required">
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

