<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse bg-white">
    <div class="position-sticky pt-3 sidebar-sticky">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
            <span data-feather="home" class="align-text-bottom"></span>
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/posts*') ? 'active' : '' }}" href="/dashboard/posts">
            {{-- /posts* is to also make it 'active' even when there are any variable after /posts --}}
            <span data-feather="file-text" class="align-text-bottom"></span>
            My Posts
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/myaccount*') ? 'active' : '' }}" href="/dashboard/myaccount">
            {{-- /posts* is to also make it 'active' even when there are any variable after /posts --}}
            <span data-feather="user" class="align-text-bottom"></span>
            My Account
          </a>
        </li>
        <li class="nav-item">
          <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="dropdown-item nav-link px-3"><span data-feather="log-out"></span> Logout</button>
        </form>
        </li>
      </ul>

      @can('admin')
      <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>Administrator</span>
      </h6>
      
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/categories*') ? 'active' : '' }}" aria-current="page" href="/dashboard/categories">
            <span data-feather="grid" class="align-text-bottom"></span>
            Categories
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/accounts*') ? 'active' : '' }}" aria-current="page" href="/dashboard/accounts">
            <span data-feather="users" class="align-text-bottom"></span>
            Accounts
          </a>
        </li>
      </ul>
      @endcan
    </div>
</nav>