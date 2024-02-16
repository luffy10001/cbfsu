<a href="javascript:void(0)" class="modal_open" url="" size="sm">View Area</a>
{{--
@if(!empty($user->user_areas))
    @php
        $areas = $user->user_areas->pluck('area.name')->toArray();
    @endphp
    <span>
        @if (count($areas) > 0)
            <span class="badge bg-secondary" style="font-size: 9px"> {{ $areas[0] }}</span>
        @endif
        @if (count($areas) > 1)
            <span class="badge bg-secondary data_display " style="font-size: 9px"> ... </span>
            <div class="popup hidden">
                @foreach($areas as $area)
                    <span class="badge bg-secondary">{{ $areas[0] != $area ? $area : '' }}</span>
                @endforeach
            </div>
        @endif
    </span>
@endif
<style>
    .popup{
        max-height:200px;
        cursor: pointer;
        overflow: scroll;
    }
</style>
<script type="module">
    $(document).on('mouseenter','.data_display',function(){
        $(this).next('.popup').show();
    });
    $(document).on('mouseleave', '.data_display', function () {
        if (!$(this).next('.popup').is(':hover')) {
            $(this).next('.popup').hide();
        }
    });
    $(document).on('mouseleave', '.popup', function () {
        $(this).hide();
    });
</script>--}}
