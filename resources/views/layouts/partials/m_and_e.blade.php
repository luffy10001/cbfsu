
@if( isPermission('undp.operation.index') || isPermission('undp.operation.create') || isPermission('acp.operation.index')
    || isPermission('acp.operation.create') || isPermission('acp.operation.edit') || isPermission('cbo.operation.index') || isPermission('cbo.operation.create') || isPermission('cbo.operation.edit')
    || isPermission('undp.performanceletter.index') || isPermission('undp.performanceletter.create') || isPermission('undp.performanceletter.edit') || isPermission('undp.performanceletter.report')
    || isPermission('undp.risk.index') || isPermission('undp.risk.create') || isPermission('undp.risk.edit') || isPermission('undp.risk.pdfView')
    || isPermission('undp.reports.index') || isPermission('undp.reports.edit')
    || isPermission('undp.plan.index') || isPermission('undp.plan.edit') || isPermission('undp.plan.details') || isPermission('undp.plan.report')
    || isPermission('undp.visit_tracker.index') || isPermission('undp.visit_tracker.edit') || isPermission('undp.visit_tracker.create')
)

    <x-sidebar-dropdown>
        <x-slot name="icon">
            <svg width="18" height="18" class="mr-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 18C6.9 18 6.01 18.9 6.01 20C6.01 21.1 6.9 22 8 22C9.1 22 10 21.1 10 20C10 18.9 9.1 18 8 18ZM2 2V4H4L7.6 11.59L6.25 14.04C6.09 14.32 6 14.65 6 15C6 16.1 6.9 17 8 17H20V15H8.42C8.28 15 8.17 14.89 8.17 14.75L8.2 14.63L9.1 13H16.55C17.3 13 17.96 12.59 18.3 11.97L21.88 5.48C21.96 5.34 22 5.17 22 5C22 4.45 21.55 4 21 4H6.21L5.27 2H2ZM18 18C16.9 18 16.01 18.9 16.01 20C16.01 21.1 16.9 22 18 22C19.1 22 20 21.1 20 20C20 18.9 19.1 18 18 18Z" fill="white"/>
            </svg>
        </x-slot>
        <x-slot name="label">
            M&E Operations
        </x-slot>
        <x-slot name="activeTab">
            {!! ( isCurrentRoute('undp.operation.index') || isCurrentRoute('undp.operation.create') || isCurrentRoute('acp.operation.index') || isCurrentRoute('acp.operation.create') || isCurrentRoute('acp.operation.edit')
            || isCurrentRoute('cbo.operation.index') || isCurrentRoute('cbo.operation.create') || isCurrentRoute('cbo.operation.edit')
            || isCurrentRoute('undp.performanceletter.index') || isCurrentRoute('undp.performanceletter.create') || isCurrentRoute('undp.performanceletter.edit')|| isCurrentRoute('undp.performanceletter.report')
            || isCurrentRoute('undp.risk.index') || isCurrentRoute('undp.risk.create') || isCurrentRoute('undp.risk.edit') || isCurrentRoute('undp.risk.pdfView')
            || isCurrentRoute('undp.reports.index') || isCurrentRoute('undp.reports.edit')
            || isCurrentRoute('undp.plan.index') || isCurrentRoute('undp.plan.calendar') || isCurrentRoute('undp.plan.create') || isCurrentRoute('undp.plan.details') || isCurrentRoute('undp.plan.report') || isCurrentRoute('undp.visit_tracker.index') || isCurrentRoute('undp.visit_tracker.create') || isCurrentRoute('undp.visit_tracker.edit')
            ) ?'show':'' !!}
        </x-slot>
        @if(isPermission('undp.operation.index'))
            <li class="nav-item  ml-3 {!! isCurrentRoute('undp.operation.index') || isCurrentRoute('undp.operation.create')
                || isCurrentRoute('undp.performanceletter.index') || isCurrentRoute('undp.performanceletter.create') || isCurrentRoute('undp.performanceletter.edit')|| isCurrentRoute('undp.performanceletter.report')
                || isCurrentRoute('undp.risk.index') || isCurrentRoute('undp.risk.create') || isCurrentRoute('undp.risk.edit') || isCurrentRoute('undp.risk.pdfView')
                || isCurrentRoute('undp.reports.index')|| isCurrentRoute('undp.reports.edit')
                || isCurrentRoute('undp.plan.calendar') || isCurrentRoute('undp.plan.create') || isCurrentRoute('undp.plan.details') || isCurrentRoute('undp.plan.report') || isCurrentRoute('undp.visit_tracker.index') || isCurrentRoute('undp.visit_tracker.create') || isCurrentRoute('undp.visit_tracker.edit')
                 ?'live-active':'' !!}">
                <a class="nav-link" href="{{route('undp.operation.index')}}">
                    UNDP(PR)
                </a>
            </li>
        @endif

        @if(isPermission('cbo.operation.index'))
            <li class="nav-item ml-3 {!! isCurrentRoute('cbo.operation.index') || isCurrentRoute('cbo.operation.create') || isCurrentRoute('cbo.operation.edit')?'live-active':'' !!}">
                <a class="nav-link" href="{{route('cbo.operation.index')}}">
                    CBO
                </a>
            </li>
        @endif

        @if(isPermission('acp.operation.index'))
            <li class="nav-item ml-3 {!! isCurrentRoute('acp.operation.index') || isCurrentRoute('acp.operation.create') || isCurrentRoute('acp.operation.edit') ?'live-active':'' !!}">
                <a class="nav-link" href="{{route('acp.operation.index')}}">
                    ACP
                </a>
            </li>
        @endif
    </x-sidebar-dropdown>
@endif