<div class="SearchFilterPanel active full-box-left">
    <div class="form">
        <div class="row">
            <?php  $total_filters = !empty($filtersFields)?count($filtersFields):0;

            if ($total_filters == 2 ) {
                $columns = 3;
            } else if ($total_filters == 3 || $total_filters == 1) {
                $columns = 3;
            } else if ($total_filters == 4) {
                $columns = 3;
            } else if ($total_filters == 5) {
                $columns = 3;
            } else if ($total_filters == 6) {
                $columns = 3;
            } else if ($total_filters == 7) {
                $columns = 3;
            } else if ($total_filters == 8) {
                $columns = 3;
            } else {
                $columns = 3;
            }
            ?>
            @if(!empty($filtersFields))
                @foreach($filtersFields as $key => $field)
                    <div class="col-lg-{!! $columns !!} col-md-{!! $columns !!} block input-col form-group mt-3 mb-2">
                        <label for="">{!! $field['title'] !!}</label>
                        @switch($field['type'])
                            @case('text')
                            <input autocomplete="off" type="text" name="{!! $key !!}"
                                   placeholder="{!! $field['title'] !!}"
                                   class="form-control form-control-sm {!! $field['class'] !!} formFieldName"
                                   value="{!! $field['value'] ?? '' !!}"
                            >
                            @break
                            @case('number')
                            <input autocomplete="off" type="number" name="{!! $key !!}"
                                   placeholder="{!! $field['title'] !!}"
                                   class="form-control form-control-sm {!! $field['class'] !!} formFieldName"
                                   value="{!! $field['value'] ?? '' !!}"
                            >
                            @break
                            @case('date')
                            <input autocomplete="off" type="date" name="{!! $key !!}"
                                   placeholder="{!! $field['title'] !!}"
                                   class="form-control form-control-sm {!! $field['class'] !!} formFieldName"
                                   value="{!! $field['value'] ?? '' !!}"
                            >
                            @break
                            @case('month')
                            <input autocomplete="off" type="month" name="{!! $key !!}"
                                   placeholder="{!! $field['title'] !!}"
                                   class="form-control form-control-sm {!! $field['class'] !!} formFieldName"
                                   value="{!! $field['value'] ?? '' !!}"
                            >
                            @break
                            @case('select')
                            <select {!! (!empty($field['disabled']) && $field['disabled'])?'disabled':'' !!} target="{!! $field['target']??'' !!}" autocomplete="off" name="{!! $key !!}"
                                    class="form-select form-select-sm {!! $field['class'] !!} formFieldName"
                                    placeholder="{!! $field['placeholder'] !!}" url="{!! $field['url']??'' !!}" params="{!! $field['params']??''!!}" prefix="{!! $field['prefix']??''!!}" >
                                @foreach($field['options'] as $option_key =>$option)
                                    @php $selected  =  (!empty($field['selected']) && $option_key == $field['selected'])?'selected="selected"':''@endphp
                                    <option {!! $selected !!} value="{!! $option_key !!}" {{ $selected }}>{!! $option !!}</option>
                                @endforeach
                            </select>
                            @break
                        @endswitch
                    </div>
                @endforeach
                    <div class="col-lg-3 form-group mt-4 mb-2 filter-button" table="{!! $tableId !!}">
                        <button type="button" class="btn btn-success filterBtn ico-btn"><i class="fa fa-search"></i> Search</button>
                        <button type="button" class="btn btn-success filterBtnReset ico-btn"><i class="fa fa-undo"></i>&nbsp;Reset</button>
                    </div>
            @endif


        </div>

    </div>
</div>

