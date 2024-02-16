<?php $randomId = mwsUuid(); ?>
<div class="bs-example">
    <div class="dropdown mws-dropdown">
        <button class="btn dropdown-toggle" type="button" id="list_{!! $randomId !!}" data-bs-toggle="dropdown" aria-expanded="false">
            {!! $label??'<i class="bi bi-three-dots-vertical"></i>' !!}
        </button>
        <ul class="dropdown-menu" aria-labelledby="list_{!! $randomId !!}">
            {!! $slot !!}
        </ul>
    </div>
</div>