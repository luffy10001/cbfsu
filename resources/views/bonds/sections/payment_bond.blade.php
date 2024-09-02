<form action="{{route("bond.store")}}" method="POST" enctype="multipart/form-data" class="multiStep"
      xmlns="http://www.w3.org/1999/html">
    @csrf
    <input type="hidden" name="type" value="4">
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
                                    <label for="contract_date" class="form-label">Contract Date<span class="req text-danger">*</span></label>
                                    <input type="date" class="form-control " id="contract_date" name="pb_contract_date" value="{{$obj->pb_contract_date??''}}" required='required'>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="contract_amount" class="form-label">Contract Amount $<span class="req text-danger">*</span></label>
                                    <input type="number" class="form-control " id="contract_amount" name="pb_contract_amount" value="{{$obj->pb_contract_amount??''}}" required='required'>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="estimated_profit" class="form-label">Estimated Profit<span class="req text-danger">*</span></label>
                                    <input type="number" class="form-control " id="estimated_profit" name="pb_estimated_profit" value="{{$obj->pb_estimated_profit??''}}" required='required'>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="start_date" class="form-label">Start Date<span class="req text-danger">*</span></label>
                                    <input type="date" class="form-control " id="start_date" name="pb_start_date" value="{{$obj->pb_start_date??''}}" required='required'>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="substantial_completion_date" class="form-label">Substantial Completion Date<span class="req text-danger">*</span></label>
                                    <input type="date" class="form-control " id="substantial_completion_date" name="pb_completion_date" value="{{$obj->pb_completion_date??''}}" required='required'>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="warranty_period" class="form-label">Warranty Period<span class="req text-danger">*</span></label>
                                    <input type="number" class="form-control " id="warranty_period" name="pb_warranty_period" value="{{$obj->pb_warranty_period??''}}" required='required'>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="damages" class="form-label"> Liquidated Damages <span class="req text-danger">*</span></label>
                                   <input type="number" class="form-control " id="damages" name="pb_damages" value="{{$obj->pb_damages??''}}" required='required'>
                                </div>
                            </div>

                            <div class="row relative radio-row">
                                <div class="col-md-12">
                                    <label for="damages" class="form-label"> Will more than 30% of this project be subcontracted out?<span class="req text-danger">*</span></label>
                                </div>
                                <div class="col-md-12">
                                    <input id="Active" type="radio" class="" name="is_subcontracted" value="1" @if($obj) {{$obj->is_subcontracted==true ?'checked':'' }} @endif>
                                    <label for="Active" class="btn-radio "  > Yes </label><br>
                                    <input id="Discontinue" type="radio" class=" btn-radio" name="is_subcontracted" value="0" @if($obj) {{ $obj->is_subcontracted==false ?'checked':'' }} @endif>
                                    <label class="" for="Discontinue"> No </label>
                                </div>

                            </div>
                            @if($obj)
                                <div class="subcontractor  {{ count($obj->subcontractors) > 0 ? '' : 'hidden' }} " >
                                    <label for="bond_start_date" class="form-label">If Yes, please complete below</label>
                                        @if(count($obj->subcontractors) > 0 )
                                            @foreach($obj->subcontractors as $key => $contractor)
                                                <x-subcontractor :itemNo="$key" :contractor="$contractor"/>
                                            @endforeach
                                        @else
                                            <x-subcontractor :itemNo="0" :contractor=false/>
                                        @endif
                                </div>
                            @else
                                <x-subcontractor :itemNo="0" :contractor=false />
                            @endif
                            <div class="row mt-3 add_subcontractor     @if($obj) {{ count($obj->subcontractors) > 0 ? '' : 'hidden' }}  @endif ">
                                <div class="col-12 mt-2 mb-2 ">
                                    <button type="button" class="btn btn-success btn-xs add_more">Add More</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="panel-body">
        @include('bonds.sections.footer',['last' => false])
    </div>
</form>
<script>
    $('input[name="is_subcontracted"]').change(function() {
        var selectedValue = $('input[name="is_subcontracted"]:checked').val();
        if(selectedValue==1){
            $(document).find('.subcontractor').removeClass('hidden');
            $(document).find('.add_subcontractor').removeClass('hidden');
        }else{
            $(document).find('.subcontractor').addClass('hidden');
            $(document).find('.add_subcontractor').addClass('hidden');
        }
    });
    $(document).on('click','.add_more',function(e){
        e.preventDefault();
        var itemCount = $('div.item-row').length;
        itemCount++;

        $.ajax({
            url: '/append_subcontractor_form', // Replace with your route
            method: 'GET',
            data:{'itemCount':itemCount},
            success: function(response) {
                if(response){
                    $('.subcontractor').append(response);
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
    $(document).on('click','.remove-item',function (e){
        $(this).parents('.item-row').remove();
    });
</script>
