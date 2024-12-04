<ul class="pc-navbar">
    <li class="pc-item pc-caption">
        <label>Navigation</label>
        <i class="ti ti-dashboard"></i>
    </li>
    <li class="pc-item">
        <a href="{{ route('v1.dashboard') }}" class="pc-link">
            <span class="pc-micon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="pc-icon">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                </svg>
            </span>
            <span class="pc-mtext">Dashboard</span>
        </a>
    </li>

    @include('layouts.theme.sidebar.admin')
    @include('layouts.theme.sidebar.mstdOfficer')
    @include('layouts.theme.sidebar.mstdSpv')
    @include('layouts.theme.sidebar.userFa')

    @foreach (auth()->user()->layout() as $menu)
        <!-- Judul Menu -->
        <li class="pc-item pc-caption">
            <label>{{ $menu->label }}</label>
            @if ($menu->icon)
                <i class="ti ti-dashboard"></i>
            @endif
        </li>

        <!-- Sub-Menu -->
        @foreach ($menu->children->sortBy('order') as $child)
            <li class="pc-item {{ request()->is(str_replace('.', '/', $child->route) . '*') ? 'active' : '' }}">
                <a href="{{ route($child->route) }}" class="pc-link">
                    <span class="pc-micon">
                        <svg class="pc-icon">
                            <use xlink:href="#{{ $child->icon }}"></use>
                        </svg>
                    </span>
                    <span class="pc-mtext">{{ $child->label }}</span>
                </a>
            </li>
        @endforeach
    @endforeach

    {{-- <li class="pc-item pc-caption">
        <label>Manage Suggestion System</label>
        <i class="ti ti-dashboard"></i>
    </li>

    <li class="pc-item {{ request()->is('v1/Suggestion-System*') ? 'active' : '' }}">
        <a href="{{ route('v1.ss.index') }}" class="pc-link">
            <span class="pc-micon">
                <svg class="pc-icon">
                    <use xlink:href="#custom-document-filter"></use>
                </svg>
            </span>
            <span class="pc-mtext">List SS</span>
        </a>
    </li>
    <li class="pc-item {{ request()->is('v1/approval/fasilitator/suggestion-System*') ? 'active' : '' }}">
        <a href="{{ route('v1.approval.fasilitator.suggestion_System.index') }}" class="pc-link">
            <span class="pc-micon">
                <svg class="pc-icon">
                    <use xlink:href="#custom-security-safe"></use>
                </svg>
            </span>
            <span class="pc-mtext">Approval SS</span>
        </a>
    </li>

    <li class="pc-item pc-caption">
        <label>Manage Cost Saving Report</label>
        <i class="ti ti-dashboard"></i>
    </li>

    <li class="pc-item {{ request()->is('v1/CostSavingReport*') ? 'active' : '' }}">
        <a href="{{ route('v1.csr.index') }}" class="pc-link">
            <span class="pc-micon">
                <svg class="pc-icon">
                    <use xlink:href="#custom-document-filter"></use>
                </svg>
            </span>
            <span class="pc-mtext">List CSR</span>
        </a>
    </li>
    <li class="pc-item {{ request()->is('v1/approval/fasilitator/costsavingreport*') ? 'active' : '' }}">
        <a href="{{ route('v1.approval.fasilitator.csr.index') }}" class="pc-link">
            <span class="pc-micon">
                <svg class="pc-icon">
                    <use xlink:href="#custom-security-safe"></use>
                </svg>
            </span>
            <span class="pc-mtext">Approval CSR</span>
        </a>
    </li>

    <li class="pc-item pc-caption">
        <label>Manage MP INFO</label>
        <i class="ti ti-dashboard"></i>
    </li>

    <li class="pc-item {{ request()->is('v1/MpInfo*') ? 'active' : '' }}">
        <a href="{{ route('v1.mpinfo.index') }}" class="pc-link">
            <span class="pc-micon">
                <svg class="pc-icon">
                    <use xlink:href="#custom-security-safe"></use>
                </svg>
            </span>
            <span class="pc-mtext">Manage MP INFO</span>
        </a>

    <li class="pc-item pc-caption">
        <label>Manage Quality Circle Project</label>
        <i class="ti ti-dashboard"></i>
    </li>

    <li class="pc-item {{ request()->is('v1/QualityCircleProject*') ? 'active' : '' }}">
        <a href="{{ route('v1.qcp.index') }}" class="pc-link">
            <span class="pc-micon">
                <svg class="pc-icon">
                    <use xlink:href="#custom-document-filter"></use>
                </svg>
            </span>
            <span class="pc-mtext">List QCP</span>
        </a>
    </li>
    <li class="pc-item {{ request()->is('v1/approval/fasilitator/qualityCircleProject*') ? 'active' : '' }}">
        <a href="{{ route('v1.approval.fasilitator.qcp.index') }}" class="pc-link">
            <span class="pc-micon">
                <svg class="pc-icon">
                    <use xlink:href="#custom-document-filter"></use>
                </svg>
            </span>
            <span class="pc-mtext">Approval Langkah QCP</span>
        </a>
    </li>

    <li class="pc-item pc-caption">
        <label>Manage Quality Circle Control</label>
        <i class="ti ti-dashboard"></i>
    </li>

    <li class="pc-item {{ request()->is('v1/QualityCircleControl*') ? 'active' : '' }}">
        <a href="{{ route('v1.qcc.index') }}" class="pc-link">
            <span class="pc-micon">
                <svg class="pc-icon">
                    <use xlink:href="#custom-document-filter"></use>
                </svg>
            </span>
            <span class="pc-mtext">List QCC</span>
        </a>
    </li>
    <li class="pc-item {{ request()->is('v1/approval/fasilitator/QualityCircleControl*') ? 'active' : '' }}">
        <a href="#" class="pc-link">
            <span class="pc-micon">
                <svg class="pc-icon">
                    <use xlink:href="#custom-document-filter"></use>
                </svg>
            </span>
            <span class="pc-mtext">Approval Langkah QCC</span>
        </a>
    </li>

    <li class="pc-item pc-caption">
        <label>Manage One Sheet Report</label>
        <i class="ti ti-dashboard"></i>
    </li>

    <li class="pc-item {{ request()->is('v1/OnesheetReport*') ? 'active' : '' }}">
        <a href="{{ route('v1.osr.index') }}" class="pc-link">
            <span class="pc-micon">
                <svg class="pc-icon">
                    <use xlink:href="#custom-document-filter"></use>
                </svg>
            </span>
            <span class="pc-mtext">List OSR</span>
        </a>
    </li>
    <li class="pc-item {{ request()->is('v1/approval/fasilitator/oneSheetReport*') ? 'active' : '' }}">
        <a href="{{ route('v1.approval.fasilitator.osr.index') }}" class="pc-link">
            <span class="pc-micon">
                <svg class="pc-icon">
                    <use xlink:href="#custom-security-safe"></use>
                </svg>
            </span>
            <span class="pc-mtext">Approval OSR</span>
        </a>
    </li> --}}

    <li class="pc-item pc-caption">
        <label>Other</label>
        <i class="ti ti-brand-chrome"></i>
    </li>
    <li class="pc-item">
        <a href="#" class="pc-link">
            <span class="pc-micon">
                <svg class="pc-icon">
                    <use xlink:href="#custom-keyboard"></use>
                </svg>
            </span>
            <span class="pc-mtext">Manual Book</span>
        </a>
    </li>
    <li class="pc-item">
        <a href="#" class="pc-link">
            <span class="pc-micon">
                <svg class="pc-icon">
                    <use xlink:href="#custom-keyboard"></use>
                </svg>
            </span>
            <span class="pc-mtext">Audit Trail</span>
        </a>
    </li>
    <li class="pc-item">
        <a href="#" class="pc-link">
            <span class="pc-micon">
                <svg class="pc-icon">
                    <use xlink:href="#custom-call-calling"></use>
                </svg>
            </span>
            <span class="pc-mtext">Contact Us</span>
        </a>
    </li>

</ul>
