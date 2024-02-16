<x-custom-modal-component>
    <x-slot name="title">
        {{ __('Assign Target') }}
    </x-slot>
    <x-slot name="body">
        <div class="modal-body">
            <form method="POST" action="{!! route("userTargetStore") !!}">
                <div class="ml-3">
                    <?php
                    $currentMonth = date('n');
                    $currentYear = date('Y');
                    $i=0;

                    for ($month = $currentMonth; $month <= $currentMonth + 12; $month++) {
                        $year = $currentYear + floor(($month - 1) / 12); // Calculate the year
                        $monthNumber = ($month - 1) % 12 + 1; // Calculate the month number (1-12)
                        $monthName = date("F", mktime(0, 0, 0, $monthNumber, 1, $year)); // Get the month name
                        ?>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-md-2 col-form-label"><?php echo $monthName . " " . $year; ?></label>
                        <input type="hidden"  name="month[{!! $i !!}]" value="{!!  $monthNumber  !!}" />
                        <input type="hidden"  name="year[{!! $i !!}]" value="{!!  $year  !!}" />
                        <label for="inputPassword" class="col-md-2 col-form-label"> {{ $role_id->role_id== "6" ? 'Target Call' : 'Target Amount' }}</label>
                        <div class="col-md-4">
                            <input type="number" name="amount_target[{!! $i !!}]" value="{!! $assign_target[$i]['target'] ?? '' !!}" class="form-control" />

                            @error('amount_target')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                        <?php
                    $i=$i+1;}
                    ?>
                </div>
                <input type="hidden"  name="user_id" value="{!!  $user_id ?? '' !!}" />
                <input type="hidden"  name="role_id" value="{!! $role_id->role_id ?? '' !!} " />
                <input type="hidden"  name="department_id" value="{!! $role_id->department_id ?? '' !!} " />
                <div class="col-12">
                    <button type="button" class="form_submit btn btn-primary mt-3">Submit</button>

                    <button type="button" class="btn btn-primary mt-3" data-bs-dismiss="modal" aria-label="Close">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </x-slot>

</x-custom-modal-component>

{{--<script type="module">--}}
{{--    $(document).ready(function() {--}}
{{--        const $dateInput = $('.dateInput');--}}
{{--        const today = new Date();--}}
{{--        const yyyy = today.getFullYear();--}}
{{--        let mm = today.getMonth() + 1; // January is 0--}}
{{--        let dd = today.getDate();--}}

{{--        if (mm < 10) {--}}
{{--            mm = '0' + mm;--}}
{{--        }--}}

{{--        if (dd < 10) {--}}
{{--            dd = '0' + dd;--}}
{{--        }--}}

{{--        const minDate = yyyy + '-' + mm + '-' + dd;--}}
{{--        $(".date_value").val(minDate)--}}
{{--        console.log(minDate);--}}
{{--        $dateInput.attr('min', minDate);--}}

{{--    });--}}
{{--    $(document).ready(function() {--}}
{{--        $('.dateInput').on('keydown', function(e) {--}}
{{--            e.preventDefault(); // Prevent keyboard input--}}
{{--        });--}}
{{--    });--}}

{{--</script>--}}