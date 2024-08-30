<div class="row footers mt-8" id="test">
    <div class="col-12 mt-2 mb-2 ml-3 py-2">
        <a class="btn btn-success cancel-btn " href="{{route('bond.index')}}">Cancel {{$last}}</a>
        <button class="btn btn-primary prevBtn" type="button">Previous</button>
        @if(!$last)
            <button class="btn btn-primary nextBtn form_submit" type="button"> Save & Next </button>
        @else
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <button class="btn btn-primary modal_submits"> Submit </button>
            <button class="btn btn-primary  form_submit hidden" id="sub_btn" type="button">Submit</button>
            <script>
                $(document).ready(function() {
                    $(document).on('click', '.modal_submits', function(e) {
                        e.preventDefault();

                        Swal.fire({
                            title: 'Are you sure?',
                            text: "Do you want to submit this form!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, do it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('.form_submit.hidden').trigger('click');
                            }
                        });
                    });
                });

            </script>
        @endif
    </div>
</div>
