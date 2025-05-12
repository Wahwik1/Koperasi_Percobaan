@include('layout.admin_header')
@include('layout.admin_navbar')


    @if (session('success-edit'))
    <script>
      Swal.fire({
          title: "Berhasil Di Edit",
          text: "Mohon Silahkan Dicek",
          icon: "success",
      });
    </script>
    @endif

    <!-- Header Peminjaman -->
    <div class="container mt-4">
      <h2 class="header-title">EDIT PEMBAYARAN PESERTA</h2>

      <!-- Tanggal  -->
      <input type="date" id="datePicker" class="date-input" />
      <p class="header-date" id="liveDate"></p>
      <p class="alert-text header-title fw-medium fs-9">*Pilih Tanggal Terlebih Dahulu</p>

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
            <input type="text" class="form-control namalengkap nama_edit" value="" readonly placeholder="Terisi Otomatis"/>
          </div>
          <div class="col-md-6">
            <label class="form-label">Nomor Telepon :</label>
            <input type="text" class="form-control telepon nohp_edit" value="" readonly placeholder="Terisi Otomatis"/>
          </div>
          <div class="col-md-6">
            <label class="form-label">Tempat, Tanggal Lahir :</label>
            <input type="text" class="form-control tanggallahir ttl_edit" value="" readonly placeholder="Terisi Otomatis"/>
          </div>
          <div class="col-md-6">
            <label class="form-label">Alamat :</label>
            <input type="text" class="form-control alamat alamat_edit" value="" readonly placeholder="Terisi Otomatis"/>
          </div>
        </div>
      </div>

      {{-- Tabungan --}}
      <form class="formku" id="form-tabungan" action="{{ route('peminjaman.updateByDateTabungan') }}" method="post">
        @csrf
        <input type="hidden" id="tabungan_id" name="tabungan_id">
        <input type="hidden" name="tanggal" id="tanggal-hidden-tabungan">
        <div class="card mt-4">
          <div class="row align-self-end buttonedit">
            <div class="col-12">
              <button type="button" class="form-control btn btn-save mt-3 edittabungan" id="edittabungan"><i class="fa-regular fa-pen-to-square"></i></button>
            </div>
          </div>
          <h5 class="fw-bold">Tabungan</h5>
          <p class="alert-text">*Masukkan nilai ke dalam tabel dengan benar</p>
          <div class="row g-3">
            <div class="col-md-12">
              <label class="form-label">Ubah Tabungan</label>
              <input name="tabungan" id="tabungan_edit" type="text" class="form-control pembayaran-tabungan pembayaran-tabungan-penambahan pembayaran-tabungan-background tabungan_edit" readonly value="Rp. 0" oninput="hitungPembayaranTabungan(this)" />
            </div>
          </div>
          <div class="col-md-12">
            <button type="submit" class="form-control btn btn-save mt-3 tombolpembayarantabungan disabled" id="tombolpembayarantabungan"><i class="fa-regular fa-circle-check"></i> Save</button>
          </div>
        </div>
      </form>

      <!-- Card Peminjaman -->
      <form class="formku" id="form-peminjaman1" action="{{ route('peminjaman.updateByDate') }}" method="post">
        @csrf
        <input type="hidden" id="pinjaman_id" name="pinjaman_id">
        <input type="hidden" name="tanggal" id="tanggal-hidden">
        <div class="card mt-4">
          <div class="row align-self-end buttonedit">
            <div class="col-12">
              <button type="button" class="form-control btn btn-save mt-3 editpeminjaman1" id="editpeminjaman1"><i class="fa-regular fa-pen-to-square"></i></button>
            </div>
          </div>
          <h5 class="fw-bold">Peminjaman Pertama</h5>
          <p class="alert-text">*Masukkan nilai ke dalam tabel dengan benar</p>
          <div class="row g-3">
            <div class="col-md-4">
              <label class="form-label">Pembayaran Pokok</label>
              <input type="text" name="pokok_dibayar" id="pokok_dibayar" class="form-control pembayaran-pokok pembayaran-pokok1 pembayaran-pokok-background1 pokok_dibayar" value="Rp. 0" readonly/>
            </div>
            <div class="col-md-4">
              <label class="form-label">Pembayaran Bunga</label>
              <input type="text" name="ttotalbunga1" id="bunga_dibayar" class="form-control pembayaran-bunga pembayaran-bunga1 pembayaran-bunga-background1 ttotalbunga1" readonly value="Rp. 0"/>
            </div>
            <div class="col-md-4">
              <label class="form-label">Pembayaran Denda</label>
              <input type="text" name="denda" id="denda" class="form-control pembayaran-denda pembayaran-denda1 pembayaran-denda-background1 denda" readonly value="Rp. 0"/>
            </div>
            <div class="col-md-4">
              <label class="form-label">Total Peminjaman</label>
              <input type="text" name="ttotalpeminjaman1" id="ttotalpeminjaman1" class="form-control total-peminjaman total-peminjaman1 total-peminjaman-background1 ttotalpeminjaman1" value="Rp. 0" readonly/>
            </div>
            <div class="col-md-4">
              <label class="form-label">Pembayaran</label>
              <input type="text" name="tpembayaran1" id="tpembayaran1" class="form-control pembayaran pembayaran1 pembayaran-background1 tpembayaran1" value="0" readonly/>
            </div>
            <div class="col-md-4">
              <label class="form-label">Pokok Seharusnya</label>
              <input type="text" name="ttotalpokok1" id="ttotalpokok1" class="form-control pokok-seharusnya pokok-seharusnya1 pokok-seharusnya-background1 ttotalpokok1" readonly value="Rp. 0"/>
            </div>
            <div class="col-md-4">
              <label class="form-label">Sisa Pokok</label>
              <input type="text" name="pokok1" id="pokok1" class="form-control sisa-pokok sisa-pokok1 sisa-pokok-background1 pokok1" readonly value="Rp. 0"/>
            </div>
            <div class="col-md-4">
              <label class="form-label">Total Pembayaran</label>
              <input type="text" name="jumlah_bayar" id="jumlah_bayar" class="form-control total-pembayaran total-pembayaran1 total-pembayaran-background1 jumlah_pembayaran" value="Rp. 0" readonly/>
            </div>
  
            <div class="col-md-12">
              <button type="submit" class="form-control btn btn-save mt-3 peminjaman1 btn-kirim disabled" id="peminjaman1"><i class="fa-regular fa-circle-check"></i> Save</button>
            </div>
          </div>
        </div>
      </form>

      <!-- Card Peminjaman 2 -->
       <form class="formku" id="form-peminjaman2" action="{{ route('peminjaman.updateByDate2') }}" method="post">
        @csrf
        <input type="hidden" id="pinjaman_id2" name="pinjaman_id">
        <input type="hidden" name="tanggal" id="tanggal-hidden2">
        <div class="card mt-4">
          <div class="row align-self-end buttonedit">
            <div class="col-12">
              <button type="button" class="form-control btn btn-save mt-3 editpeminjaman2" id="editpeminjaman2"><i class="fa-regular fa-pen-to-square"></i></button>
            </div>
          </div>
          <h5 class="fw-bold">Peminjaman Kedua</h5>
          <p class="alert-text">*Masukkan nilai ke dalam tabel dengan benar</p>
          <div class="row g-3">
            <div class="col-md-4">
              <label class="form-label">Pembayaran Pokok</label>
              <input type="text" name="pokok_dibayar2" id="pokok_dibayar2" class="form-control pembayaran-pokok pembayaran-pokok2 pembayaran-pokok-background2 pokok_dibayar2" value="Rp. 0" readonly/>
            </div>
            <div class="col-md-4">
              <label class="form-label">Pembayaran Bunga</label>
              <input type="text" name="ttotalbunga2" id="bunga_dibayar2" class="form-control pembayaran-bunga pembayaran-bunga2 pembayaran-bunga-background2 ttotalbunga2" readonly value="Rp. 0"/>
            </div>
            <div class="col-md-4">
              <label class="form-label">Pembayaran Denda</label>
              <input type="text" name="denda2" id="denda2" class="form-control pembayaran-denda pembayaran-denda2 pembayaran-denda-background2 denda2" readonly value="Rp. 0"/>
            </div>
            <div class="col-md-4">
              <label class="form-label">Total Peminjaman</label>
              <input type="text" name="ttotalpeminjaman2" id="ttotalpeminjaman2" class="form-control total-peminjaman total-peminjaman2 total-peminjaman-background2 ttotalpeminjaman2" value="Rp. " readonly/>
            </div>
            <div class="col-md-4">
              <label class="form-label">Pembayaran</label>
              <input type="text" name="tpembayaran2" id="tpembayaran2" class="form-control pembayaran pembayaran2 pembayaran-background2 tpembayaran2" value="0" readonly/>
            </div>
            <div class="col-md-4">
              <label class="form-label">Pokok Seharusnya</label>
              <input type="text" name="ttotalpokok2" id="ttotalpokok2" class="form-control pokok-seharusnya pokok-seharusnya2 pokok-seharusnya-background2 ttotalpokok2" readonly value="Rp. 0"/>
            </div>
            <div class="col-md-4">
              <label class="form-label">Sisa Pokok</label>
              <input type="text" name="pokok2_edit" id="pokok2_edit" class="form-control sisa-pokok sisa-pokok2 sisa-pokok-background2 pokok2_edit" readonly value="Rp. 0"/>
            </div>
            <div class="col-md-4">
              <label class="form-label">Total Pembayaran</label>
              <input type="text" name="jumlah_bayar2" id="jumlah_bayar2" class="form-control total-pembayaran total-pembayaran1 total-pembayaran-background2 jumlah_pembayaran2" value="Rp. 0" readonly/>
            </div>
        
            <div class="col-md-12">
              <button type="submit" class="form-control btn btn-save mt-3 peminjaman2 disabled" id="peminjaman2"><i class="fa-regular fa-circle-check"></i> Save</button>
            </div>
          </div>
        </div>
        </form>
    </div>
    <script src="../js/script_edit_admin.js"></script>
    <script>


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
    const tanggal = document.getElementById('datePicker').value; // ambil tanggal dari datePicker

    if (nomor.length > 0 && tanggal.length > 0) {
        fetch(`/search-user-edit?id=${nomor}&tanggal=${tanggal}`)
            .then((response) => response.json())
            .then((data) => {
                if (data.error) {
                    document.querySelector(".nama_edit").value = "";
                    document.querySelector(".nohp_edit").value = "";
                    document.querySelector(".ttl_edit").value = "";
                    document.querySelector(".alamat_edit").value = "";

                    document.querySelector(".ttotalpeminjaman1").value = "Rp 0";
                    document.querySelector(".tpembayaran1").value = "0";
                    document.querySelector(".ttotalpokok1").value = "Rp 0";
                    document.querySelector(".ttotalbunga1").value = "Rp 0";
                    document.querySelector(".pokok1").value = "Rp 0";
                    document.querySelector(".denda").value = "Rp 0";
                    document.querySelector(".jumlah_pembayaran").value = "Rp 0";

                    document.querySelector(".ttotalpeminjaman2").value = "Rp 0";
                    document.querySelector(".tpembayaran2").value = "0";
                    document.querySelector(".ttotalpokok2").value = "Rp 0";
                    document.querySelector(".ttotalbunga2").value = "Rp 0";
                    document.querySelector(".pokok2_edit").value = "Rp 0";
                    document.querySelector(".denda2").value = "Rp 0";
                    document.querySelector(".jumlah_pembayaran2").value = "Rp 0";

                    document.querySelector(".tabungan_edit").value = "Rp 0";

                    document.getElementById("pinjaman_id").value = "";
                    document.getElementById("pinjaman_id2").value = "";
                    document.getElementById("tabungan_id").value = "";

                    return;
                }

                document.querySelector(".nama_edit").value = data.nama_edit;
                document.querySelector(".nohp_edit").value = data.telepon_edit;
                document.querySelector(".ttl_edit").value = data.ttl_edit;
                document.querySelector(".alamat_edit").value = data.alamat_edit;

                if (!data.pokok1_edit) {
                    document.querySelector(".ttotalpeminjaman1").value = "Rp 0";
                    document.querySelector(".tpembayaran1").value = "0";
                    document.querySelector(".ttotalpokok1").value = "Rp 0";
                    document.querySelector(".ttotalbunga1").value = "Rp 0";
                    document.querySelector(".pokok1").value = "Rp 0";
                    document.querySelector(".denda").value = "Rp 0";
                    document.querySelector(".jumlah_pembayaran").value = "Rp 0";
                    document.getElementById("pinjaman_id").value = "";
                } else {
                    document.querySelector(".ttotalpeminjaman1").value = formatRupiah(data.ttotalpeminjaman1_edit);
                    document.querySelector(".tpembayaran1").value = data.tpembayaran1_edit;
                    document.querySelector(".ttotalpokok1").value = formatRupiah(data.ttotalpokok1_edit);
                    document.querySelector(".ttotalbunga1").value = formatRupiah(data.ttotalbunga1_edit);
                    document.querySelector(".pokok1").value = formatRupiah(data.pokok1_edit);
                    document.querySelector(".denda").value = formatRupiah(data.denda_edit);
                    document.querySelector(".jumlah_pembayaran").value = formatRupiah(data.jumlah_pembayaran);
                }

                if (!data.pokok2_edit) {
                    document.querySelector(".ttotalpeminjaman2").value = "Rp 0";
                    document.querySelector(".tpembayaran2").value = "0";
                    document.querySelector(".ttotalpokok2").value = "Rp 0";
                    document.querySelector(".ttotalbunga2").value = "Rp 0";
                    document.querySelector(".pokok2_edit").value = "Rp 0";
                    document.querySelector(".denda2").value = "Rp 0";
                    document.querySelector(".jumlah_pembayaran2").value = "Rp 0";
                    document.getElementById("pinjaman_id2").value = "";
                } else {
                    document.querySelector(".ttotalpeminjaman2").value = formatRupiah(data.ttotalpeminjaman2_edit);
                    document.querySelector(".tpembayaran2").value = data.tpembayaran2_edit;
                    document.querySelector(".ttotalpokok2").value = formatRupiah(data.ttotalpokok2_edit);
                    document.querySelector(".ttotalbunga2").value = formatRupiah(data.ttotalbunga2_edit);
                    document.querySelector(".pokok2_edit").value = formatRupiah(data.pokok2_edit);
                    document.querySelector(".denda2").value = formatRupiah(data.denda2_edit);
                    document.querySelector(".jumlah_pembayaran2").value = formatRupiah(data.jumlah_pembayaran2);
                }

                document.querySelector(".tabungan_edit").value = formatRupiah(data.tabungan_edit);

                document.getElementById("pinjaman_id").value = data.id;
                document.getElementById("pinjaman_id2").value = data.id;
                document.getElementById("tabungan_id").value = data.id;
            });
    }
});

