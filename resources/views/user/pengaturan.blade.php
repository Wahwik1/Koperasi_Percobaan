@include('layout.header_user')

    @include('layout.navbar_user')

    @if (session('success'))
        <script>
            Swal.fire({
                      title: "Password Berhasil Diubah",
                      text: "Silahkan Dicek Kembali",
                      icon: "success",
                  });
        </script>
    @endif
    
    <!-- Container -->
    <div class="container mt-4">
      <!-- Header -->
      <h2 class="header-title">UBAH PASSWORD</h2>
      <!-- Card Pendaftaran -->
      <div class="card mt-4">
        <p class="alert-text">*Password Minimal 6 Karakter dan Memiliki Angka</p>

        <form id="formku" action="{{ route('user.Password') }}" method="post">
          @csrf
          <input type="hidden" name="id" id="id" value="{{ Auth::user()->id }}">
          <div class="row g-3">
            <div class="col-md-12 position-relative">
              <label class="form-label">Password : </label>
              <input type="password" id="password" class="form-control pr-5" name="password"/>
            </div>
            <div class="col-md-12 position-relative">
              <label class="form-label">Verifikasi Password : </label>
              <input type="password" id="verifikasi_password" class="form-control pr-5"/>
            </div>
            <div class="col-md-12">
              <button type="submit" class="btn btn-save form-control savependaftaran" id="saveBtn"><i class="fa-regular fa-circle-check"></i> Save</button>
            </div>
          </div>
        </form>

      </div>
    </div>
    <script src="../js/script_pengaturan_admin.js"></script>
  </body>
  </html>
