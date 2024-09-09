<nav class="navbar navbar-vertical navbar-expand-lg" style="display:none;">
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <!-- scrollbar removed-->
        <div class="navbar-vertical-content">
            <ul class="navbar-nav flex-column" id="navbarVerticalNav">

                <li class="nav-item">
                    <div class="nav-item-wrapper">
                        <a class="nav-link label-1 {{ Route::is('home') ? 'active' : '' }}" href="{{ route('home') }}" role="button" data-bs-toggle="Dashboard" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon">
                                    <span data-feather="pie-chart"></span>
                                </span>
                                <span class="nav-link-text-wrapper">
                                    <span class="nav-link-text">Home</span>
                                </span>
                            </div>
                        </a>
                    </div>
                </li>
                <p class="navbar-vertical-label">Modules</p>
                <hr class="navbar-vertical-line">

                @foreach($menus as $menu)
                    @if($menu->route == 'home') @continue; @endif
                    @if(count($menu->submenus))
                        @php
                            $subMenuSelected = false;
                            $subMenuSelected = Arr::first($menu->submenus, function ($item, $key) {
                                                    return Route::is($item->route);
                                                });
                        @endphp
                        <li class="nav-item">
                            <div class="nav-item-wrapper">
                                <a class="nav-link dropdown-indicator label-1 {{ ($subMenuSelected) ? '' : 'collapsed' }}" href="#nv-{{ $menu->id }}" role="button"
                                   data-bs-toggle="collapse" aria-expanded="{{ ($subMenuSelected) ? 'true' : 'false' }}" aria-controls="nv-{{ $menu->id }}">
                                    <div class="d-flex align-items-center">
                                        <div class="dropdown-indicator-icon-wrapper">
                                            <span class="fas fa-caret-right dropdown-indicator-icon"></span>
                                        </div>
                                        <span class="nav-link-icon"><span data-feather="{{ $menu->icon }}"></span></span>
                                        <span class="nav-link-text">{{ $menu->title }}</span>
                                    </div>
                                </a>
                                <div class="parent-wrapper label-1">
                                    <ul class="nav parent collapse {{ ($subMenuSelected) ? 'show' : '' }}" data-bs-parent="#navbarVerticalCollapse" id="nv-{{ $menu->id }}">
                                        <li class="collapsed-nav-item-title d-none">{{ $menu->title }}</li>
                                        @foreach($menu->submenus as $item)
                                        <li class="nav-item">
                                            <a class="nav-link {{ Route::is($item->route) ? 'active' : '' }}" href="{{ route($item->route) }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text">{{ $item->title }}</span>
                                                </div>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            @if(!is_null($menu->route))
                            <div class="nav-item-wrapper">
                                <a class="nav-link label-1 {{ Route::is($menu->route) ? 'active' : '' }}" href="{{ route($menu->route) }}" role="button" data-bs-toggle="" aria-expanded="false">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon">
                                            <span data-feather="{{ $menu->icon }}"></span>
                                        </span>
                                        <span class="nav-link-text-wrapper">
                                            <span class="nav-link-text">{{ $menu->title }}</span>
                                        </span>
                                    </div>
                                </a>
                            </div>
                            @endif
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>

    <div class="navbar-vertical-footer">
        <button class="btn navbar-vertical-toggle border-0 fw-semibold w-100 white-space-nowrap d-flex align-items-center">
            <span class="uil uil-left-arrow-to-left fs-8"></span>
            <span class="uil uil-arrow-from-right fs-8"></span>
            <span class="navbar-vertical-footer-text ms-2">Collapsed View</span>
        </button>
    </div>
</nav>
