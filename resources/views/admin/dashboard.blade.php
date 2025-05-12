@include('layout.admin_header')

    @include('layout.admin_navbar')
    
    <!-- Container -->
    <div class="container mt-4">
      <!-- Header -->
      <h2 class="header-title">PENDAFTARAN ANGGOTA</h2>
      <!-- Card Pendaftaran -->
      <div class="card mt-4">
        @if (session('failed'))
          <script>
            Swal.fire({
                title: "Pendaftaran Gagal",
                text: "Silahkan Coba Lagi",
                icon: "error",
            });
          </script>
        @endif

        @if (session('success'))
          <script>
            Swal.fire({
                title: "Pendaftaran Berhasil",
                text: "Silahkan Lakukan Pengecekan",
                icon: "success",
            });
          </script>
        @endif
        <p class="alert-text">*Pastikan memasukkan data dengan benar</p>
        <form id="formku" action="{{ route('daftar.anggota') }}" method="post">
          @csrf
          <div class="row g-3">
            <div class="col-2">
              <label for="name" class="form-label">Nomor:</label>
              <input type="text" class="form-control nomorpeserta text-center" name="id" id="id" value="{{ $nextId }}" readonly/>
            </div>
            <p class="alert-text">*Nomor Terisi Otomatis</p>
            <div class="col-md-12">
              <label class="form-label">Nama Lengkap :</label>
              <input type="text" class="form-control" name="name" id="name"/>
              <div id="name-error" class="text-danger mt-1" style="font-size: 0.9rem;"></div>
            </div>
            <div class="col-md-12">
              <label class="form-label">Email :</label>
              <input type="text" class="form-control" name="email" id="email"/>
              <div id="email-error" class="text-danger mt-1" style="font-size: 0.9rem;"></div>
            </div>
            <div class="col-md-12">
              <label class="form-label">Jenis Kelamin :</label>
              <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="jeniskelamin">
                <option value="Laki - Laki">Laki - Laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
            <div class="col-md-12">
              <label class="form-label">NIK : </label>
              <input type="text" class="form-control nik" name="nik" id="nik"/>
              <div id="nik-error" class="text-danger mt-1" style="font-size: 0.9rem;"></div>
            </div>
            <div class="col-md-12">
              <label class="form-label">Tempat, Tanggal Lahir : </label>
              <input type="text" class="form-control" name="ttl"/>
            </div>
            <div class="col-md-12">
              <label class="form-label">No Hp : </label>
              <input type="text" class="form-control nohp" name="nohp"/>
            </div>
            <div class="col-md-12 position-relative">
              <label class="form-label">Alamat : </label>
              <input type="text" class="form-control" name="alamat"/>
            </div>
            <div class="col-md-12 position-relative">
              <p class="alert-text">*Password Minimal 6 Karakter dan Memiliki Angka</p>
              <label class="form-label">Password : </label>
              <input type="password" id="password" class="form-control pr-5" name="password"/>
            </div>
            <div class="col-md-12 position-relative">
              <label class="form-label">Verifikasi Password : </label>
              <input type="password" id="verifikasi_password" class="form-control pr-5"/>
            </div>
            <div class="col-md-12">
              <label for="form-label">Foto KTP</label>
              <p class="alert-text">*Hanya file PNG</p>
              <input type="file" class="form-control" id="fileInput" accept="image/png" name="foto"/>
            </div>
            <div class="col-md-12">
              <button type="submit" class="btn btn-save form-control savependaftaran" id="saveBtn"><i class="fa-regular fa-circle-check"></i> Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <script src="../js/script_pendaftaran_admin.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');
        const nikInput = document.getElementById('nik');
      
        const nameError = document.getElementById('name-error');
        const emailError = document.getElementById('email-error');
        const nikError = document.getElementById('nik-error');
      
        function cekData() {
          const name = nameInput.value.trim();
          const email = emailInput.value.trim();
          const nik = nikInput.value.trim();
      
          fetch('{{ route("cek.duplikat") }}', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ name, email, nik })
          })
          .then(res => res.json())
          .then(data => {
            // Nama
            if (data.name) {
              nameError.textContent = 'Nama sudah terdaftar.';
              nameInput.classList.add('is-invalid');
            } else {
              nameError.textContent = '';
              nameInput.classList.remove('is-invalid');
            }
      
            // Email
            if (data.email) {
              emailError.textContent = 'Email sudah terdaftar.';
              emailInput.classList.add('is-invalid');
            } else {
              emailError.textContent = '';
              emailInput.classList.remove('is-invalid');
            }
      
            // NIK
            if (data.nik) {
              nikError.textContent = 'NIK sudah terdaftar.';
              nikInput.classList.add('is-invalid');
            } else {
              nikError.textContent = '';
              nikInput.classList.remove('is-invalid');
            }
          });
        }
      
        nameInput.addEventListener('blur', cekData);
        emailInput.addEventListener('blur', cekData);
        nikInput.addEventListener('blur', cekData);
      });
      </script>
  </body>
  </html>
