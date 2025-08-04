<div class="nk-sidebar nk-sidebar-fixed is-dark" data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-menu-trigger">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu">
                <em class="icon ni ni-arrow-left"></em>
            </a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu">
                <em class="icon ni ni-menu"></em>
            </a>
        </div>
        <div class="nk-sidebar-brand">
            <a href="{{ route('home') }}" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img" src="{{ asset('assets/img/logoro.png') }}" alt="logo" style="width: 100%; max-width: 200px; height: auto;">
                <img class="logo-dark logo-img" src="{{ asset('assets/img/logoro.png') }}" alt="logo-dark">
            </a>
        </div>
    </div>

    <div class="nk-sidebar-element nk-sidebar-body">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Main Menu</h6>
                    </li>

                    <li class="nk-menu-item">
                        <a href="{{ route('client.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-user"></em></span>
                            <span class="nk-menu-text">Clients</span>
                        </a>
                    </li>

                    <li class="nk-menu-item">
                        <a href="{{ route('loan.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-wallet"></em></span>
                            <span class="nk-menu-text">Loans</span>
                        </a>
                    </li>

                    <li class="nk-menu-item">
                        <a href="{{ route('repayment.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-cc-alt"></em></span>
                            <span class="nk-menu-text">Repayments</span>
                        </a>
                    </li>

                    <li class="nk-menu-item">
                        <a href="{{ route('expense.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-report-profit"></em></span>
                            <span class="nk-menu-text">Expenses</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>
