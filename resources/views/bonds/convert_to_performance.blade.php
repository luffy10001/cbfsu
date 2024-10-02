<x-custom-modal-component>
    <x-slot name="title">
        {{ __('Convert into performance bond') }}
    </x-slot>
    <x-slot name="body">

        <div class="modal-body">
            <form action="{{route('bond.storeConvertToPerformance')}}" method="POST">
                @csrf
                <input type="hidden" class="form-control" value="{{isset($d_id) ? $d_id: '' }}" id="id" name="id">

                <div class="col-md-12 mb-3">
                    <label class="form-label">Contract Details<span class="req text-danger">*</span></label>
                    <input type="text" class="form-control"  name="contract_detail" value="{{$bond->perf_contract_detail??''}}"/>
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Contract Date<span class="req text-danger">*</span></label>
                    <input type="date" class="form-control"  name="contract_date" value="{{$bond->perf_contract_date??''}}"/>
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Contract Amount<span class="req text-danger">*</span></label>
                    <input type="number" class="form-control"  name="contract_amount" value="{{$bond->perf_contract_amount??''}}"/>
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Description<span class="req text-danger">*</span></label>
                    <input type="text" class="form-control"  name="description" value="{{$bond->perf_description??''}}"/>
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Bond Details<span class="req text-danger">*</span></label>
                    <input type="text" class="form-control"  name="bond_detail" value="{{$bond->perf_bond_detail??''}}"/>
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Date<span class="req text-danger">*</span></label>
                    <input type="date" class="form-control"  name="date" value="{{$bond->perf_date??''}}"/>
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Amount<span class="req text-danger">*</span></label>
                    <input type="number" class="form-control"  name="amount" value="{{$bond->perf_amount??''}}"/>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Attached Contract Document<span class="req text-danger">*</span></label>
                    <input type="file" class="form-control mt-2" id="attachment" name="contract_document" value="{{ $bond->perf_contract_document ?? ''}}">

                    @if($bond && isset($bond->perf_contract_document))
                        @if(pathinfo($bond->perf_contract_document, PATHINFO_EXTENSION) === 'pdf')
                            <!-- Display a PDF icon and a link to the PDF -->
                            <a href="{{ asset('images/bonds/' . $bond->perf_contract_document) }}" target="_blank">
                                <img src="{{ asset('images/pdf.svg') }}" alt="PDF" style="width: 40px; height: 40px;">
                                View File
                            </a>
                        @else
                            <!-- If it's not a PDF, display the image -->
                            <img src="{{ asset('images/bonds/' . $bond->perf_contract_document) }}" alt="Attachment" style="max-width: 100%;">
                        @endif
                        <input type="hidden" name="attachment" value="{{ $bond->perf_contract_document ?? '' }}">

                    @endif
                </div>

                <button type="button" class="form_submit btn btn-success">Save</button>
                <button type="button" class="btn btn-success cancel-btn " data-bs-dismiss="modal" aria-label="Close">Cancel</button>

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
