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


    <!-- Header Peminjaman -->
    <div class="container mt-4">
      <h2 class="header-title">PENARIKAN TABUNGAN</h2>

      <!-- Live Date -->
      <p class="header-date" id="liveDate"></p>

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

      <!-- Penarikan Tabungan -->
    <form id="form-tabungan" class="formku" action="{{ route('user.Pesan1') }}" method="post">
      @csrf
      <input type="hidden" id="pesan_id" name="pesan_id" value="{{ Auth::user()->id }}">
      <input type="hidden" id="jenis1" name="jenis1" value="Penarikan Tabungan">
        <div class="card mt-4">
          <div class="alert alert-warning @if($pesan1 && $pesan1->jenis1 === 'Penarikan Tabungan') d-flex @else d-none @endif" role="alert">
            <i class="bi bi-clock pe-1"></i>Pesan Sudah Terkirim
          </div>
            <h5 class="fw-bold">Penarikan Tabungan</h5>
            <p class="alert-text">*Masukkan nilai ke dalam tabel dengan benar</p>
            <div class="row g-3">
              <div class="col-md-4">
                <label class="form-label">Penarikan Tabungan</label>
                <input type="text" id="penarikantabungan" name="penarikantabungan" @if($pesan1 && $pesan1->jenis1 === 'Penarikan Tabungan') disabled @endif class="form-control penarikan-tabungan penarikantabunganPDF" value="{{ 'Rp. ' . number_format($pesan1pem->penarikantabungan ?? 0, 0, ',', '.') }}" oninput="hitungPembayaran(this)" />
              </div>
              <div class="col-md-4">
                <label class="form-label">Tabungan Saat Ini</label>
                <input type="text" id="tabungansaatini" name="tabungansaatini" class="form-control tabungan-saat-ini tabungansaatiniPDF" value="{{ 'Rp. ' . number_format($tabungan->tabungan ?? 0, 0, ',', '.') }}" readonly style="background-color: rgba(128, 128, 128, 0.302)"/>
              </div>
              <div class="col-md-4">
                <label class="form-label">Sisa Tabungan</label>
                <input type="text" id="sisatabungan" name="sisatabungan" class="form-control sisa-tabungan sisatabunganPDF" readonly style="background-color: rgba(128, 128, 128, 0.302)" value="{{ 'Rp. ' . number_format($pesan1pem->sisatabungan ?? 0, 0, ',', '.') }}" />
              </div>
              <div class="col-md-12">
                <button type="submit" class="btn btn-save form-control pesan1" id="pesan1"
                    @if($pesan1 && $pesan1->jenis1 === 'Penarikan Tabungan') disabled @endif>
                    <i class="bi bi-check-circle"></i> Save
                </button>
              </div>
              <div class="col-md-12">
                <button type="button" class="btn btn-save form-control peminjaman1" id="peminjaman1"
                  @if(!$pesan1 || !$pesan1->jenis1 === 'Penarikan Tabungan') disabled @endif
                  onclick="editPDF()">
                  <i class="fa-solid fa-file-pdf pe-1"></i>Download PDF
                </button>
              </div>
            </div>
          </div>
    </form>
