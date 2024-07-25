
@if( isPermission('finance.undp.index')
     || isPermission('finance.undp.risk.index') || isPermission('finance.undp.risk.edit') || isPermission('finance.undp.risk.pdfView')
     || isPermission('finance.undp.performanceletter.index') || isPermission('finance.undp.performanceletter.edit') || isPermission('finance.undp.performanceletter.create') || isPermission('finance.undp.performanceletter.report')
     || isPermission('finance.undp.plan.index') || isPermission('finance.undp.plan.edit') || isPermission('finance.undp.plan.details') || isPermission('finance.undp.plan.report')
    )
    <x-sidebar-dropdown>
        <x-slot name="icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 4H4C2.89 4 2.01 4.89 2.01 6L2 18C2 19.11 2.89 20 4 20H20C21.11 20 22 19.11 22 18V6C22 4.89 21.11 4 20 4ZM20 18H4V12H20V18ZM20 8H4V6H20V8Z" fill="white"/>
            </svg>
        </x-slot>
        <x-slot name="label">
            Finance
        </x-slot>
        <x-slot name="activeTab">
            {!! ( isCurrentRoute('finance.undp.index')
                || isCurrentRoute('finance.undp.risk.index') || isCurrentRoute('finance.undp.risk.edit')|| isCurrentRoute('finance.undp.risk.pdfView')
                || isCurrentRoute('finance.undp.plan.index') || isCurrentRoute('finance.undp.plan.calendar') || isCurrentRoute('finance.undp.plan.create') || isCurrentRoute('finance.undp.plan.details') || isCurrentRoute('finance.undp.plan.report')
                || isCurrentRoute('finance.undp.performanceletter.index') || isCurrentRoute('finance.undp.performanceletter.create') || isCurrentRoute('finance.undp.performanceletter.edit')
                ) ?'show':'' !!}
        </x-slot>

        @if(isPermission('psm.undp.index'))
            <li class="nav-item ml-3  {!! isCurrentRoute('finance.undp.index')
                                        || isCurrentRoute('finance.undp.risk.index')|| isCurrentRoute('finance.undp.risk.edit') || isCurrentRoute('finance.undp.risk.pdfView')
                                        || isCurrentRoute('finance.undp.plan.calendar') || isCurrentRoute('finance.undp.plan.create') || isCurrentRoute('finance.undp.plan.details') || isCurrentRoute('finance.undp.plan.report')
                                        || isCurrentRoute('finance.undp.performanceletter.index') || isCurrentRoute('finance.undp.performanceletter.create') || isCurrentRoute('finance.undp.performanceletter.report')
                                            ?'live-active':'' !!}">
                <a class="nav-link" href="{{route('finance.undp.index')}}">
                    UNDP(PR)
                </a>
            </li>
        @endif

        @if(isPermission('acp.psm.index'))
            <li class="nav-item ml-3  {!! isCurrentRoute('acp.psm.index') || isCurrentRoute('acp.request.index') || isCurrentRoute('acp.request.create') ?'live-active':'' !!}">
                <a class="nav-link" href="#">
                    ACP
                </a>
            </li>
        @endif

        @if(isPermission('cbo.psm.index'))
            <li class="nav-item ml-3 {!! isCurrentRoute('cbo.psm.index') || isCurrentRoute('cbo.request.index') || isCurrentRoute('cbo.request.create') ?'live-active':'' !!}">
                <a class="nav-link" href="#">
                    CBO
                </a>
            </li>
        @endif


    </x-sidebar-dropdown>
@endif