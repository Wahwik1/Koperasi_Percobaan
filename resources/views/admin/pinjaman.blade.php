@include('layout.admin_header')
@include('layout.admin_navbar')

          @if (session('gagal-pinjaman'))
                <script>
                   Swal.fire({
                      title: "Data Sedang Memiliki Pinjaman",
                      text: "Mohon Buat Peminjaman Baru atau Overbook",
                      icon: "error",
                  });
                </script>
            @endif
          @if (session('success-pinjaman'))
                <script>
                   Swal.fire({
                      title: "Pinjaman Sukses",
                      text: "Mohon Silahkan Dicek",
                      icon: "success",
                  });
                </script>
            @endif

    <!-- Header Peminjaman -->
    <div class="container mt-4">
      <h2 class="header-title">PEMINJAMAN</h2>
      
      <!-- Live Date -->
      <p class="header-date" id="liveDate"></p>
      
      <!-- Identitas User -->
      <div class="user-detail">
        <div class="row mb-3">
          <div class="col-2">
            <label for="" class="form-label">Nomor:</label>
            <input type="text" class="form-control nomorpeserta text-center" id="nomor"/>
          </div>
          <p class="alert-text">*Masukkan Nomor</p>
        </div>
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Nama Lengkap :</label>
            <input type="text" class="form-control nama" value="" readonly placeholder="Terisi Otomatis"/>
          </div>
          <div class="col-md-6">
            <label class="form-label">Nomor Telepon :</label>
            <input type="text" class="form-control nohp" value="" readonly placeholder="Terisi Otomatis">
          </div>
          <div class="col-md-6">
            <label class="form-label">Tempat, Tanggal Lahir :</label>
            <input type="text" class="form-control ttl" value="" readonly placeholder="Terisi Otomatis"/>
          </div>
          <div class="col-md-6">
            <label class="form-label">Alamat :</label>
            <input type="text" class="form-control alamat" value="" readonly placeholder="Terisi Otomatis"/>
          </div>
        </div>
      </div>

      <form class="formku" id="form-peminjaman" action="{{ route('admin.pinjaman1') }}" method="post">
        @csrf
        <input type="hidden" name="tanggal_pembayaran" id="tanggal_pembayaran">
        <input type="hidden" name="pinjaman_id" id="pinjaman_id">
        <!-- Card Peminjaman -->
      <div class="card mt-4">
        <h5 class="fw-bold">Pinjaman Pertama</h5>
        <p class="alert-text">*Masukkan nilai ke dalam tabel dengan benar</p>
        <p class="alert-text alert-kirim">*Sudah Melakukan Pinjaman</p>
        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label">Total Peminjaman</label>
            <input type="text" id="ttotalpeminjaman1" name="ttotalpeminjaman1" class="form-control total-peminjaman total-peminjaman1 ttotalpeminjaman1" value="Rp. 0" disabled oninput="hitungPembayaran(this)" />
          </div>
          <div class="col-md-4">
            <label class="form-label">Pembayaran</label>
            <input type="text" id="tpembayaran1" name="tpembayaran1" class="form-control pembayaran tpembayaran1" value="0" disabled oninput="hitungPembayaran(this)" />
          </div>
          <div class="col-md-4">
            <label class="form-label">Bunga</label>
            <input type="text" name="tbunga1" class="form-control bunga" value="0.5" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
          </div>
          <div class="col-md-4">
            <label class="form-label">Total Pokok</label>
            <input type="text" name="ttotalpokok1" class="form-control total-pokok total-pokok1" value="Rp. 0" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
          </div>
          <div class="col-md-4">
            <label class="form-label">Total Bunga</label>
            <input type="text" name="ttotalbunga1" class="form-control total-bunga total-bunga1" value="Rp. 0" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
          </div>
          <div class="col-md-4">
            <label class="form-label">Total Pembayaran</label>
            <input type="text" name="ttotalpembayaran1" class="form-control total-pembayaran total-pembayaran1" value="Rp. 0" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
          </div>
          <div class="col-md-12">
            <label class="form-label">Deskripsi Keperluan</label>
            <input type="text" name="deskripsi1" class="form-control deskripsi-keperluan deskripsi1" disabled id="deskripsi1" />
          </div>
          <div class="col-md-12">
            <button type="submit" disabled class="form-control btn btn-save mt-3 peminjaman1 btn-kirim" id="peminjaman1"><i class="fa-regular fa-circle-check"></i> Save</button>
          </div>
        </div>
      </div>
      </form>

      <form class="formku2" id="form-peminjaman2" action="{{ route('admin.pinjaman2') }}" method="post">
        @csrf
        <input type="hidden" name="tanggal_pembayaran" id="tanggal_pembayaran2">
        <input type="hidden" name="pinjaman_id" id="pinjaman_id2">
        <!-- Card Peminjaman -->
      <div class="card mt-4">
        <h5 class="fw-bold">Pinjaman Kedua</h5>
        <p class="alert-text">*Masukkan nilai ke dalam tabel dengan benar</p>
        <p class="alert-text alert-kirim2">*Sudah Melakukan Pinjaman</p>
        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label">Total Peminjaman</label>
            <input type="text" id="ttotalpeminjaman2" name="ttotalpeminjaman2" class="form-control total-peminjaman total-peminjaman2 ttotalpeminjaman2" value="Rp. 0" disabled oninput="hitungPembayaran(this)" />
          </div>
          <div class="col-md-4">
            <label class="form-label">Pembayaran</label>
            <input type="text" id="tpembayaran2" name="tpembayaran2" class="form-control pembayaran pembayaran2 tpembayaran2" value="0" disabled oninput="hitungPembayaran(this)" />
          </div>
          <div class="col-md-4">
            <label class="form-label">Bunga</label>
            <input type="text" name="tbunga2" class="form-control bunga bunga2" value="0.5" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
          </div>
          <div class="col-md-4">
            <label class="form-label">Total Pokok</label>
            <input type="text" name="ttotalpokok2" class="form-control total-pokok total-pokok2" value="Rp. 0" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
          </div>
          <div class="col-md-4">
            <label class="form-label">Total Bunga</label>
            <input type="text" name="ttotalbunga2" class="form-control total-bunga total-bunga2" value="Rp. 0" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
          </div>
          <div class="col-md-4">
            <label class="form-label">Total Pembayaran</label>
            <input type="text" name="ttotalpembayaran2" class="form-control total-pembayaran total-pembayaran2" value="Rp. 0" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
          </div>
          <div class="col-md-12">
            <label class="form-label">Deskripsi Keperluan</label>
            <input type="text" name="deskripsi2" class="form-control deskripsi-keperluan deskripsi2" disabled id="deskripsi2" />
          </div>
          <div class="col-md-12">
            <button type="submit" class="form-control btn btn-save mt-3 peminjaman2 btn-kirim2" id="peminjaman2" disabled><i class="fa-regular fa-circle-check"></i> Save</button>
          </div>
        </div>
      </div>
      </form>
      <script src="{{ asset('js/script_pinjaman_admin.js') }}"></script>
      <script>

    const btnKirim = document.querySelector(".btn-kirim");
    const alert_kirim = document.querySelector(".alert-kirim");
    const ttotalpeminjaman1 = document.querySelector(".ttotalpeminjaman1");
    const tpembayaran1 = document.querySelector(".tpembayaran1");

    const btnKirim2 = document.querySelector(".btn-kirim2");
    const alert_kirim2 = document.querySelector(".alert-kirim2");
    const ttotalpeminjaman2 = document.querySelector(".ttotalpeminjaman2");
    const tpembayaran2 = document.querySelector(".tpembayaran2");
