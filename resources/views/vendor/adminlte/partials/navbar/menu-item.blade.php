@inject('navbarItemHelper', 'JeroenNoten\LaravelAdminLte\Helpers\NavbarItemHelper')

@if(Auth::guard('web')->check())
    <!-- Menú para usuarios -->
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">
            {{ Auth::guard('web')->user()->name }}
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form-web').submit();">
                Logout
            </a>
            <form id="logout-form-web" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </li>
@elseif(Auth::guard('cliente')->check())
    <!-- Menú para clientes -->
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">
            {{ Auth::guard('cliente')->clientes()->nombre }}
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{ route('cliente.logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form-cliente').submit();">
                Logout
            </a>
            <form id="logout-form-cliente" action="{{ route('cliente.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </li>
@endif

@if ($navbarItemHelper->isSearch($item))

    {{-- Search form --}}
    @include('adminlte::partials.navbar.menu-item-search-form')

@elseif ($navbarItemHelper->isNotification($item))

    {{-- Notification link --}}
    <x-adminlte-navbar-notification
        :id="$item['id']"
        :href="$item['href']"
        :icon="$item['icon']"
        :icon-color="$item['icon_color'] ?? null"
        :badge-label="$item['label'] ?? null"
        :badge-color="$item['label_color'] ?? null"
        :update-cfg="$item['update_cfg'] ?? null"
        :enable-dropdown-mode="$item['dropdown_mode'] ?? null"
        :dropdown-footer-label="$item['dropdown_flabel'] ?? null"
    />

@elseif ($navbarItemHelper->isFullscreen($item))

    {{-- Fullscreen toggle widget --}}
    @include('adminlte::partials.navbar.menu-item-fullscreen-widget')

@elseif ($navbarItemHelper->isDarkmode($item))

    {{-- Darkmode toggle widget --}}
    <x-adminlte-navbar-darkmode-widget
        :icon-enabled="$item['icon_enabled'] ?? null"
        :color-enabled="$item['color_enabled'] ?? null"
        :icon-disabled="$item['icon_disabled'] ?? null"
        :color-disabled="$item['color_disabled'] ?? null"
    />

@elseif ($navbarItemHelper->isSubmenu($item))

    {{-- Dropdown menu --}}
    @include('adminlte::partials.navbar.menu-item-dropdown-menu')

@elseif ($navbarItemHelper->isLink($item))

    {{-- Link --}}
    @include('adminlte::partials.navbar.menu-item-link')

@endif
