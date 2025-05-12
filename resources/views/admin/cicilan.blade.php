@include('layout.admin_header')
@include('layout.admin_navbar')

        @if (session('success-tabungan'))
        <script>
        Swal.fire({
            title: "Tabungan Sukses",
            text: "Mohon Silahkan Dicek",
            icon: "success",
        });
        </script>
        @endif

        @if (session('success-pinjaman'))
        <script>
           Swal.fire({
              title: "Pembayaran Pinjaman Sukses",
              text: "Mohon Silahkan Dicek",
              icon: "success",
          });
        </script>
        @endif
<!-- Header Peminjaman -->
    <div class="container mt-4">
      <h2 class="header-title">PEMBAYARAN CICILAN</h2>

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
            <p class="alert-text alert-peringatan">*Masukkan nomor</p>
          </div>
        </div>
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Nama Lengkap :</label>
            <input type="text" class="form-control nama_cicilan" value="" readonly placeholder="Terisi Otomatis"/>
          </div>
          <div class="col-md-6">
            <label class="form-label">Nomor Telepon :</label>
            <input type="text" class="form-control nohp_cicilan" value="" readonly placeholder="Terisi Otomatis"/>
          </div>
          <div class="col-md-6">
            <label class="form-label">Tempat, Tanggal Lahir :</label>
            <input type="text" class="form-control ttl_cicilan" value="" readonly placeholder="Terisi Otomatis"/>
          </div>
          <div class="col-md-6">
            <label class="form-label">Alamat :</label>
            <input type="text" class="form-control alamat_cicilan" value="" readonly placeholder="Terisi Otomatis"/>
          </div>
          <!-- Tombol Start -->
          <form id="resetBunga" action="{{ route('admin.resetBunga') }}" method="POST">
            @csrf
            <button 
              id="startButton"
              type="submit" 
              class="btn btn-primary" 
              style="width: 100%"
              {{-- {{ $isResetDisabled ? 'disabled' : '' }} --}}
            >
              Proses Bunga
            </button>
          </form>
          
          {{-- @if ($isResetDisabled && $nextAvailableDate)
            <small class="text-secondary">
                Tombol akan aktif kembali pada tanggal {{ \Carbon\Carbon::parse($nextAvailableDate)->translatedFormat('d F Y') }}
            </small>
          @endif --}}
        </div>
      </div>

      {{-- Tabungan --}}
      <form id="form-tabungan" action="{{ route('admin.cicilantabungan') }}" method="post">
        @csrf
        <input type="hidden" id="tabungan_id" name="tabungan_id">
        <input type="hidden" id="jenis1" name="jenis1" value="Pembayaran Tabungan">
        <div class="card mt-4">
            <h5 class="fw-bold">PEMBAYARAN TABUNGAN</h5>
            <p class="alert-text">*Masukkan nilai ke dalam tabel dengan benar</p>
            <div class="row g-3">
              <div class="col-md-4">
                <label class="form-label">Pembayaran Tabungan</label>
                <input type="text" name="pembayarantabungan" class="form-control pembayaran-tabungan" value="Rp 0" oninput="hitungPembayaranTabungan(this)" />
              </div>
              <div class="col-md-4">
                <label class="form-label">Tabungan Saat Ini</label>
                <input type="text" name="tabungansebelumnya" class="form-control tabungan-sebelumnya tabungan_cicilan" value="Rp 0" readonly style="background-color: rgba(128, 128, 128, 0.302)"/>
              </div>
              <div class="col-md-4">
                <label class="form-label">Total Tabungan</label>
                <input type="text" name="tabungan" class="form-control total-tabungan" id="tabungan_cicilan" value="Rp. 0" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
              </div>
            </div>
            <div class="col-md-12">
              <button type="submit" class="form-control btn btn-save mt-3 tombolpembayarantabungan" id="penarikantabungan"><i class="fa-regular fa-circle-check"></i> Save</button>
            </div>
          </div>
      </form>

      <!-- Card Peminjaman -->
      <form class="formku" id="form-peminjaman1" action="{{ route('admin.prosesPembayaran') }}" method="post">
        @csrf
        <input type="hidden" name="pinjaman_id" id="pinjaman_id">
        <input type="hidden" name="jenis1" id="jenis1" value="Peminjaman Pertama">
        <div class="card mt-4">
          <h5 class="fw-bold">Pinjaman Pertama</h5>
          <p class="alert-text alert_kirim">*Belum Melakukan Pinjaman</p>
          <p class="alert-text">*Masukkan nilai ke dalam tabel dengan benar</p>
          <div class="row g-3">
            <div class="col-md-4">
              <label class="form-label">Pembayaran Pokok</label>
              <input type="text" name="pokok_dibayar" id="pokok_dibayar" class="form-control pembayaran-pokok pembayaran-pokok1" value="Rp 0" oninput="hitungPembayaranPeminjaman1(this)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Pembayaran Bunga</label>
              <input type="text" name="bunga_dibayar" id="bunga_dibayar" class="form-control pembayaran-bunga pembayaran-bunga1 ttotalbunga1" readonly value="Rp 0" style="background-color: rgba(128, 128, 128, 0.302)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Pembayaran Denda</label>
              <input type="text" name="denda" id="denda" class="form-control pembayaran-denda pembayaran-denda1 denda" readonly value="Rp 0" style="background-color: rgba(128, 128, 128, 0.302)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Total Peminjaman</label>
              <input type="text" name="ttotalpeminjaman1" id="ttotalpeminjaman1" class="form-control total-peminjaman total-peminjaman1 ttotalpeminjaman1" value="Rp 0" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Pembayaran Ke -</label>
              <input type="text" id="tpembayaran1" class="form-control pembayaran pembayaran1 tpembayaran1" name="tpembayaran1" value="0" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Pokok Seharusnya</label>
              <input type="text" id="ttotalpokok1" class="form-control pokok-seharusnya pokok-seharusnya1 ttotalpokok1" name="ttotalpokok1" readonly value="Rp 0" style="background-color: rgba(128, 128, 128, 0.302)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Sisa Pokok</label>
              <input type="text" name="pokok1" id="pokok1" class="form-control sisa-pokok sisa-pokok1 pokok1" readonly value="Rp 0" style="background-color: rgba(128, 128, 128, 0.302)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Total Pembayaran</label>
              <input type="text" name="jumlah_bayar" id="jumlah_bayar" class="form-control total-pembayaran total-pembayaran1" value="Rp 0" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
            </div>
  
            <div class="col-md-12">
              <button type="submit" class="form-control btn btn-save mt-3 peminjaman1 btn-kirim disabled" id="peminjaman1"><i class="fa-regular fa-circle-check"></i> Save</button>
            </div>
          </div>
        </div>
      </form>

      {{-- Card Peminjaman 2 --}}
      <form class="formku" id="form-peminjaman2" action="{{ route('admin.prosesPembayaran2') }}" method="post">
        @csrf
        <input type="hidden" name="pinjaman_id" id="pinjaman_id2">
        <input type="hidden" name="jenis2" id="jenis2" value="Peminjaman Kedua">
        <div class="card mt-4">
          <h5 class="fw-bold">Pinjaman Kedua</h5>
          <p class="alert-text alert_kirim2">*Belum Melakukan Pinjaman</p>
          <p class="alert-text">*Masukkan nilai ke dalam tabel dengan benar</p>
          <div class="row g-3">
            <div class="col-md-4">
              <label class="form-label">Pembayaran Pokok</label>
              <input type="text" name="pokok_dibayar2" id="pokok_dibayar2" class="form-control pembayaran-pokok pembayaran-pokok2" value="Rp 0" oninput="hitungPembayaranPeminjaman2(this)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Pembayaran Bunga</label>
              <input type="text" name="bunga_dibayar2" id="bunga_dibayar2" class="form-control pembayaran-bunga pembayaran-bunga2 ttotalbunga2" readonly value="Rp 0" style="background-color: rgba(128, 128, 128, 0.302)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Pembayaran Denda</label>
              <input type="text" name="denda2" id="denda2" class="form-control pembayaran-denda pembayaran-denda2 denda2" readonly value="Rp 0" style="background-color: rgba(128, 128, 128, 0.302)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Total Peminjaman</label>
              <input type="text" name="ttotalpeminjaman2" id="ttotalpeminjaman2" class="form-control total-peminjaman total-peminjaman2 ttotalpeminjaman2" value="Rp 0" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Pembayaran Ke -</label>
              <input type="text" id="tpembayaran2" class="form-control pembayaran pembayaran2 tpembayaran2" name="tpembayaran2" value="0" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Pokok Seharusnya</label>
              <input type="text" id="ttotalpokok2" class="form-control pokok-seharusnya pokok-seharusnya2 ttotalpokok2" name="ttotalpokok2" readonly value="Rp 0" style="background-color: rgba(128, 128, 128, 0.302)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Sisa Pokok</label>
              <input type="text" name="pokok2" id="pokok2_cicilan" class="form-control sisa-pokok sisa-pokok2 pokok2_cicilan" readonly value="Rp 0" style="background-color: rgba(128, 128, 128, 0.302)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Total Pembayaran</label>
              <input type="text" name="jumlah_bayar2" id="jumlah_bayar2" class="form-control total-pembayaran total-pembayaran2" value="Rp 0" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
            </div>
  
            <div class="col-md-12">
              <button type="submit" class="form-control btn btn-save mt-3 peminjaman2 btn-kirim2 disabled" id="peminjaman2"><i class="fa-regular fa-circle-check"></i> Save</button>
            </div>
          </div>
        </div>
      </form>



    </div>
    <script src="../js/script_cicilan_admin.js"></script>
    <script>
    const btnKirim = document.querySelector(".btn-kirim");
    const alert_kirim = document.querySelector(".alert_kirim");
    const btnKirim2 = document.querySelector(".btn-kirim2");
    const alert_kirim2 = document.querySelector(".alert_kirim2"); 

    document.querySelector(".nomorpeserta").addEventListener("keyup", function () {
    const nomor = this.value;

    if (nomor.length > 0) {
        fetch(`/search-user-cicilan?id=${nomor}`)
            .then((response) => response.json())
            .then((data) => {
                if (data.error) {
                  document.querySelector(".nama_cicilan").value = "";
                  document.querySelector(".nohp_cicilan").value = "";
                  document.querySelector(".ttl_cicilan").value = "";
                  document.querySelector(".alamat_cicilan").value = "";                 
                  document.querySelector(".tabungan_cicilan").value = "Rp 0";
                  document.querySelector(".ttotalpeminjaman1").value = "Rp 0";
                  document.querySelector(".tpembayaran1").value = "0";
                  document.querySelector(".ttotalpokok1").value = "Rp 0";
                  document.querySelector(".ttotalbunga1").value = "Rp 0";
                  document.querySelector(".pokok1").value = "Rp 0";
                  document.querySelector(".denda").value = "Rp 0";
                  document.getElementById("tabungan_id").value = "";
                  
                  document.querySelector(".ttotalpeminjaman2").value = "Rp 0";
                  document.querySelector(".tpembayaran2").value = "0";
                  document.querySelector(".ttotalpokok2").value = "Rp 0";
                  document.querySelector(".ttotalbunga2").value = "Rp 0";
                  document.querySelector(".pokok2_cicilan").value = "Rp 0";
                  document.querySelector(".denda2").value = "Rp 0";
                  document.getElementById("pinjaman_id").value = "";
                  document.getElementById("pinjaman_id2").value = "";

                    return;
                }

                // Set value ke input
                document.querySelector(".nama_cicilan").value = data.nama_cicilan;
                document.querySelector(".nohp_cicilan").value = data.telepon_cicilan;
                document.querySelector(".ttl_cicilan").value = data.ttl_cicilan;
                document.querySelector(".alamat_cicilan").value = data.alamat_cicilan;
                document.querySelector(".tabungan_cicilan").value = formatRupiah(data.tabungan_cicilan);

                if (!data.pokok1_cicilan) {
                  document.querySelector(".ttotalpeminjaman1").value = "Rp 0";
                  document.querySelector(".tpembayaran1").value = "0";
                  document.querySelector(".ttotalpokok1").value = "Rp 0";
                  document.querySelector(".ttotalbunga1").value = "Rp 0";
                  document.querySelector(".pokok1").value = "Rp 0";
                  document.querySelector(".denda").value = "Rp 0";
                  document.getElementById("tabungan_id").value = "";
                  document.getElementById("pinjaman_id").value = "";
                  btnKirim.disabled = true;
                  btnKirim.classList.add("disabled");
                  alert_kirim.classList.remove("d-none");
                } else {
                    document.querySelector(".ttotalpeminjaman1").value = formatRupiah(data.ttotalpeminjaman1_cicilan);
                    document.querySelector(".tpembayaran1").value = data.tpembayaran1_cicilan;
                    document.querySelector(".ttotalpokok1").value = formatRupiah(data.ttotalpokok1_cicilan);
                    document.querySelector(".ttotalbunga1").value = formatRupiah(data.ttotalbunga1_cicilan);
                    document.querySelector(".pokok1").value = formatRupiah(data.pokok1_cicilan);
                    document.querySelector(".denda").value = formatRupiah(data.denda_cicilan);

                    btnKirim.disabled = false;
                    btnKirim.classList.remove("disabled");
                    alert_kirim.classList.add("d-none");
                }

                if(!data.pokok2_cicilan){
                  document.querySelector(".ttotalpeminjaman2").value = "Rp 0";
                  document.querySelector(".tpembayaran2").value = "0";
                  document.querySelector(".ttotalpokok2").value = "Rp 0";
                  document.querySelector(".ttotalbunga2").value = "Rp 0";
                  document.querySelector(".pokok2_cicilan").value = "Rp 0";
                  document.querySelector(".denda2").value = "Rp 0";
                  document.getElementById("pinjaman_id2").value = "";
                  btnKirim2.disabled = true;
                  btnKirim2.classList.add("disabled");
                  alert_kirim2.classList.remove("d-none");
                }else{
                    document.querySelector(".ttotalpeminjaman2").value = formatRupiah(data.ttotalpeminjaman2_cicilan);
                    document.querySelector(".tpembayaran2").value = data.tpembayaran2_cicilan;
                    document.querySelector(".ttotalpokok2").value = formatRupiah(data.ttotalpokok2_cicilan);
                    document.querySelector(".ttotalbunga2").value = formatRupiah(data.ttotalbunga2_cicilan);
                    document.querySelector(".pokok2_cicilan").value = formatRupiah(data.pokok2_cicilan);
                    document.querySelector(".denda2").value = formatRupiah(data.denda2_cicilan);
                    btnKirim2.disabled = false;
                    btnKirim2.classList.remove("disabled");
                    alert_kirim2.classList.add("d-none");
                }

                document.getElementById("tabungan_id").value = data.id;
                document.getElementById("pinjaman_id").value = data.id;
                document.getElementById("pinjaman_id2").value = data.id;
            });
    } else{
      document.querySelector(".nama_cicilan").value = "";
                  document.querySelector(".nohp_cicilan").value = "";
                  document.querySelector(".ttl_cicilan").value = "";
                  document.querySelector(".alamat_cicilan").value = "";                 
                  document.querySelector(".tabungan_cicilan").value = "Rp 0";
                  document.querySelector(".ttotalpeminjaman1").value = "Rp 0";
                  document.querySelector(".tpembayaran1").value = "0";
                  document.querySelector(".ttotalpokok1").value = "Rp 0";
                  document.querySelector(".ttotalbunga1").value = "Rp 0";
                  document.querySelector(".pokok1").value = "Rp 0";
                  document.querySelector(".denda").value = "Rp 0";
                  document.getElementById("tabungan_id").value = "";
                  document.getElementById("pinjaman_id").value = "";
                  
                  document.querySelector(".ttotalpeminjaman2").value = "Rp 0";
                  document.querySelector(".tpembayaran2").value = "0";
                  document.querySelector(".ttotalpokok2").value = "Rp 0";
                  document.querySelector(".ttotalbunga2").value = "Rp 0";
                  document.querySelector(".pokok2_cicilan").value = "Rp 0";
                  document.querySelector(".denda2").value = "Rp 0";
                  document.getElementById("pinjaman_id2").value = "";
    }
});

        document.getElementById("form-tabungan").addEventListener("submit", function (e) {
        e.preventDefault(); // Hentikan submit default

        let tabungan_cicilan = document.getElementById("tabungan_cicilan").value.trim();
        let nomor = document.getElementById("nomor").value.trim();
        const card = this.querySelector(".card");

        const fields = [
            '.pembayaran-tabungan',
            '.total-tabungan',
            '.tabungan-sebelumnya'
        ];

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
        document.getElementById("form-peminjaman1").addEventListener("submit", function (e) {
        e.preventDefault(); // Hentikan submit default

        let pokok_dibayar = document.getElementById("pokok_dibayar").value.trim();
        let bunga_dibayar = document.getElementById("bunga_dibayar").value.trim();
        let denda_dibayar = document.getElementById("denda").value.trim();
        let jumlah_bayar = document.getElementById("jumlah_bayar").value.trim();
        let nomor = document.getElementById("nomor").value.trim();
        let jenis1 = document.getElementById("jenis1").value;
        const card = this.querySelector(".card");

        const fields = [
            '.pembayaran-pokok',
            '.pembayaran-bunga',
            '.pembayaran-denda',
            '.total-pembayaran',
            '.total-peminjaman1',
            '.pokok-seharusnya1',
            '.pokok1'
        ];

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
        document.getElementById("form-peminjaman2").addEventListener("submit", function (e) {
        e.preventDefault(); // Hentikan submit default

        let pokok_dibayar = document.getElementById("pokok_dibayar2").value.trim();
        let bunga_dibayar = document.getElementById("bunga_dibayar2").value.trim();
        let denda_dibayar = document.getElementById("denda2").value.trim();
        let jumlah_bayar = document.getElementById("jumlah_bayar2").value.trim();
        let nomor = document.getElementById("nomor").value.trim();
        let jenis2 = document.getElementById("jenis2").value;
        const card = this.querySelector(".card");

        const fields = [
            '.pembayaran-pokok',
            '.pembayaran-bunga',
            '.pembayaran-denda',
            '.total-pembayaran',
            '.total-peminjaman2',
            '.pokok-seharusnya2',
            '.pokok2_cicilan'
        ];

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

      // Tambahkan @ json dibawah ini
// const cooldownUntil =  ($cooldownUntil); // waktu dari server (format ISO)//
    
//     if (cooldownUntil) {
//         const endTime = new Date(cooldownUntil).getTime();
//         const startButton = document.getElementById('startButton');
//         const countdownText = document.getElementById('countdownText');

//         const interval = setInterval(() => {
//             const now = new Date().getTime();
//             const distance = endTime - now;

//             if (distance > 0) {
//                 startButton.disabled = true;
//                 const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
//                 const seconds = Math.floor((distance % (1000 * 60)) / 1000);
//                 countdownText.innerText = `Tombol bisa diklik dalam ${minutes}m ${seconds}s`;
//             } else {
//                 startButton.disabled = false;
//                 countdownText.innerText = '';
//                 clearInterval(interval);
//             }
//         }, 1000);
//     }
    </script>
    <script>
document.addEventListener('DOMContentLoaded', function () {
    const resetForm = document.getElementById('resetBungaForm');
    const startButton = document.getElementById('startButton');
    const countdownText = document.getElementById('countdownText');

    if (resetForm && startButton && !startButton.disabled) {
        resetForm.addEventListener('submit', function () {
            // Disable tombol secara visual agar user tahu sudah diproses
            startButton.disabled = true;
            startButton.innerText = 'Memproses...';
            countdownText.innerText = 'Reset telah dilakukan. Tombol akan aktif kembali bulan depan.';
        });
    }
});
</script>
  </body>
</html>
