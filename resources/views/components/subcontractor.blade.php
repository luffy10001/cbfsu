<div class="item-row">
    <div class="card mt-2">
        <div class="card-body">
            @php
                $itemNo = $itemNo ?? 1;
            @endphp
            @if($itemNo!=1)
                <div class="row mb-0">
                    <div class="col-md-11">
                    </div>
                    <div class="col-md-1 mb-0">
                        <label class="form-label float-end remove-item mb-0"> <i class="bi bi-trash text-danger remove-item"></i>  </label>
                    </div>
                </div>
            @endif
            <div class="row mt-2">
                <div class="col-md-6 form-group">
                    <label for="Name" class="form-label"> Name of Subcontractor <span class="req text-danger">*</span></label>
                    <input type="text" class="form-control input-data_{{$itemNo}}_name" name="data[{{$itemNo}}][name]"
                           id="Name" placeholder="Name"  value="{{ $contractor->name ?? ''}}" >
                </div>
                <div class="col-md-6 form-group">
                    <label for="type" class="form-label"> Type of Work Subcontracted <span class="req text-danger">*</span></label>
                    <input type="text" class="form-control input-data_{{$itemNo}}_type" name="data[{{$itemNo}}][type]"
                           id="type" placeholder="Type "  value="{{ $contractor->type ?? ''}}">
                </div>
                <div class="col-md-6 form-group">
                    <label for="amount" class="form-label"> Amount of Bid <span class="req text-danger">*</span></label>
                    <input type="number" class="form-control input-data_{{$itemNo}}_amount" name="data[{{$itemNo}}][amount]"
                           id="amount" placeholder="Amount of Bid"  value="{{ $contractor->bid_amount ?? ''}}">
                </div>

                <div class="col-md-6 form-group">
                    <label for="Stock" class="form-label col-md-12 pl-0 mb-3"> Is Subcontractor Bonded?<span class="req text-danger">*</span></label>
                    <input id="Active" type="radio" class="input-data_{{$itemNo}}_bonded" name="data[{{$itemNo}}][bonded]" value="1" @if($contractor) {{$contractor->is_bonded==true ?'checked':'' }} @endif>
                    <label for="Active" class="btn-radio "> Yes </label>
                    <input id="Discontinue" type="radio" class=" btn-radio input-data_{{$itemNo}}_bonded" name="data[{{$itemNo}}][bonded]" value="0" @if($contractor) {{$contractor->is_bonded==false ?'checked':'' }} @endif>
                    <label class="" for="Discontinue"> No </label>
                </div>
            </div>
        </div>
    </div>
</div>