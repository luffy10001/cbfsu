<form action="{{route("bond.store")}}" method="POST" enctype="multipart/form-data" class="multiStep"
xmlns="http://www.w3.org/1999/html">
@csrf
<input type="hidden" name="type" value="3">
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
                                <label for="bond_start_date" class="form-label">Estimated Start Date<span class="req text-danger">*</span></label>
                                <input type="date" class="form-control " id="bid_start_date" name="bid_start_date" value="{{$obj->bid_start_date??''}}" required="required">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="bond_completion_date" class="form-label">Substantial Completion Date<span class="req text-danger">*</span></label>
                                <input type="date" class="form-control " id="bid_completion_date" name="bid_completion_date" value="{{$obj->bid_completion_date??''}}" required='required'>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="bid_date" class="form-label">Bid Date<span class="req text-danger">*</span></label>
                                <input type="date" class="form-control" id="bid_date" name="owner_bid_date" value="{{$obj->owner_bid_date??''}}" required='required'>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="bid_amount" class="form-label">How Much Will You Bid  $ <span class="req text-danger">*</span></label>
                                <input type="number" class="form-control " id="bid_bond" name="bid_amount" value="{{$obj->bid_amount??''}}" required='required'>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="project_cost" class="form-label">What is Your Project Cost $<span class="req text-danger">*</span></label>
                                <input type="number" class="form-control " id="project_cost" name="bid_project_cost" value="{{$obj->bid_project_cost??''}}" required='required'>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">GPM  ( % ) <span class="req text-danger">*</span></label>
                                <input type="number" class="form-control" name="gpm" placeholder="GPM" id="gpm" value="{{$obj->gpm??''}}" readonly/>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="bid_bond" class="form-label">Amount of Bid Bond (i.e. 5%, 10%, etc.)<span class="req text-danger">*</span></label>
                                <input type="number" class="form-control"  name="bid_amount_percentage" value="{{$obj->bid_amount_percentage??''}}" required='required'>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="warranty_period" class="form-label"> Warranty Period<span class="req text-danger">*</span></label>
                                <input type="number" class="form-control " id="warranty_period" name="bid_warranty_period" value="{{$obj->bid_warranty_period??''}}" required='required'>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="damages" class="form-label"> Liquidated Damages <span class="req text-danger">*</span></label>
                                <input type="number" class="form-control " id="damages" name="bid_damages" value="{{$obj->bid_damages??''}}" required='required'>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container p-0 mt-4">
        <h6 class="accordion-header mt-0" id="headingFive" style="background-color: #edf7fd;padding:15px">
            <strong>Questions </strong>
        </h6>
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="row">
                            @foreach($quest_data as $key => $item)
                                <div class=" {{ count($quest_data) > 1 ? 'col-md-6' : 'col-md-12'}} mt-3">
                                    <label for="questions_{{ $key }}" class="form-label w-100">{{ $key+1 }}-  {{ $item->question }} ? <span class="req text-danger">*</span></label>
                                    <input type="text" class="form-control" name="ques_answer['{!! $item->id !!}']" required="required" value="{!! $item->answer ?? '' !!}">
                                    <input type="hidden" class="form-control" name="ques_id['{!! $item->id !!}']" value="{{ $item->id ?? '' }}" required="required">
                                </div>
                            @endforeach
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
