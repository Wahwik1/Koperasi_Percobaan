<button class="hamburger"><i class="fa-solid fa-bars"></i></button>
    
    <!-- Navbar -->
    <div class="sidebar">
      <img src="../img/Logo-Lila-Sari-Sedana.png" alt="Profile Picture" />
      <h5>Admin</h5>
      <nav class="nav flex-column w-100">
        <a class="nav-link {{ Request::is('admin-dashboard') ? 'active' : '' }}" href="{{ url('/admin-dashboard') }}"><i class="fa-solid fa-user"></i>Pendaftaran Anggota</a>
        <a class="nav-link {{ Request::is('admin-tabel-anggota') ? 'active' : '' }}" href="{{ url('/admin-tabel-anggota') }}"><i class="fa-solid fa-user"></i>Tabel Anggota</a>
        <a class="nav-link {{ Request::is('admin-pinjaman') ? 'active' : '' }}" href="{{ url('/admin-pinjaman') }}"><i class="fa-solid fa-handshake"></i>Pinjaman</a>
        <a class="nav-link {{ Request::is('admin-overbook') ? 'active' : '' }}" href="{{ url('/admin-overbook') }}"><i class="fa-solid fa-file-alt"></i>Overbook</a>
        <a class="nav-link {{ Request::is('admin-penarikan-tabungan') ? 'active' : '' }}" href="{{ url('/admin-penarikan-tabungan') }}"><i class="fa-solid fa-money-bill"></i>Penarikan Tabungan</a>
        <a class="nav-link {{ Request::is('admin-pembayaran-cicilan') ? 'active' : '' }}" href="{{ url('/admin-pembayaran-cicilan') }}"><i class="fa-solid fa-money-check-dollar"></i>Pembayaran Cicilan</a>
        <a class="nav-link {{ Request::is('admin-edit-cicilan') ? 'active' : '' }}" href="{{ url('/admin-edit-cicilan') }}"><i class="fa-solid fa-pen-to-square"></i>Edit Pembayaran</a>
        <a class="nav-link position-relative {{ Request::is('admin-pesan') ? 'active' : '' }}" href="{{ url('/admin-pesan') }}">
          <i class="bi bi-envelope-fill"></i>
          Pesan
          @if ($check)
            <span class="position-absolute top-50 end-0 translate-middle-y me-2">
              <i class="bi bi-exclamation-circle-fill text-warning" style="font-size: 1rem;"></i>
            </span>
          @endif
        </a>
        <a class="nav-link {{ Request::is('admin-pengaturan') ? 'active' : '' }}" href="{{ url('/admin-pengaturan') }}"><i class="fa-solid fa-cog"></i>Pengaturan</a>
        <form action="{{ route('logout') }}" method="post">
          @csrf
          <button class="btn logout" type="submit" ><i class="fa-solid fa-sign-out-alt" style="text-decoration: none"></i> Log out</button>
        </form>
      </nav>
    </div>