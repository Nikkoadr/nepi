<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 shadow">

    <!-- Sidebar Toggle -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none">
        <i class="fa fa-bars"></i>
    </button>

    <ul class="navbar-nav ml-auto">

        <!-- 🔔 NOTIFIKASI -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                <i class="fas fa-bell fa-fw"></i>

                @if($totalNotif > 0)
                    <span class="badge badge-danger badge-counter">
                        {{ $totalNotif > 9 ? '9+' : $totalNotif }}
                    </span>
                @endif
            </a>

            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in">

                <h6 class="dropdown-header">
                    Notifikasi Izin
                </h6>

                @forelse($notifikasi as $item)

                    @php
                        $today = \Carbon\Carbon::today();
                        $expired = $item->masa_berlaku < $today;
                    @endphp

                    <a class="dropdown-item d-flex align-items-center"
                       href="{{ $item->lembaga->edit_route }}">

                        <div class="mr-3">
                            <div class="icon-circle {{ $expired ? 'bg-danger' : 'bg-warning' }}">
                                <i class="fas {{ $expired ? 'fa-times' : 'fa-clock' }} text-white"></i>
                            </div>
                        </div>

                        <div>
                            <div class="small text-gray-500">
                                {{ $item->masa_berlaku }}
                            </div>

                            {!! $expired ? '❌ Izin kadaluarsa' : '⏰ Izin hampir habis' !!}
                            <br>

                            <strong>{{ $item->lembaga->nama_lembaga ?? '-' }}</strong>
                        </div>
                    </a>

                @empty

                    <div class="dropdown-item text-center small text-gray-500">
                        Tidak ada notifikasi
                    </div>

                @endforelse

                <div class="dropdown-divider"></div>

                <a class="dropdown-item text-center small text-gray-500"
                   href="{{ route('notifikasi.index') }}">
                    Lihat semua notifikasi
                </a>

            </div>
        </li>

        <!-- Divider -->
        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- 👤 USER -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    {{ Auth::user()->name ?? 'User' }}
                </span>
                <img class="img-profile rounded-circle"
                     src="{{ asset('assets/img/undraw_profile.svg') }}">
            </a>

            <div class="dropdown-menu dropdown-menu-right shadow">
                <a class="dropdown-item" href="#"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            </div>
        </li>

    </ul>

</nav>