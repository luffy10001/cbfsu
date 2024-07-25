
@if( isPermission('psm.dashboard') || isPermission('art.psm.index') || isPermission('art.request.index') || isPermission('art.request.create')
    || isPermission('cbo.psm.index') || isPermission('cbo.request.index') || isPermission('cbo.request.create')
    || isPermission('acp.psm.index') || isPermission('acp.request.index') || isPermission('acp.request.create')
    || isPermission('psm.undp.risk.index') || isPermission('psm.undp.risk.edit') || isPermission('psm.undp.risk.pdfView')
    || isPermission('psm.undp.plan.index') || isPermission('psm.undp.plan.edit') || isPermission('psm.undp.plan.details') || isPermission('psm.undp.plan.report')
    )
    <x-sidebar-dropdown>
        <x-slot name="icon">
            <svg width="18" height="18" class="mr-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 11H7V13H9V11ZM13 11H11V13H13V11ZM17 11H15V13H17V11ZM19 4H18V2H16V4H8V2H6V4H5C3.89 4 3.01 4.9 3.01 6L3 20C3 21.1 3.89 22 5 22H19C20.1 22 21 21.1 21 20V6C21 4.9 20.1 4 19 4ZM19 20H5V9H19V20Z" fill="white"/>
            </svg>
        </x-slot>
        <x-slot name="label">
            PSM
        </x-slot>
        <x-slot name="activeTab">
            {!! ( isCurrentRoute('psm.dashboard') || isCurrentRoute('art.psm.index') || isCurrentRoute('art.request.index') || isCurrentRoute('art.request.create') ||
                  isCurrentRoute('cbo.psm.index') || isCurrentRoute('cbo.request.index') || isCurrentRoute('cbo.request.create') ||
                  isCurrentRoute('acp.psm.index') || isCurrentRoute('acp.request.index') || isCurrentRoute('acp.request.create') ||
                  isCurrentRoute('psm.undp.index')|| isCurrentRoute('psm.undp.stock.index')
                  || isCurrentRoute('psm.undp.plan.index') || isCurrentRoute('psm.undp.plan.calendar') || isCurrentRoute('psm.undp.plan.create') || isCurrentRoute('psm.undp.plan.details') || isCurrentRoute('psm.undp.plan.report')
                  || isCurrentRoute('psm.undp.dispatchNote.index') || isCurrentRoute('psm.undp.dispatchNote.edit')|| isCurrentRoute('psm.undp.dispatchNote.view')
                  || isCurrentRoute('psm.undp.grn.index') || isCurrentRoute('psm.undp.grn.edit')|| isCurrentRoute('psm.undp.grn.view')
                  || isCurrentRoute('psm.undp.risk.index') || isCurrentRoute('psm.undp.risk.edit')|| isCurrentRoute('psm.undp.risk.pdfView')
                ) ?'show':'' !!}
        </x-slot>
        @if(isPermission('psm.dashboard'))
            <li class="nav-item ml-3  {!! isCurrentRoute('psm.dashboard')  ?'live-active':'' !!}">
                <a class="nav-link" href="{{route('psm.dashboard')}}">
                    Dashboard
                </a>
            </li>
        @endif

        @if(isPermission('psm.undp.index'))
            <li class="nav-item ml-3  {!! isCurrentRoute('psm.undp.index') || isCurrentRoute('psm.undp.stock.index')
                                        || isCurrentRoute('psm.undp.plan.index')
                                        || isCurrentRoute('psm.undp.plan.calendar') || isCurrentRoute('psm.undp.plan.create') || isCurrentRoute('psm.undp.plan.details') || isCurrentRoute('psm.undp.plan.report')
                                        || isCurrentRoute('psm.undp.dispatchNote.index')|| isCurrentRoute('psm.undp.dispatchNote.edit') || isCurrentRoute('psm.undp.dispatchNote.view')
                                        || isCurrentRoute('psm.undp.grn.index')|| isCurrentRoute('psm.undp.grn.edit') || isCurrentRoute('psm.undp.grn.view')
                                        || isCurrentRoute('psm.undp.risk.index')|| isCurrentRoute('psm.undp.risk.edit') || isCurrentRoute('psm.undp.risk.pdfView')
                                            ?'live-active':'' !!}">
                <a class="nav-link" href="{{route('psm.undp.index')}}">
                    UNDP(PR)
                </a>
            </li>
        @endif



        @if(isPermission('acp.psm.index'))
            <li class="nav-item ml-3  {!! isCurrentRoute('acp.psm.index') || isCurrentRoute('acp.request.index') || isCurrentRoute('acp.request.create') ?'live-active':'' !!}">
                <a class="nav-link" href="{{route('acp.psm.index')}}">
                    ACP
                </a>
            </li>
        @endif

        @if(isPermission('cbo.psm.index'))
            <li class="nav-item ml-3 {!! isCurrentRoute('cbo.psm.index') || isCurrentRoute('cbo.request.index') || isCurrentRoute('cbo.request.create') ?'live-active':'' !!}">
                <a class="nav-link" href="{{route('cbo.psm.index')}}">
                    CBO
                </a>
            </li>
        @endif

        @if(isPermission('art.psm.index'))
            <li class="nav-item ml-3 {!! isCurrentRoute('art.psm.index') || isCurrentRoute('art.request.index') || isCurrentRoute('art.request.create') ?'live-active':'' !!}">
                <a class="nav-link" href="{{route('art.psm.index')}}">
                    ART Center
                </a>
            </li>
        @endif
    </x-sidebar-dropdown>
@endif
