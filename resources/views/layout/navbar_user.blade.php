<button class="hamburger"><i class="fa-solid fa-bars"></i></button>

<div class="sidebar">
    <img src="
    @if ($user->jeniskelamin === 'Laki - Laki')
      ../img/Photo-profile-lelaki.png
    @elseif($user->jeniskelamin === 'Perempuan')
      ../img/Photo-profile-wanita.png
    @endif
    " alt="Profile Picture" />
    <h5>Profile</h5>
    <nav class="nav flex-column w-100">
      <a class="nav-link {{ Request::is('profile') ? 'active' : '' }}" href="{{ url('/profile') }}"><i class="fa-solid fa-user"></i>User</a>
      <a class="nav-link {{ Request::is('detail-keuangan') ? 'active' : '' }}" href="{{ url('/detail-keuangan') }}"><i class="fa-solid fa-wallet"></i>Detail Keuangan</a>
      <a class="nav-link {{ Request::is('peminjaman') ? 'active' : '' }}" href="{{ url('/peminjaman') }}"><i class="fa-solid fa-handshake"></i>Peminjaman</a>
      <a class="nav-link {{ Request::is('overbook') ? 'active' : '' }}" href="{{ url('/overbook') }}"><i class="fa-solid fa-file-alt"></i>Overbook</a>
      <a class="nav-link {{ Request::is('penarikan-tabungan') ? 'active' : '' }}" href="{{ url('/penarikan-tabungan') }}"><i class="fa-solid fa-money-bill"></i>Penarikan Tabungan</a>
      <a class="nav-link {{ Request::is('pengaturan') ? 'active' : '' }}" href="{{ url('/pengaturan') }}"><i class="fa-solid fa-cog"></i>Pengaturan</a>
      <form action="{{ route('logout') }}" method="post">
        @csrf
        <button class="btn logout" type="submit"><i class="fa-solid fa-sign-out-alt" style="text-decoration: none"></i> Log out</button>
      </form>
    </nav>
  </div>