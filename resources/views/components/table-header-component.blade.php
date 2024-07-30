<div class="filter-mws">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        <strong>{{$title??''}}</strong>
        <div class="button-mws">
            <button  class="btn btn-success mr-1 mws-filter"><i class="fa fa-filter"></i> Filter</button>
            {!! $buttons??'' !!}
        </div>
    </h2>
    {!! $slot !!}
</div>
