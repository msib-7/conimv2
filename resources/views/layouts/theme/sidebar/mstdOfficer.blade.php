@if (auth()->user()->isMstdOfficer())
    <li class="pc-item pc-caption">
        <label>Menu MSTD OFFICER</label>
        <i class="ti ti-dashboard"></i>
    </li>
    <li class="pc-item {{ request()->is('v1/mstdOfficer/suggestionSystem*') ? 'active' : '' }}">
        <a href="{{ route('v1.mstdOfficer.suggestionSystem.index') }}" class="pc-link">
            <span class="pc-micon">
                <svg class="pc-icon">
                    <use xlink:href="#custom-document-filter"></use>
                </svg>
            </span>
            <span class="pc-mtext">Approval SS</span>
        </a>
    </li>
    <li class="pc-item {{ request()->is('v1/mstdOfficer/costSavingReport*') ? 'active' : '' }}">
        <a href="{{ route('v1.mstdOfficer.csr.index') }}" class="pc-link">
            <span class="pc-micon">
                <svg class="pc-icon">
                    <use xlink:href="#custom-document-filter"></use>
                </svg>
            </span>
            <span class="pc-mtext">Approval CSR</span>
        </a>
    </li>
    <li class="pc-item {{ request()->is('v1/mstdOfficer/qualityCircleProject*') ? 'active' : '' }}">
        <a href="{{ route('v1.mstdOfficer.qcp.index') }}" class="pc-link">
            <span class="pc-micon">
                <svg class="pc-icon">
                    <use xlink:href="#custom-document-filter"></use>
                </svg>
            </span>
            <span class="pc-mtext">Approval QCP</span>
        </a>
    </li>
    <li class="pc-item {{ request()->is('v1/mstdOfficer/oneSheetReport*') ? 'active' : '' }}">
        <a href="{{ route('v1.mstdOfficer.osr.index') }}" class="pc-link">
            <span class="pc-micon">
                <svg class="pc-icon">
                    <use xlink:href="#custom-document-filter"></use>
                </svg>
            </span>
            <span class="pc-mtext">Approval OSR</span>
        </a>
    </li>
@endif
