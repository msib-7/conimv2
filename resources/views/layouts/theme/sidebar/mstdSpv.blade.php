@if (auth()->user()->isMstdSpv())
    <li class="pc-item pc-caption">
        <label>Menu MSTD SPV</label>
        <i class="ti ti-dashboard"></i>
    </li>
    <li class="pc-item {{ request()->is('v1/mstdSpv/suggestionSystem*') ? 'active' : '' }}">
        <a href="{{ route('v1.mstdSpv.suggestionSystem.index') }}" class="pc-link">
            <span class="pc-micon">
                <svg class="pc-icon">
                    <use xlink:href="#custom-document-filter"></use>
                </svg>
            </span>
            <span class="pc-mtext">Approval SS</span>
        </a>
    </li>
    <li class="pc-item {{ request()->is('v1/mstdSpv/costSavingReport*') ? 'active' : '' }}">
        <a href="{{ route('v1.mstdSpv.costSavingReport.index') }}" class="pc-link">
            <span class="pc-micon">
                <svg class="pc-icon">
                    <use xlink:href="#custom-document-filter"></use>
                </svg>
            </span>
            <span class="pc-mtext">Approval CSR</span>
        </a>
    </li>

    <li class="pc-item {{ request()->is('v1/mstdSpv/qualityCircleProject*') ? 'active' : '' }}">
        <a href="{{ route('v1.mstdSpv.qcp.index') }}" class="pc-link">
            <span class="pc-micon">
                <svg class="pc-icon">
                    <use xlink:href="#custom-document-filter"></use>
                </svg>
            </span>
            <span class="pc-mtext">Approval QCP</span>
        </a>
    </li>
    <li class="pc-item {{ request()->is('v1/mstdSpv/oneSheetReport*') ? 'active' : '' }}">
        <a href="{{ route('v1.mstdSpv.osr.index') }}" class="pc-link">
            <span class="pc-micon">
                <svg class="pc-icon">
                    <use xlink:href="#custom-document-filter"></use>
                </svg>
            </span>
            <span class="pc-mtext">Approval OSR</span>
        </a>
    </li>
@endif