</div>

    <script>
      function realtimedate() {
        let liveDateInterval; // Variabel untuk menyimpan interval

        // Fungsi untuk mengupdate tanggal real-time
        function updateLiveDate() {
          const now = new Date();
          const options = { day: "numeric", month: "long", year: "numeric" };
          document.getElementById("liveDate").textContent = now.toLocaleDateString("id-ID", options);
        }
        // Mulai interval untuk update real-time setiap detik
        liveDateInterval = setInterval(updateLiveDate, 1000);

        // Event listener untuk perubahan pada input date
        document.getElementById("datePicker");
      }

      console.log(realtimedate());

      document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".penarikan-tabungan").forEach(function (input) {
          input.addEventListener("input", function (e) {
            let value = e.target.value.replace(/[^0-9]/g, ""); // Hanya angka
            if (value) {
              e.target.value = "Rp. " + parseInt(value).toLocaleString(); // Format dengan Rp.
            } else {
              e.target.value = ""; // Kosongkan jika tidak ada angka
            }
          });
        });
      });
      document.querySelector(".hamburger").addEventListener("click", function () {
        document.querySelector(".sidebar").classList.toggle("show");
      });
      function hitungPembayaran(input) {
        let card = input.closest(".card");
        let penarikantabungan = parseFloat(card.querySelector(".penarikan-tabungan").value.replace(/[^0-9]/g, "")) || 0;
        let tabungansaatini = parseFloat(card.querySelector(".tabungan-saat-ini").value.replace(/[^0-9]/g, "")) || 0;

        let totaltabungan = tabungansaatini - penarikantabungan;

        card.querySelector(".sisa-tabungan").value = `Rp. ${totaltabungan.toLocaleString()}`;
      }

      document.getElementById("form-tabungan").addEventListener("submit", function (e) {
        e.preventDefault(); // Hentikan submit default

        let penarikantabungan = document.getElementById("penarikantabungan").value.replace(/[^0-9]/g, "");
        let tabungansaatini = document.getElementById("tabungansaatini").value.replace(/[^0-9]/g, "");
        let sisatabungan = document.getElementById("sisatabungan").value.replace(/[^0-9]/g, "");
        
        const card = this.querySelector(".card");

        const fields = [
            ".penarikan-tabungan",
            ".tabungan-saat-ini",
            ".sisa-tabungan",
        ];

        if(penarikantabungan == 0){
          Swal.fire({
                icon: "error",
                title: "Mohon Isi Penarikan Terlebih Dahulu",
                text: "Silahkan isi ulang kolom"
            });
            return;
        }

        if (parseInt(penarikantabungan) > parseInt(tabungansaatini) ) {
            Swal.fire({
                icon: "error",
                title: "Tabungan Kurang",
                text: "Mohon Isi Kolom Dengan Benar",
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
                fields.forEach((selector) => {
                    const input = card.querySelector(selector);
                    if (input) {
                        input.value = input.value.replace(/[^0-9]/g, ""); // hapus Rp. dan ,
                    }
                });
                this.submit();
            }
        });
    });


      // Proses Pembuatan PDF
      async function editPDF() {
  const existingPdfBytes = await fetch("../pdf/Penarikan-Tabungan.pdf").then((res) => res.arrayBuffer());

  // Load PDF menggunakan pdf-lib
  const pdfDoc = await PDFLib.PDFDocument.load(existingPdfBytes);
  const pages = pdfDoc.getPages();
  const firstPage = pages[0];

  // Ambil data dari input form
  let no = document.querySelector(".no").value;
  let nama = document.querySelector(".namalengkap").value;
  let penarikantabungan1 = parseFloat(document.querySelector(".penarikantabunganPDF").value.replace(/[^0-9]/g, "")) || 0;
  let tabunganawal1 = parseFloat(document.querySelector(".tabungansaatiniPDF").value.replace(/[^0-9]/g, "")) || 0;
  let sisatabungan1 = document.querySelector(".sisatabunganPDF").value;
  let livedate = document.querySelector(".header-date").textContent;
      // Tambahkan teks ke dalam PDF
      firstPage.drawText(`${no}`, { x: 90, y: 716, size: 9 });
      firstPage.drawText(`${nama}`, { x: 170, y: 713, size: 9 });
      firstPage.drawText(`Rp. ${tabunganawal1.toLocaleString("id-ID")}`, { x: 150, y: 688, size: 9 });
      firstPage.drawText(`Rp. ${penarikantabungan1.toLocaleString("id-ID")}`, { x: 150, y: 670, size: 9 });
      firstPage.drawText(`${sisatabungan1}`, { x: 150, y: 650, size: 9 });
      firstPage.drawText(`Rp. ${penarikantabungan1.toLocaleString("id-ID")}`, { x: 150, y: 593, size: 9 });
      firstPage.drawText(`${livedate}`, { x: 393, y: 631, size: 9 });

      const pdfBytes = await pdfDoc.save();
      const blob = new Blob([pdfBytes], { type: "application/pdf" });
      const blobUrl = URL.createObjectURL(blob);

      // Cetak otomatis menggunakan iframe tersembunyi
      const iframe = document.createElement("iframe");
      iframe.style.display = "none";
      iframe.src = blobUrl;
      document.body.appendChild(iframe);
      iframe.onload = function () {
        iframe.contentWindow.focus();
        iframe.contentWindow.print();
      };
}
      // Event listener untuk tombol Simpan PDF
      document.querySelector(".penarikantabungan").addEventListener("click", editPDF);
    </script>
  </body>
</html>
