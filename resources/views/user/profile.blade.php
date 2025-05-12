@include('layout.header_user')

@include('layout.navbar_user')

    <!-- Content -->
    <div class="content">
      <div class="profile-card text-center">
        <h2 class="fw-bold" style="color: #2e4156">Profile</h2>
        <img src="
        @if ($user->jeniskelamin === 'Laki - Laki')
        ../img/Photo-profile-lelaki.png
        @elseif($user->jeniskelamin === 'Perempuan')
          ../img/Photo-profile-wanita.png
        @endif
        " alt="Profile Picture" class="profile-img" />
        <div class="mb-3">
          <span class="badge p-2 fs-5 text-primary bg-primary-subtle border border-primary-subtle rounded-3">
            {{ Auth::user()->id }}
          </span>
        </div>
        <form>
          <div class="mb-3 row">
            <label class="col-sm-4 col-form-label fw-bold">Nama Lengkap :</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly />
            </div>
          </div>
          <div class="mb-3 row">
            <label class="col-sm-4 col-form-label fw-bold">Tempat, Tanggal Lahir :</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" value="{{ Auth::user()->ttl }}" readonly />
            </div>
          </div>
          <div class="mb-3 row">
            <label class="col-sm-4 col-form-label fw-bold">Nomor Telepon :</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" value="{{ Auth::user()->nohp }}" readonly />
            </div>
          </div>
          <div class="mb-3 row">
            <label class="col-sm-4 col-form-label fw-bold">Alamat :</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" value="{{ Auth::user()->alamat }}" readonly />
            </div>
          </div>
        </form>
        <p class="text-danger mt-3"><small>*Hubungi admin jika ada kesalahan dengan data diri</small></p>
      </div>
    </div>

    <script src="../js/script_profile_user.js"></script>
  </body>
</html>
