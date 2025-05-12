@include('layout.header_user')
    <!-- Button Logout -->
   <form action="{{ route('logout') }}" method="post">
    @csrf
      <button class="logout-button" type="submit">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
          <path
            fill-rule="evenodd"
            d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"
          />
          <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
        </svg>
      </button>
    </form>

    <!-- Header -->
    <div class="container">
      <h1 class="text-primary">Selamat Datang Di</h1>
      <h2 class="text-primary">Koperasi Lila Sari Sedana</h2>
      <hr />
      <h4>Silahkan Pilih Menu Dibawah</h4>

      <!-- Pembungkus Company Profile dan Peminjaman -->
      <div class="row justify-content-center mt-4">
        <!-- Company Profile -->
        <div class="col-md-4 company-profile">
          <div class="card p-3">
            <img src="../img/gambar memberikan informasi.png" class="card-img-top" alt="Company Profile" />
            <div class="card-body">
              <h5 class="card-title">Company Profile</h5>
              <a href="#" class="btn btn-primary">Klik Disini</a>
            </div>
          </div>
        </div>

        <!-- Peminjaman -->
        <div class="col-md-4 company-profile">
          <div class="card p-3">
            <img src="../img/Peminjaman.png" class="card-img-top" alt="Detail Pribadi" />
            <div class="card-body">
              <h5 class="card-title">Detail Pribadi</h5>
              <a href="{{ route('user.profile') }}" class="btn btn-primary">Klik Disini</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
