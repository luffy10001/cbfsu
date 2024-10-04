<style>
    .custom-modal-body {
        max-height: 800px; /* Adjust the height as needed */
        overflow-y: auto;  /* Scrollbar for overflowing content */
    }

    /*.modal-dialog {*/
    /*    max-width: 600px; !* Adjust the modal width as needed *!*/
    /*}*/
</style>

<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{$title}}</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="custom-modal-body">
            {{$body}}
        </div>
    </div>
 </div>

{{--
<script>
    $('.close').on('click', function () {
        location.reload();
    });
</script>--}}
