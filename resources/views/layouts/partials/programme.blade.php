
@if( isPermission('programme.undp.index')
     || isPermission('programme.undp.risk.index') || isPermission('programme.undp.risk.edit') || isPermission('programme.undp.risk.pdfView')
     || isPermission('programme.undp.plan.index') || isPermission('programme.undp.plan.edit') || isPermission('programme.undp.plan.details') || isPermission('programme.undp.plan.report')
     || isPermission('programme.undp.performanceletter.index') || isPermission('programme.undp.performanceletter.edit') || isPermission('programme.undp.performanceletter.report')
    )
    <x-sidebar-dropdown>
        <x-slot name="icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18 17H6V15H18V17ZM18 13H6V11H18V13ZM18 9H6V7H18V9ZM3 22L4.5 20.5L6 22L7.5 20.5L9 22L10.5 20.5L12 22L13.5 20.5L15 22L16.5 20.5L18 22L19.5 20.5L21 22V2L19.5 3.5L18 2L16.5 3.5L15 2L13.5 3.5L12 2L10.5 3.5L9 2L7.5 3.5L6 2L4.5 3.5L3 2V22Z" fill="white"/>
            </svg>
        </x-slot>
        <x-slot name="label">
            Programme
        </x-slot>
        <x-slot name="activeTab">
            {!! ( isCurrentRoute('programme.undp.index')
               || isCurrentRoute('programme.undp.risk.index') || isCurrentRoute('programme.undp.risk.edit')|| isCurrentRoute('programme.undp.risk.pdfView')
               || isCurrentRoute('programme.undp.plan.index') || isCurrentRoute('programme.undp.plan.calendar') || isCurrentRoute('programme.undp.plan.create') || isCurrentRoute('programme.undp.plan.details') || isCurrentRoute('programme.undp.plan.report')
               || isCurrentRoute('programme.undp.plan.calendar') || isCurrentRoute('programme.undp.plan.create') || isCurrentRoute('programme.undp.plan.details') || isCurrentRoute('programme.undp.plan.report')
               || isCurrentRoute('programme.undp.performanceletter.index') || isCurrentRoute('programme.undp.performanceletter.edit') || isCurrentRoute('programme.undp.performanceletter.report')
                ) ?'show':'' !!}
        </x-slot>

        @if(isPermission('psm.undp.index'))
            <li class="nav-item ml-3  {!! isCurrentRoute('programme.undp.index')
                                        || isCurrentRoute('programme.undp.risk.index')|| isCurrentRoute('programme.undp.risk.edit') || isCurrentRoute('programme.undp.risk.pdfView')|| isCurrentRoute('programme.undp.performanceletter.index')|| isCurrentRoute('programme.undp.performanceletter.edit')|| isCurrentRoute('programme.undp.performanceletter.report')
                                            ?'live-active':'' !!}">
                <a class="nav-link" href="{{route('programme.undp.index')}}">
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