document.getElementById("form-peminjaman1").addEventListener("submit", function (e) {
    e.preventDefault();

    const form = this; // simpan referensi form
    let selectedDate = document.getElementById('datePicker').value;
    document.getElementById('tanggal-hidden').value = selectedDate;

    let pokok_dibayar = document.getElementById("pokok_dibayar").value.trim();
    let bunga_dibayar = document.getElementById("bunga_dibayar").value.trim();
    let ttotalpokok1 = document.getElementById("ttotalpokok1").value.trim();
    let ttotalpeminjaman1 = document.getElementById("ttotalpeminjaman1").value.trim();
    let pokok1 = document.getElementById("pokok1").value.trim();
    let tpembayaran1 = document.getElementById("tpembayaran1").value.trim();
    let denda = document.getElementById("denda").value.trim();
    let jumlah_bayar = document.getElementById("jumlah_bayar").value.trim();

    Swal.fire({
        title: "Apakah Kamu Yakin?",
        text: "Data akan diperbarui!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, Update!",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            pokok_dibayar = pokok_dibayar.replace(/[^0-9]/g, '');
            bunga_dibayar = bunga_dibayar.replace(/[^0-9]/g, '');
            ttotalpeminjaman1 = ttotalpeminjaman1.replace(/[^0-9]/g, '');
            ttotalpokok1 = ttotalpokok1.replace(/[^0-9]/g, '');
            pokok1 = pokok1.replace(/[^0-9]/g, '');
            tpembayaran1 = tpembayaran1.replace(/[^0-9]/g, '');
            denda = denda.replace(/[^0-9]/g, '');
            jumlah_bayar = jumlah_bayar.replace(/[^0-9]/g, '');

            document.getElementById("pokok_dibayar").value = pokok_dibayar;
            document.getElementById("bunga_dibayar").value = bunga_dibayar;
            document.getElementById("ttotalpeminjaman1").value = ttotalpeminjaman1;
            document.getElementById("ttotalpokok1").value = ttotalpokok1;
            document.getElementById("pokok1").value = pokok1;
            document.getElementById("tpembayaran1").value = tpembayaran1;
            document.getElementById("denda").value = denda;
            document.getElementById("jumlah_bayar").value = jumlah_bayar;

            form.submit(); // submit form yang benar
        }
    });
});

