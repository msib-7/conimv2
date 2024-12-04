 @if (auth()->user()->isUserFa())
     <li class="pc-item pc-caption">
         <label>Menu Finance Accounting</label>
         <i class="ti ti-dashboard"></i>
     </li>
     <li class="pc-item {{ request()->is('v1/financeAccounting/suggestionSystem*') ? 'active' : '' }}">
         <a href="{{ route('v1.financeAccounting.suggestionSystem.index') }}" class="pc-link">
             <span class="pc-micon">
                 <svg class="pc-icon">
                     <use xlink:href="#custom-document-filter"></use>
                 </svg>
             </span>
             <span class="pc-mtext">Approval SS</span>
         </a>
     </li>

     <li class="pc-item {{ request()->is('v1/financeAccounting/costSavingReport*') ? 'active' : '' }}">
         <a href="{{ route('v1.financeAccounting.costSavingReport.index') }}" class="pc-link">
             <span class="pc-micon">
                 <svg class="pc-icon">
                     <use xlink:href="#custom-document-filter"></use>
                 </svg>
             </span>
             <span class="pc-mtext">Approval CSR</span>
         </a>
     </li>

     <li class="pc-item {{ request()->is('v1/financeAccounting/qualityCircleProject*') ? 'active' : '' }}">
         <a href="{{ route('v1.financeAccounting.qcp.index') }}" class="pc-link">
             <span class="pc-micon">
                 <svg class="pc-icon">
                     <use xlink:href="#custom-document-filter"></use>
                 </svg>
             </span>
             <span class="pc-mtext">Approval QCP</span>
         </a>
     </li>
     <li class="pc-item {{ request()->is('v1/financeAccounting/oneSheetReport*') ? 'active' : '' }}">
         <a href="{{ route('v1.financeAccounting.osr.index') }}" class="pc-link">
             <span class="pc-micon">
                 <svg class="pc-icon">
                     <use xlink:href="#custom-document-filter"></use>
                 </svg>
             </span>
             <span class="pc-mtext">Approval OSR</span>
         </a>
     </li>
 @endif
