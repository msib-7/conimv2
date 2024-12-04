@if (auth()->user()->jobLvl == 'Administrator')
    <li class="pc-item pc-caption"> 
        <label>Admin Tools</label>
        <i class="ti ti-dashboard"></i>
    </li>

    <li class="pc-item pc-hasmenu {{ request()->is('admin/category*') ? 'active pc-trigger' : '' }}">
        <a href="#!" class="pc-link">
            <span class="pc-micon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="pc-icon">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path
                        d="M3 8v4.172a2 2 0 0 0 .586 1.414l5.71 5.71a2.41 2.41 0 0 0 3.408 0l3.592 -3.592a2.41 2.41 0 0 0 0 -3.408l-5.71 -5.71a2 2 0 0 0 -1.414 -.586h-4.172a2 2 0 0 0 -2 2z" />
                    <path d="M18 19l1.592 -1.592a4.82 4.82 0 0 0 0 -6.816l-4.592 -4.592" />
                    <path d="M7 10h-.01" />
                </svg>
            </span>
            <span class="pc-mtext">Category</span>
            <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
        </a>
        <ul class="pc-submenu">
            <li class="pc-item {{ request()->is('admin/category/corp*') ? 'active' : '' }}">
                <a class="pc-link" href="{{ route('admin.category.corp.index') }}">Corporate</a>
            </li>
            <li class="pc-item {{ request()->is('admin/category/impactTo*') ? 'active' : '' }}">
                <a class="pc-link" href="{{ route('admin.category.impactTo.index') }}">Impact To</a>
            </li>
            <li class="pc-item {{ request()->is('admin/category/improvment*') ? 'active' : '' }}">
                <a class="pc-link" href="{{ route('admin.category.improvment.index') }}">Improvment</a>
            </li>
            <li class="pc-item {{ request()->is('admin/category/costSaving*') ? 'active' : '' }}">
                <a class="pc-link" href="{{ route('admin.category.costSaving.index') }}">Cost Saving</a>
            </li>
            <li class="pc-item {{ request()->is('admin/category/jenisSaving*') ? 'active' : '' }}">
                <a class="pc-link" href="{{ route('admin.category.jenisSaving.index') }}">Jenis Saving</a>
            </li>
        </ul>
    </li>

    <li class="pc-item">
        <a href="{{ route('admin.masterMachine.index') }}" class="pc-link">
            <span class="pc-micon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="pc-icon">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path
                        d="M3 8v4.172a2 2 0 0 0 .586 1.414l5.71 5.71a2.41 2.41 0 0 0 3.408 0l3.592 -3.592a2.41 2.41 0 0 0 0 -3.408l-5.71 -5.71a2 2 0 0 0 -1.414 -.586h-4.172a2 2 0 0 0 -2 2z" />
                    <path d="M18 19l1.592 -1.592a4.82 4.82 0 0 0 0 -6.816l-4.592 -4.592" />
                    <path d="M7 10h-.01" />
                </svg>
            </span>
            <span class="pc-mtext">Master Machine</span>
        </a>
    </li>

    <li class="pc-item">
        <a href="{{ route('admin.permission.index') }}" class="pc-link">
            <span class="pc-micon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="pc-icon">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M4 4h6v6h-6z" />
                    <path d="M14 4h6v6h-6z" />
                    <path d="M4 14h6v6h-6z" />
                    <path d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                </svg>
            </span>
            <span class="pc-mtext">Permission Access</span>
        </a>
    </li>

    <li class="pc-item">
        <a href="{{ route('admin.menu.index') }}" class="pc-link">
            <span class="pc-micon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="pc-icon">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M4 4h6v6h-6z" />
                    <path d="M14 4h6v6h-6z" />
                    <path d="M4 14h6v6h-6z" />
                    <path d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                </svg>
            </span>
            <span class="pc-mtext">Menu Access</span>
        </a>
    </li>

    <li class="pc-item pc-hasmenu {{ request()->is('admin/users*') ? 'active pc-trigger' : '' }}">
        <a href="#!" class="pc-link">
            <span class="pc-micon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="pc-icon">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path
                        d="M3 8v4.172a2 2 0 0 0 .586 1.414l5.71 5.71a2.41 2.41 0 0 0 3.408 0l3.592 -3.592a2.41 2.41 0 0 0 0 -3.408l-5.71 -5.71a2 2 0 0 0 -1.414 -.586h-4.172a2 2 0 0 0 -2 2z" />
                    <path d="M18 19l1.592 -1.592a4.82 4.82 0 0 0 0 -6.816l-4.592 -4.592" />
                    <path d="M7 10h-.01" />
                </svg>
            </span>
            <span class="pc-mtext">User Manage</span>
            <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
        </a>
        <ul class="pc-submenu">
            <li class="pc-item {{ request()->is('admin/users/fa*') ? 'active' : '' }}">
                <a class="pc-link" href="{{ route('admin.users.FA.index') }}">Finance Acounting</a>
            </li>
            <li class="pc-item {{ request()->is('admin/users/mstdOfficer*') ? 'active' : '' }}">
                <a class="pc-link" href="{{ route('admin.users.mstdOfficer.index') }}">MSTD Officer</a>
            </li>
            <li class="pc-item {{ request()->is('admin/users/mstdSpv*') ? 'active' : '' }}">
                <a class="pc-link" href="{{ route('admin.users.mstdSpv.index') }}">MSTD SPV</a>
            </li>
        </ul>
    </li>

    <li class="pc-item">
        <a href="{{ route('admin.notify.index') }}" class="pc-link">
            <span class="pc-micon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="pc-icon">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                    <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
                </svg>
            </span>
            <span class="pc-mtext">Notifikasi Users</span>
        </a>
    </li>


    <li class="pc-item">
        <a href="#" class="pc-link">
            <span class="pc-micon">
                <svg class="pc-icon">
                    <use xlink:href="#custom-setting-2"></use>
                </svg>
            </span>
            <span class="pc-mtext">Page Settings</span>
        </a>
    </li>
@endif