document.getElementById("form-peminjaman2").addEventListener("submit", function (e) {
    e.preventDefault();

    const form = this; // simpan referensi form
    let selectedDate = document.getElementById('datePicker').value;
    document.getElementById('tanggal-hidden2').value = selectedDate;

    let pokok_dibayar2 = document.getElementById("pokok_dibayar2").value.trim();
    let bunga_dibayar2 = document.getElementById("bunga_dibayar2").value.trim();
    let ttotalpokok2 = document.getElementById("ttotalpokok2").value.trim();
    let ttotalpeminjaman2 = document.getElementById("ttotalpeminjaman2").value.trim();
    let pokok2_edit = document.getElementById("pokok2_edit").value.trim();
    let tpembayaran2 = document.getElementById("tpembayaran2").value.trim();
    let denda2 = document.getElementById("denda2").value.trim();
    let jumlah_bayar2 = document.getElementById("jumlah_bayar2").value.trim();

    Swal.fire({
        title: "Apakah Kamu Yakin?",
        text: "Data akan diperbarui!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, Update!",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            pokok_dibayar2 = pokok_dibayar2.replace(/[^0-9]/g, '');
            bunga_dibayar2 = bunga_dibayar2.replace(/[^0-9]/g, '');
            ttotalpeminjaman2 = ttotalpeminjaman2.replace(/[^0-9]/g, '');
            ttotalpokok2 = ttotalpokok2.replace(/[^0-9]/g, '');
            pokok2_edit = pokok2_edit.replace(/[^0-9]/g, '');
            tpembayaran2 = tpembayaran2.replace(/[^0-9]/g, '');
            denda2 = denda2.replace(/[^0-9]/g, '');
            jumlah_bayar2 = jumlah_bayar2.replace(/[^0-9]/g, '');

            document.getElementById("pokok_dibayar2").value = pokok_dibayar2;
            document.getElementById("bunga_dibayar2").value = bunga_dibayar2;
            document.getElementById("ttotalpeminjaman2").value = ttotalpeminjaman2;
            document.getElementById("ttotalpokok2").value = ttotalpokok2;
            document.getElementById("pokok2_edit").value = pokok2_edit;
            document.getElementById("tpembayaran2").value = tpembayaran2;
            document.getElementById("denda2").value = denda2;
            document.getElementById("jumlah_bayar2").value = jumlah_bayar2;

            form.submit(); // submit form yang benar
        }
    });
});

document.getElementById("form-tabungan").addEventListener("submit", function (e) {
    e.preventDefault();

    const form = this; // simpan referensi form
    let selectedDate = document.getElementById('datePicker').value;
    document.getElementById('tanggal-hidden-tabungan').value = selectedDate;

    let tabungan_edit = document.getElementById("tabungan_edit").value.trim();

    Swal.fire({
        title: "Apakah Kamu Yakin?",
        text: "Data akan diperbarui!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, Update!",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            tabungan_edit = tabungan_edit.replace(/[^0-9]/g, '');

            document.getElementById("tabungan_edit").value = tabungan_edit;
 

            form.submit(); // submit form yang benar
        }
    });
});

    </script>
  </body>
</html>
