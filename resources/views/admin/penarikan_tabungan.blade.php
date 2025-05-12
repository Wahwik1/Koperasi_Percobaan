@include('layout.admin_header')
@include('layout.admin_navbar')

  @if (session('success-tabungan'))
  <script>
  Swal.fire({
      title: "Penarikan Tabungan Sukses",
      text: "Mohon Silahkan Dicek",
      icon: "success",
  });
  </script>
  @endif
    <!-- Header Peminjaman -->
    <div class="container mt-4">
      <h2 class="header-title">PENARIKAN TABUNGAN</h2>

      <!-- Live Date -->
      <p class="header-date" id="liveDate"></p>

      <!-- Identitas User -->
      <div class="user-detail">
        <div class="row mb-3">
          <div class="row mb-3">
            <div class="col-2">
              <label for="" class="form-label">Nomor:</label>
              <input type="text" class="form-control nomorpeserta text-center" id="nomor"/>
            </div>
            <p class="alert-text">*Masukkan Nomor</p>
          </div>
        </div>
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Nama Lengkap :</label>
            <input type="text" class="form-control nama_tabungan" value="" readonly placeholder="Terisi Otomatis"/>
          </div>
          <div class="col-md-6">
            <label class="form-label">Nomor Telepon :</label>
            <input type="text" class="form-control nohp_tabungan" value="" readonly placeholder="Terisi Otomatis"/>
          </div>
          <div class="col-md-6">
            <label class="form-label">Tempat, Tanggal Lahir :</label>
            <input type="text" class="form-control ttl_tabungan" value="" readonly placeholder="Terisi Otomatis"/>
          </div>
          <div class="col-md-6">
            <label class="form-label">Alamat :</label>
            <input type="text" class="form-control alamat_tabungan" value="" readonly placeholder="Terisi Otomatis"/>
          </div>
        </div>
      </div>

      <!-- Penarikan Tabungan -->
      <form id="form-tabungan" action="{{ route('admin.tabungan') }}" method="post">
        @csrf
        <input type="hidden" id="tabungan_id" name="tabungan_id">
        <div class="card mt-4">
          <h5 class="fw-bold">Penarikan Tabungan</h5>
          <p class="alert-text">*Masukkan nilai ke dalam tabel dengan benar</p>
          <div class="row g-3">
            <div class="col-md-4">
              <label class="form-label">Penarikan Tabungan</label>
              <input type="text" class="form-control penarikan-tabungan" id="penarikan_tabungan" value="Rp 0" oninput="hitungPembayaran(this)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Tabungan Saat Ini</label>
              <input type="text" class="form-control tabungan-saat-ini tabungan" id="tabungansaatini" value="Rp 0" readonly />
            </div>
            <div class="col-md-4">
              <label class="form-label">Sisa Tabungan</label>
              <input type="text" class="form-control sisa-tabungan" name="tabungan" id="sisa_tabungan" value="Rp. 0" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
            </div>
          </div>
          <div class="col-md-12">
            <button type="submit" class="form-control btn btn-save mt-3 tombolpenarikantabungan" id="penarikantabungan"><i class="fa-regular fa-circle-check"></i> Save</button>
          </div>
        </div>
      </form>
    </div>
    <script src="../js/script_penarikan_tabungan_admin.js"></script>
    <script>
        document.getElementById("form-tabungan").addEventListener("submit", function (e) {
        e.preventDefault(); // Hentikan submit default

        let penarikan_tabungan = document.getElementById("penarikan_tabungan").value.trim();
        let tabungansaatini = document.getElementById("tabungansaatini").value.trim();
        let sisa_tabungan = document.getElementById("sisa_tabungan").value.trim();
        let nomor = document.getElementById("nomor").value.trim();
        const card = this.querySelector(".card");

        const fields = [
            '.sisa-tabungan',
            '.penarikan-tabungan',
            '.tabungan-saat-ini'
        ];

        let tabungansaatiniValue = parseInt(tabungansaatini.replace(/[^0-9]/g, ""));
        let penarikan_tabunganValue = parseInt(penarikan_tabungan.replace(/[^0-9]/g, ""));


        if(penarikan_tabunganValue > tabungansaatiniValue){
          Swal.fire({
              title: "Tabungan Tidak Cukup",
              text: "Mohon Cukupi Saldo",
              icon: "error",
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

    function formatRupiah(angka) {
        // Ubah string ke angka jika perlu
        angka = parseFloat(angka);
        if (isNaN(angka)) return "Rp. 0";

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
        fetch(`/search-user-tabungan?id=${nomor}`)
            .then((response) => response.json())
            .then((data) => {
                if (data.error) {
                    // Kosongkan field jika user tidak ditemukan
                    document.querySelector(".nama_tabungan").value = "";
                    document.querySelector(".nohp_tabungan").value = "";
                    document.querySelector(".ttl_tabungan").value = "";
                    document.querySelector(".alamat_tabungan").value = "";
                    document.querySelector(".tabungan").value = "Rp 0";
                    return; // keluar agar tidak lanjut
                }

                // Isi data user
                document.querySelector(".nama_tabungan").value = data.nama_tabungan;
                document.querySelector(".nohp_tabungan").value = data.telepon_tabungan;
                document.querySelector(".ttl_tabungan").value = data.ttl_tabungan;
                document.querySelector(".alamat_tabungan").value = data.alamat_tabungan;
                document.querySelector(".tabungan").value = formatRupiah(data.tabungan)
                document.getElementById("tabungan_id").value = data.id;
            });
    } else {
        // Kosongkan semua jika input kosong
        document.querySelector(".nama_tabungan").value = "";
        document.querySelector(".nohp_tabungan").value = "";
        document.querySelector(".ttl_tabungan").value = "";
        document.querySelector(".alamat_tabungan").value = "";
        document.querySelector(".tabungan").value = "Rp 0";
    }
});
    </script>
  </body>
</html>
