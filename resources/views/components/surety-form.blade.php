<div class="row">
    <div class="col-md-6 mb-3">
        <label for="rating" class="form-label">AM Best Rating<span class="req text-danger">*</span></label>
        <input type="text" class="form-control" id="rating" name="rating" placeholder="AM Best Rating" value="{{$insurer->am_best_rating}}"/>
    </div>
    <div class="col-md-6 mb-3">
        <label for="treasury_list" class="form-label">Treasury Listed <span class="req text-danger">*</span></label>
        <input type="text" class="form-control" id="treasury_list" name="treasury_list" placeholder="Treasury Listed" value="{{$insurer->treasury_list}}"/>
    </div>
    <div class="col-md-6 mb-3">
        <label for="underwriter_name" class="form-label">Underwriter Name<span class="req text-danger">*</span></label>
        <input type="text" class="form-control" id="underwriter_name" name="underwriter_name" placeholder="Underwriter Name"value="{{$insurer->cbu_name}}"/>
    </div>
    <div class="col-md-6 mb-3">
        <label for="underwriter_phone" class="form-label">Underwriter Phone<span class="req text-danger">*</span></label>
        <input type="text" class="form-control" id="underwriter_phone" name="underwriter_phone" placeholder="Underwriter Phone" value="{{$insurer->cbu_phone}}"/>
    </div>
    <div class="col-md-6 mb-3">
        <label for="underwriter_email" class="form-label">Underwriter Email<span class="req text-danger">*</span></label>
        <input type="text" class="form-control" id="underwriter_email" name="underwriter_email" placeholder="Underwriter Email" value="{{$insurer->cbu_email}}"/>
    </div>
</div>