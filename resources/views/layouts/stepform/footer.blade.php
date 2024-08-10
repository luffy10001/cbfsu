<div class="row footers mt-8">
    <div class="col-12 mt-2 mb-2 ml-3 py-2">
        <a class="btn btn-success cancel-btn " href="{{route($route)}}">Cancel</a>
        <button class="btn btn-primary prevBtn" type="button">Previous</button>
        @if(!$last)
            <button class="btn btn-primary nextBtn" type="button">Next</button>
        @else
            <button class="btn btn-primary form_submit" id="sub_btn" type="button">Submit</button>
        @endif
    </div>
</div>
