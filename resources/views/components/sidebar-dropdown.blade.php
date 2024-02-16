<?php $li = str_replace('/','_',strtolower(str_replace(' ','_',$label)));?>
<li class="nav-item active {!! $activeTab??'' !!}" label="label_{!! $li !!}">
    <a slot_index="label_{!! $li !!}" class="iocn-link nav-link" href="javascript:void(0)">
        <span class="link_name">{!! $label !!}</span>
        <i class='bi bi-chevron-down arrow'></i>
    </a>
    <ul class="nav flex-column sub-menu">
        {!! $slot !!}
    </ul>
</li>
<?php $activeTab ='';?>