document.querySelector(".nomorpeserta").addEventListener("keyup", function () {
    const nomor = this.value;

    if (nomor.length > 0) {
        fetch(`/search-user?id=${nomor}&pinjaman_id=${nomor}`)
            .then((response) => response.json())
            .then((data) => {
                if (data.error) {
                    // Kosongkan field jika user tidak ditemukan
                    document.querySelector(".nama").value = "";
                    document.querySelector(".nohp").value = "";
                    document.querySelector(".ttl").value = "";
                    document.querySelector(".alamat").value = "";
                    document.getElementById("pinjaman_id").value = "";
                    document.getElementById("pinjaman_id2").value = "";

                    return;
                } else {
                    document.querySelector(".nama").value = data.nama;
                    document.querySelector(".nohp").value = data.telepon;
                    document.querySelector(".ttl").value = data.ttl;
                    document.querySelector(".alamat").value = data.alamat;
                    document.getElementById("pinjaman_id").value = data.id;
                    document.getElementById("pinjaman_id2").value = data.id;

                    if (!data.ttotalpeminjaman1) {
                      btnKirim.disabled = false;
                      ttotalpeminjaman1.disabled = false;
                      tpembayaran1.disabled = false;
                      deskripsi1.disabled = false;
                      btnKirim.classList.remove("disabled");
                      ttotalpeminjaman1.classList.remove("disabled");
                      tpembayaran1.classList.remove("disabled");
                      deskripsi1.classList.remove("disabled");
                      alert_kirim.classList.add("d-none");
                    } else {
                      btnKirim.disabled = true;
                      ttotalpeminjaman1.disabled = true;
                      tpembayaran1.disabled = true;
                      deskripsi1.disabled = true;
                      btnKirim.classList.add("disabled");
                      alert_kirim.classList.remove("d-none");
                      ttotalpeminjaman1.classList.add("disabled");
                      tpembayaran1.classList.add("disabled");
                      deskripsi1.classList.add("disabled");
                    }
                    if (!data.ttotalpeminjaman2) {
                      btnKirim2.disabled = false;
                      ttotalpeminjaman2.disabled = false;
                      tpembayaran2.disabled = false;
                      deskripsi2.disabled = false;
                      btnKirim2.classList.remove("disabled");
                      ttotalpeminjaman2.classList.remove("disabled");
                      tpembayaran2.classList.remove("disabled");
                      deskripsi2.classList.remove("disabled");
                      alert_kirim2.classList.add("d-none");
                    } else {
                      btnKirim2.disabled = true;
                      ttotalpeminjaman2.disabled = true;
                      tpembayaran2.disabled = true;
                      deskripsi2.disabled = true;
                      btnKirim2.classList.add("disabled");
                      alert_kirim2.classList.remove("d-none");
                      ttotalpeminjaman2.classList.add("disabled");
                      tpembayaran2.classList.add("disabled");
                      deskripsi2.classList.add("disabled");
                    }
                }
            });
    } else {
        document.querySelector(".nama").value = "";
        document.querySelector(".nohp").value = "";
        document.querySelector(".ttl").value = "";
        document.querySelector(".alamat").value = "";
        document.getElementById("pinjaman_id").value = "";
        document.getElementById("pinjaman_id2").value = "";
    }
});

        document
    .getElementById("form-peminjaman")
    .addEventListener("submit", function (e) {
        e.preventDefault(); // Hentikan submit default

        let deskripsi = document.getElementById("deskripsi1").value.trim();
        let ttotalpeminjaman1 = document
            .getElementById("ttotalpeminjaman1")
            .value.trim();
        let tpembayaran1 = document.getElementById("tpembayaran1").value.trim();
        let nomor = document.getElementById("nomor").value.trim();
        let tanggal_pembayaran = document.getElementById("tanggal_pembayaran");
        const card = this.querySelector(".card");

        const fields = [
            ".total-peminjaman",
            ".total-pokok",
            ".total-bunga",
            ".total-pembayaran",
        ];

        if (!nomor) {
            Swal.fire({
                icon: "error",
                title: "Nomor Belum Diisi!",
                text: "Mohon Isi Nomor Terlebih Dahulu",
            });
            return;
        }
        if (!ttotalpeminjaman1 || !tpembayaran1) {
            Swal.fire({
                icon: "error",
                title: "Kolom Kosong!",
                text: "Mohon Isi Kolom Terlebih Dahulu",
            });
            return;
        }

        Swal.fire({
            title: "Apakah Kamu Yakin ?",
            text: "Mohon Cek Ulang !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya",
        }).then((result) => {
            if (result.isConfirmed) {
                if (deskripsi === "") {
                    Swal.fire({
                        icon: "error",
                        title: "Mohon Isikan Deskripsi Keperluan",
                        text: "Silakan isi kembali.",
                    });
                    return;
                }
                fields.forEach((selector) => {
                    const input = card.querySelector(selector);
                    if (input) {
                        input.value = input.value.replace(/[^0-9]/g, ""); // hapus Rp. dan ,
                    }
                });
                tanggal_pembayaran.value = new Date()
                    .toISOString()
                    .split("T")[0];
                this.submit(); // Submit manual kalau semua OK
            }
        });
    });

