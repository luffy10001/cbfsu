
@if(isPermission('institution.index') || isPermission('cbo.index') || isPermission('cbo.create') || isPermission('indicator.index')
|| isPermission('medicine.index') || isPermission('commodity.index') || isPermission('art.index')|| isPermission('art.create') || isPermission('art.edit')
|| isPermission('acp.index')|| isPermission('acp.create'))
<x-sidebar-dropdown>
    <x-slot name="icon">
        <svg width="18" height="18" class="mr-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M20 6H16V4C16 2.89 15.11 2 14 2H10C8.89 2 8 2.89 8 4V6H4C2.89 6 2.01 6.89 2.01 8L2 19C2 20.11 2.89 21 4 21H20C21.11 21 22 20.11 22 19V8C22 6.89 21.11 6 20 6ZM14 6H10V4H14V6Z" fill="white"/>
        </svg>
    </x-slot>
    <x-slot name="label">
        System Initialization
    </x-slot>
    <x-slot name="activeTab">
        {!! (isCurrentRoute('institution.index') || isCurrentRoute('cbo.index') || isCurrentRoute('cbo.create') || isCurrentRoute('cbo.edit') || isCurrentRoute('indicator.index')
        || isCurrentRoute('medicine.index') || isCurrentRoute('commodity.index') || isCurrentRoute('art.index')
        || isCurrentRoute('art.create') || isCurrentRoute('art.edit') || isCurrentRoute('acp.index') || isCurrentRoute('acp.create') || isCurrentRoute('acp.edit') )?'show':'' !!}
    </x-slot>
    @if(isPermission('institution.index'))
        <li class="nav-item ml-3 {!! isCurrentRoute('institution.index') || isCurrentRoute('cbo.index') || isCurrentRoute('cbo.create') || isCurrentRoute('cbo.edit') || isCurrentRoute('indicator.index') || isCurrentRoute('art.index')
            || isCurrentRoute('art.create') || isCurrentRoute('art.edit')
                            || isCurrentRoute('acp.index') || isCurrentRoute('acp.create') || isCurrentRoute('acp.edit') || isCurrentRoute('acp.edit') ?'live-active':'' !!}">
            <a class="nav-link" href="{{route('institution.index')}}">
                Institutions
            </a>
        </li>
    @endif

    @if(isPermission('medicine.index'))
        <li class="nav-item ml-3 {!! isCurrentRoute('medicine.index') || isCurrentRoute('commodity.index') ?'live-active':'' !!}">
            <a class="nav-link " href="{{route('medicine.index')}}">
                PSM Resource Mgmt
            </a>
        </li>
    @endif
    <li class="nav-item">
        <a class="nav-link ml-3" href="#">
            Financial Management
        </a>
    </li>

</x-sidebar-dropdown>
@endif