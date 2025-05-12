@include('layout.admin_header')
@include('layout.admin_navbar')

      @if (session('gagal-overbook'))
      <script>
        Swal.fire({
            title: "Data Sedang Memiliki Pinjaman",
            text: "Mohon Buat Peminjaman Baru atau Overbook",
            icon: "error",
        });
      </script>
      @endif
      @if (session('success-overbook'))
      <script>
        Swal.fire({
            title: "Overbook Sukses",
            text: "Mohon Silahkan Dicek",
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
          <div class="col-2">
            <label for="" class="form-label">Nomor:</label>
            <input type="text" class="form-control nomorpeserta text-center" id="nomor"/>
          </div>
          <p class="alert-text">*Masukkan Nomor</p>
        </div>
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Nama Lengkap :</label>
            <input type="text" class="form-control nama-overbook" value="" readonly placeholder="Terisi Otomatis"/>
          </div>
          <div class="col-md-6">
            <label class="form-label">Nomor Telepon :</label>
            <input type="text" class="form-control nohp-overbook" value="" readonly placeholder="Terisi Otomatis"/>
          </div>
          <div class="col-md-6">
            <label class="form-label">Tempat, Tanggal Lahir :</label>
            <input type="text" class="form-control ttl-overbook" value="" readonly placeholder="Terisi Otomatis"/>
          </div>
          <div class="col-md-6">
            <label class="form-label">Alamat :</label>
            <input type="text" class="form-control alamat-overbook" value="" readonly placeholder="Terisi Otomatis"/>
          </div>
        </div>
      </div>

     

     <form class="formku" id="form-overbook" action="{{ route('admin.overbook1') }}" method="post">
      @csrf
      <input type="hidden" id="pinjaman_id" name="pinjaman_id">
     <!-- Card Peminjaman -->
     <div class="card mt-4">
      <h5 class="fw-bold">Overbook Pinjaman Pertama</h5>
      <p class="alert-text alert-kirim">*Belum Melakukan Pinjaman</p>
      <p class="alert-text">*Masukkan nilai ke dalam tabel dengan benar</p>
      <div class="row g-3">
        <div class="col-md-4">
          <label class="form-label">Total Peminjaman</label>
          <input type="text" name="ttotalpeminjaman1" class="form-control total-peminjaman ttotalpeminjaman1" id="ttotalpeminjaman1" value="Rp. 0" oninput="hitungPembayaran(this)" />
        </div>
        <div class="col-md-4">
          <label class="form-label">Pembayaran</label>
          <input type="text" name="tpembayaran1" class="form-control pembayaran tpembayaran1" id="tpembayaran1" value="0" oninput="hitungPembayaran(this)" />
        </div>
        <div class="col-md-4">
          <label class="form-label">Bunga</label>
          <input type="text" name="tbunga1" class="form-control bunga" value="0.5" id="tbunga1" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
        </div>
        <div class="col-md-4">
          <label class="form-label">Total Pokok</label>
          <input type="text" name="ttotalpokok1" class="form-control total-pokok" id="ttotalpokok1" value="Rp. 0" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
        </div>
        <div class="col-md-4">
          <label class="form-label">Total Bunga</label>
          <input type="text" name="ttotalbunga1" class="form-control total-bunga" id="ttotalbunga1" value="Rp. 0" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
        </div>
        <div class="col-md-4">
          <label class="form-label">Total Pembayaran</label>
          <input type="text" name="ttotalpembayaran1" class="form-control total-pembayaran" id="ttotalpembayaran" value="Rp. 0" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
        </div>
        <div class="col-md-4">
          <label class="form-label">Sisa Pokok</label>
          <input type="text" name="tsisapokok1" class="form-control total-pokoksebelumnya tpokok1" id="tsisapokok1" value="Rp. 0" value="Rp. 0" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
        </div>
        <div class="col-md-4">
          <label class="form-label">Total Yang Didapatkan</label>
          <input type="text" name="ttotal1" class="form-control total-didapatkan" id="total1" value="Rp. 0" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
        </div>
        <div class="col-md-12">
          <label class="form-label">Deskripsi Keperluan</label>
          <input type="text" name="deskripsi1" class="form-control deskripsi-keperluan" id="deskripsi1" />
        </div>
        
        <div class="col-md-12">
          <button type="submit" class="form-control btn btn-save mt-3 overbook1 btn-kirim disabled" id="overbook1"><i class="fa-regular fa-circle-check"></i> Save</button>
        </div>
      </div>
    </div>
  </form>

      <!-- Card Peminjaman 2 -->
    <form class="formku" id="form-overbook2" action="{{ route('admin.overbook2') }}" method="post">
      @csrf
      <input type="hidden" id="pinjaman_id2" name="pinjaman_id">
      <div class="card mt-4">
        <h5 class="fw-bold">Overbook Pinjaman Kedua</h5>
        <p class="alert-text alert-kirim2">*Belum Melakukan Pinjaman</p>
        <p class="alert-text">*Masukkan nilai ke dalam tabel dengan benar</p>
        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label">Total Peminjaman</label>
            <input type="text" name="ttotalpeminjaman2" class="form-control total-peminjaman totalpeminjamanPDF" id="ttotalpeminjaman2" value="Rp. 0" oninput="hitungPembayaran(this)" />
          </div>
          <div class="col-md-4">
            <label class="form-label">Pembayaran</label>
            <input type="text" name="tpembayaran2" class="form-control pembayaran pembayaranPDF" id="tpembayaran2" value="0" oninput="hitungPembayaran(this)" />
          </div>
          <div class="col-md-4">
            <label class="form-label">Bunga</label>
            <input type="text" name="tbunga2" class="form-control bunga bungaPDF" value="0.5" id="tbunga2" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
          </div>
          <div class="col-md-4">
            <label class="form-label">Total Pokok</label>
            <input type="text" name="ttotalpokok2" class="form-control total-pokok totalpokokPDF" id="ttotalpokok2" value="Rp. 0" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
          </div>
          <div class="col-md-4">
            <label class="form-label">Total Bunga</label>
            <input type="text" name="ttotalbunga2" class="form-control total-bunga totalbungaPDF" id="ttotalbunga2" value="Rp. 0" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
          </div>
          <div class="col-md-4">
            <label class="form-label">Total Pembayaran</label>
            <input type="text" name="ttotalpembayaran2" class="form-control total-pembayaran totalpembayaranPDF" id="ttotalpembayaran2" value="Rp. 0" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
          </div>
          <div class="col-md-4">
            <label class="form-label">Sisa Pokok</label>
            <input type="text" name="tsisapokok2" class="form-control total-pokoksebelumnya tpokok2" id="tsisapokok2" value="Rp. 0" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
          </div>
          <div class="col-md-4">
            <label class="form-label">Total Yang Didapatkan</label>
            <input type="text" name="total2" class="form-control total-didapatkan" id="total2" value="Rp. 0" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
          </div>
          <div class="col-md-12">
            <label class="form-label">Deskripsi Keperluan</label>
            <input type="text" name="deskripsi2" class="form-control deskripsi-keperluan" id="deskripsi2"/>
          </div>
          <div class="col-md-12">
            <button type="submit" class="form-control btn btn-save mt-3 overbook1 btn-kirim2 disabled" id="overbook2"><i class="fa-regular fa-circle-check"></i> Save</button>
          </div>
        </div>
      </div>
    </form>
    </div>
    <script src="../js/script_overbook_admin.js"></script>
    <script>
    document.getElementById("form-overbook").addEventListener("submit", function (e) {
    e.preventDefault(); // Hentikan submit default

    let deskripsi = document.getElementById("deskripsi1").value.trim();
    let ttotalpeminjaman1= document.getElementById("ttotalpeminjaman1").value.trim();
    let tpembayaran1 = document.getElementById("tpembayaran1").value.trim();
    let tsisapokok1= document.getElementById("tsisapokok1").value.trim();
    let total1 = document.getElementById("total1").value.trim();
    let nomor = document.getElementById("nomor").value.trim();
    const card = this.querySelector(".card");

    const fields = [
        ".total-peminjaman",
        ".total-pokok",
        ".total-bunga",
        ".total-pembayaran",
        ".total-pokoksebelumnya",
        ".total-didapatkan"
    ];

    if (!nomor) {
          Swal.fire({
              icon: "error",
              title: "Nomor Belum Diisi!",
              text: "Mohon Isi Nomor Terlebih Dahulu",
          });
          return;
      }
    if (!ttotalpeminjaman1|| !tpembayaran1) {
          Swal.fire({
              icon: "error",
              title: "Kolom Kosong!",
              text: "Mohon Isi Kolom Terlebih Dahulu",
          });
          return;
      }

      let sisaPokokValue = parseInt(tsisapokok1.replace(/[^0-9]/g, ""));
      let totalYangDidapatkan = parseInt(ttotalpeminjaman1.replace(/[^0-9]/g, ""));

      // Cek jika sisa pokok lebih besar dari total yang didapatkan
      if (sisaPokokValue > totalYangDidapatkan) {
          Swal.fire({
              icon: "error",
              title: "Over Limit!",
              text: "Total yang didapatkan tidak boleh lebih kecil dari sisa pokok!",
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
            fields.forEach(selector => {
            const input = card.querySelector(selector);
            if (input) {
                input.value = input.value.replace(/[^0-9]/g, ""); // hapus Rp. dan ,
            }
        });
            this.submit(); // Submit manual kalau semua OK
        }
    });
});
    document.getElementById("form-overbook2").addEventListener("submit", function (e) {
    e.preventDefault(); // Hentikan submit default

    let deskripsi = document.getElementById("deskripsi2").value.trim();
    let ttotalpeminjaman2= document.getElementById("ttotalpeminjaman2").value.trim();
    let tpembayaran2 = document.getElementById("tpembayaran2").value.trim();
    let tsisapokok2= document.getElementById("tsisapokok2").value.trim();
    let total2 = document.getElementById("total2").value.trim();
    let nomor = document.getElementById("nomor").value.trim();
    const card = this.querySelector(".card");

    const fields = [
        ".total-peminjaman",
        ".total-pokok",
        ".total-bunga",
        ".total-pembayaran",
        ".total-pokoksebelumnya",
        ".total-didapatkan"
    ];

    if (!nomor) {
          Swal.fire({
              icon: "error",
              title: "Nomor Belum Diisi!",
              text: "Mohon Isi Nomor Terlebih Dahulu",
          });
          return;
      }
    if (!ttotalpeminjaman2|| !tpembayaran2) {
          Swal.fire({
              icon: "error",
              title: "Kolom Kosong!",
              text: "Mohon Isi Kolom Terlebih Dahulu",
          });
          return;
      }

      let sisaPokokValue = parseInt(tsisapokok2.replace(/[^0-9]/g, ""));
      let totalYangDidapatkan = parseInt(ttotalpeminjaman2.replace(/[^0-9]/g, ""));

      // Cek jika sisa pokok lebih besar dari total yang didapatkan
      if (sisaPokokValue > totalYangDidapatkan) {
          Swal.fire({
              icon: "error",
              title: "Over Limit!",
              text: "Total yang didapatkan tidak boleh lebih kecil dari sisa pokok!",
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
            fields.forEach(selector => {
            const input = card.querySelector(selector);
            if (input) {
                input.value = input.value.replace(/[^0-9]/g, ""); // hapus Rp. dan ,
            }
        });
            this.submit(); // Submit manual kalau semua OK
        }
    });
});

    const btnKirim = document.querySelector(".btn-kirim");
    const alert_kirim = document.querySelector(".alert-kirim");
    const btnKirim2 = document.querySelector(".btn-kirim2");
    const alert_kirim2 = document.querySelector(".alert-kirim2");
    function formatRupiah(angka) {
        // Ubah string ke angka jika perlu
        angka = parseFloat(angka);
        if (isNaN(angka)) return "Rp 0";

        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(angka);
    }
      document.querySelector(".nomorpeserta").addEventListener("keyup", function () {
    const nomor = this.value;

    if (nomor.length > 0) {
    fetch(`/search-user-overbook?id=${nomor}&pinjaman_id=${nomor}`)
        .then((response) => response.json())
        .then((data) => {
            if (data.error) {
                // Kosongkan field jika user tidak ditemukan
                document.querySelector(".nama-overbook").value = "";
                document.querySelector(".nohp-overbook").value = "";
                document.querySelector(".ttl-overbook").value = "";
                document.querySelector(".alamat-overbook").value = "";
                document.querySelector(".tpokok1").value = "";
                document.querySelector(".tpokok2").value = "";
                document.getElementById("pinjaman_id").value = "";
                document.getElementById("pinjaman_id2").value = "";
                return; // keluar agar tidak lanjut
            }

            // Isi data user
            document.querySelector(".nama-overbook").value = data.nama_overbook;
            document.querySelector(".nohp-overbook").value = data.telepon_overbook;
            document.querySelector(".ttl-overbook").value = data.ttl_overbook;
            document.querySelector(".alamat-overbook").value = data.alamat_overbook;

            if (!data.tpokok1) {
                document.querySelector(".tpokok1").value = "Rp. 0";
                btnKirim.disabled = true;
                btnKirim.classList.add("disabled");
                alert_kirim.classList.remove("d-none");
            } else {
                btnKirim.disabled = false;
                btnKirim.classList.remove("disabled");
                alert_kirim.classList.add("d-none");
                document.querySelector(".tpokok1").value = formatRupiah(data.tpokok1);
            }

            if (!data.tpokok2) {
                document.querySelector(".tpokok2").value = "Rp. 0";
                btnKirim2.disabled = true;
                btnKirim2.classList.add("disabled");
                alert_kirim2.classList.remove("d-none");
            } else {
                btnKirim2.disabled = false;
                btnKirim2.classList.remove("disabled");
                alert_kirim2.classList.add("d-none");
                document.querySelector(".tpokok2").value = formatRupiah(data.tpokok2);
            }
            document.getElementById("pinjaman_id").value = data.id;
            document.getElementById("pinjaman_id2").value = data.id;
        });
      } else {
          // Kosongkan semua jika input kosong
          document.querySelector(".nama-overbook").value = "";
          document.querySelector(".nohp-overbook").value = "";
          document.querySelector(".ttl-overbook").value = "";
          document.querySelector(".alamat-overbook").value = "";
          document.querySelector(".tpokok1").value = "Rp. 0";
          document.querySelector(".tpokok2").value = "Rp. 0";
          document.getElementById("pinjaman_id").value = "";
          document.getElementById("pinjaman_id2").value = "";
      }
});


    </script>
  </body>
</html>