document
    .getElementById("form-peminjaman2")
    .addEventListener("submit", function (e) {
        e.preventDefault(); // Hentikan submit default

        let deskripsi = document.getElementById("deskripsi2").value.trim();
        let ttotalpeminjaman2 = document
            .getElementById("ttotalpeminjaman2")
            .value.trim();
        let tpembayaran2 = document.getElementById("tpembayaran2").value.trim();
        let nomor = document.getElementById("nomor").value.trim();
        const card = this.querySelector(".card");

        const fields = [
            ".total-peminjaman",
            ".total-pokok",
            ".total-bunga",
            ".total-pembayaran",
        ];

        if (!nomor) {
            Swal.fire({
                icon: "error",
                title: "Nomor Belum Diisi!",
                text: "Mohon Isi Nomor Terlebih Dahulu",
            });
            return;
        }
        if (!ttotalpeminjaman2 || !tpembayaran2) {
            Swal.fire({
                icon: "error",
                title: "Kolom Kosong!",
                text: "Mohon Isi Kolom Terlebih Dahulu",
            });
            return;
        }

        Swal.fire({
            title: "Apakah Kamu Yakin ?",
            text: "Mohon Cek Ulang !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya",
        }).then((result) => {
            if (result.isConfirmed) {
                if (deskripsi === "") {
                    Swal.fire({
                        icon: "error",
                        title: "Mohon Isikan Deskripsi Keperluan",
                        text: "Silakan isi kembali.",
                    });
                    return;
                }
                fields.forEach((selector) => {
                    const input = card.querySelector(selector);
                    if (input) {
                        input.value = input.value.replace(/[^0-9]/g, ""); // hapus Rp. dan ,
                    }
                });
                this.submit(); // Submit manual kalau semua OK
            }
        });
    });
      </script>
      @include('layout.admin_footer')
