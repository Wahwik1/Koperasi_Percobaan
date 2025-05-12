@include('layout.header_user')

@include('layout.navbar_user')

@if (session('success-pinjaman'))
<script>
  Swal.fire({
      title: "Pesan Terkirim",
      text: "Silahkan Ditunggu",
      icon: "success",
  });
</script>
@endif

@if (session('success-delete'))
<script>
  Swal.fire({
      title: "Pesan Berhasil Di Hapus",
      text: "Silahkan Dicek !",
      icon: "success",
  });
</script>
@endif

    <!-- Header Peminjaman -->
    <div class="container mt-4">
      <h2 class="header-title">OVERBOOK</h2>
      <!-- Identitas User -->
      <div class="user-detail">
        <div class="row mb-3">
          <div class="col-12 text-center">
            <span class="badge p-2 fs-5 text-primary bg-primary-subtle border border-primary-subtle rounded-3">
              {{ Auth::user()->id }}
            </span>
            <input type="hidden" class="no" value="{{ Auth::user()->id }}">
          </div>
        </div>
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Nama Lengkap :</label>
            <input type="text" class="form-control namalengkap" value="{{ Auth::user()->name }}" readonly />
          </div>
          <div class="col-md-6">
            <label class="form-label">Nomor Telepon :</label>
            <input type="text" class="form-control telepon" value="{{ Auth::user()->nohp }}" readonly />
          </div>
          <div class="col-md-6">
            <label class="form-label">Tempat, Tanggal Lahir :</label>
            <input type="text" class="form-control tanggallahir" value="{{ Auth::user()->ttl }}" readonly />
          </div>
          <div class="col-md-6">
            <label class="form-label">Alamat :</label>
            <input type="text" class="form-control alamat" value="{{ Auth::user()->alamat }}" readonly />
            <input type="hidden" class="form-control noktp" value="{{ Auth::user()->nik }}" readonly />
          </div>
        </div>
      </div>

      <!-- Card Overbook -->
      <form id="form-overbook1" class="formku" action="{{ route('user.Pesan1') }}" method="Post">
        @csrf
        <input type="hidden" id="pesan_id" name="pesan_id" value="{{ Auth::user()->id }}">
        <input type="hidden" id="jenis1" name="jenis1" value="Overbook Pertama">
        <div class="card mt-4">
          <div class="alert alert-danger @if(!$peminjaman1) d-flex @else d-none @endif" role="alert">
            <i class="bi bi-x-circle pe-1"></i>
            Belum Melakukan Pinjaman
          </div>
          <div class="alert alert-warning @if($pesan1 && $pesan1->jenis1 === 'Overbook Pertama') d-flex @else d-none @endif" role="alert">
            <i class="bi bi-clock pe-1"></i>Pesan Sudah Terkirim
          </div>
          <h5 class="fw-bold">Overbook Peminjaman Pertama</h5>
          <p class="alert-text">*Masukkan nilai ke dalam tabel dengan benar</p>
          <div class="row g-3">
            <div class="col-md-4">
              <label class="form-label">Total Peminjaman</label>
              <input type="text" name="ttotalpeminjaman1" id="ttotalpeminjaman1" @if($pesan1 && $pesan1->jenis1 === 'Overbook Pertama') disabled @endif @if(!$peminjaman1) disabled @endif class="form-control total-peminjaman" value="{{ 'Rp. ' . number_format($pesan1pem->ttotalpeminjaman1 ?? 0, 0, ',', '.') }}" oninput="hitungPembayaran(this)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Pembayaran</label>
              <input type="text" name="tpembayaran1" id="tpembayaran1" @if($pesan1 && $pesan1->jenis1 === 'Overbook Pertama') disabled @endif @if(!$peminjaman1) disabled @endif class="form-control pembayaran" value="{{ $pesan1pem->tpembayaran1 ?? '0' }}" oninput="hitungPembayaran(this)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Bunga</label>
              <input type="text" name="tbunga1" id="tbunga1" class="form-control bunga" value="{{ $pesan1pem->tbunga1 ?? '0.5' }}" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Total Pokok</label>
              <input type="text" name="ttotalpokok1" id="ttotalpokok1" class="form-control total-pokok" value="{{ 'Rp. ' . number_format($pesan1pem->ttotalpokok1 ?? 0, 0, ',', '.') }}" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Total Bunga</label>
              <input type="text" name="ttotalbunga1" id="ttotalbunga1" class="form-control total-bunga" value="{{ 'Rp. ' . number_format($pesan1pem->ttotalbunga1 ?? 0, 0, ',', '.') }}" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Total Pembayaran</label>
              <input type="text" name="ttotalpembayaran1" id="ttotalpembayaran1" class="form-control total-pembayaran" value="{{ 'Rp. ' . number_format($pesan1pem->ttotalpembayaran1 ?? 0, 0, ',', '.') }}" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Sisa Pokok</label>
              <input type="text" class="form-control total-pokoksebelumnya totalpokoksebelumnyaPDF" value="{{ 'Rp. ' . number_format($peminjamanTerbaru->pokok1 ?? 0, 0, ',', '.') }}" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Total Yang Didapatkan</label>
              <input type="text" class="form-control total-didapatkan" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
            </div>
            <div class="col-md-12">
              <label class="form-label">Deskripsi Keperluan</label>
              <input type="text" name="deskripsi1" @if($pesan1 && $pesan1->jenis1 === 'Overbook Pertama') disabled @endif @if(!$peminjaman1) disabled @endif class="form-control deskripsi-keperluan deskripsikeperluanPDF" id="deskripsi1" value="{{ $pesan1pem->deskripsi1 ?? ' '}}"/>
            </div>
            <div class="col-md-12">
              <button type="submit" class="btn btn-save form-control pesan1" id="pesan1"
                  @if(!$peminjaman1) disabled @endif
                  @if($pesan1 && $pesan1->jenis1 === 'Overbook Pertama') disabled @endif >
                  <i class="bi bi-check-circle"></i> Save
              </button>
            </div>
            <div class="col-md-12">
              <button type="button" class="btn btn-save form-control overbook1" id="overbook1"
              @if(!$peminjaman1 || !$pesan1 || !$pesan1->jenis1 === 'Overbook Pertama') disabled @endif
              onclick="editPDF1()">
              <i class="fa-solid fa-file-pdf pe-1"></i>Download PDF
            </button>
            </div>
          </div>
        </div>
      </form>

      <!-- Card Overbook2 -->
      <form id="form-overbook2" class="formku" action="{{ route('user.Pesan1') }}" method="Post">
        @csrf
        <input type="hidden" id="pesan_id" name="pesan_id" value="{{ Auth::user()->id }}">
        <input type="hidden" id="jenis2" name="jenis1" value="Overbook Kedua">
        <div class="card mt-4">
          <div class="alert alert-danger @if(!$peminjaman2) d-flex @else d-none @endif" role="alert">
            <i class="bi bi-x-circle pe-1"></i>
            Belum Melakukan Pinjaman
          </div>
          <div class="alert alert-warning @if($pesan2 && $pesan2->jenis1 === 'Overbook Kedua') d-flex @else d-none @endif" role="alert">
            <i class="bi bi-clock pe-1"></i>Pesan Sudah Terkirim
          </div>
          <h5 class="fw-bold">Overbook Peminjaman Kedua</h5>
          <p class="alert-text">*Masukkan nilai ke dalam tabel dengan benar</p>
          <div class="row g-3">
            <div class="col-md-4">
              <label class="form-label">Total Peminjaman</label>
              <input type="text" name="ttotalpeminjaman1" id="ttotalpeminjaman2" @if($pesan2 && $pesan2->jenis1 === 'Overbook Kedua') disabled @endif @if(!$peminjaman2) disabled @endif class="form-control total-peminjaman totalpeminjamanPDF" value="{{ 'Rp. ' . number_format($pesan2pem->ttotalpeminjaman1 ?? 0, 0, ',', '.') }}" oninput="hitungPembayaran(this)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Pembayaran</label>
              <input type="text" name="tpembayaran1" id="tpembayaran2" @if($pesan2 && $pesan2->jenis1 === 'Overbook Kedua') disabled @endif @if(!$peminjaman2) disabled @endif class="form-control pembayaran pembayaranPDF" value="{{ $pesan2pem->tpembayaran1 ?? '0' }}" oninput="hitungPembayaran(this)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Bunga</label>
              <input type="text" name="tbunga1" id="tbunga2" class="form-control bunga bungaPDF" value="{{ $pesan2pem->tbunga1 ?? '0.5' }}" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Total Pokok</label>
              <input type="text" name="ttotalpokok1" id="ttotalpokok2" class="form-control total-pokok totalpokokPDF" value="{{ 'Rp. ' . number_format($pesan2pem->ttotalpokok1 ?? 0, 0, ',', '.') }}" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Total Bunga</label>
              <input type="text" name="ttotalbunga1" id="ttotalbunga2" class="form-control total-bunga totalbungaPDF" value="{{ 'Rp. ' . number_format($pesan2pem->ttotalbunga1 ?? 0, 0, ',', '.') }}" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Total Pembayaran</label>
              <input type="text" name="ttotalpembayaran1" id="ttotalpembayaran2" class="form-control total-pembayaran totalpembayaranPDF" value="{{ 'Rp. ' . number_format($pesan2pem->ttotalpembayaran1 ?? 0, 0, ',', '.') }}" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Sisa Pokok</label>
              <input type="text" id="sisa_pokok2" class="form-control total-pokoksebelumnya totalpokoksebelumnyaPDF" value="{{ 'Rp. ' . number_format($peminjamanTerbaru2->pokok2 ?? 0, 0, ',', '.') }}" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Total Yang Didapatkan</label>
              <input type="text" id="totalyangdidapatkan2" class="form-control total-didapatkan" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
            </div>
            <div class="col-md-12">
              <label class="form-label">Deskripsi Keperluan</label>
              <input type="text" name="deskripsi1" @if($pesan2 && $pesan2->jenis1 === 'Overbook Kedua') disabled @endif @if(!$peminjaman2) disabled @endif class="form-control deskripsi-keperluan deskripsikeperluanPDF" id="deskripsi2" value="{{ $pesan2pem->deskripsi1 ?? ' ' }}" />
            </div>
            <div class="col-md-12">
              <button type="submit" class="btn btn-save form-control pesan1" id="pesan1"
                  @if(!$peminjaman2) disabled @endif
                  @if($pesan2 && $pesan2->jenis1 === 'Overbook Kedua') disabled @endif>
                  <i class="bi bi-check-circle"></i> Save
              </button>
            </div>
            <div class="col-md-12">
              <button type="button" class="btn btn-save form-control overbook2" id="overbook2"
                @if(!$peminjaman2 || !$pesan2 || !$pesan2->jenis1 === 'Overbook Kedua') disabled @endif
                onclick="editPDF2()">
                <i class="fa-solid fa-file-pdf pe-1"></i>Download PDF
              </button>
            </div>
          </div>
        </div>
      </form>
    </div>

    <script src="../js/script_user_overbook.js"></script>
  </body>
</html>
