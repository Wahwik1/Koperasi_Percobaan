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
      <h2 class="header-title">PEMINJAMAN</h2>
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

      <!-- Card Peminjaman -->
      <form id="form-peminjaman" class="formku" action="{{ route('user.Pesan1') }}" method="post">
        @csrf
        <input type="hidden" id="pesan_id" name="pesan_id" value="{{ Auth::user()->id }}">
        <input type="hidden" id="jenis1" name="jenis1" value="Pinjaman Pertama">
        <div class="card mt-4">
          <div class="alert alert-warning @if($pesan1 && $pesan1->jenis1 === 'Pinjaman Pertama') d-flex @else d-none @endif" role="alert">
            <i class="bi bi-clock pe-1"></i>Pesan Sudah Terkirim
          </div>
          <p class="alert alert-success @if($peminjaman1) d-flex @else d-none @endif" role="alert"><i class="bi bi-check-circle pe-1"></i>Sudah Melakukan Pinjaman</p>
          <h5 class="fw-bold">Pinjaman Pertama</h5>
          <p class="alert-text">*Masukkan nilai ke dalam tabel dengan benar</p>
          <div class="row g-3">
            <div class="col-md-4">
              <label class="form-label">Total Peminjaman</label>
              <input type="text" id="ttotalpeminjaman1" name="ttotalpeminjaman1" @if($peminjaman1) disabled @endif @if($pesan1 && $pesan1->jenis1 === 'Pinjaman Pertama') disabled @endif class="form-control total-peminjaman" value="{{ 'Rp. ' . number_format($pesan1pem->ttotalpeminjaman1 ?? 0, 0, ',', '.') ?? 'Rp. ' . number_format($posts1->ttotalpeminjaman1 ?? 0, 0, ',', '.') }}" oninput="hitungPembayaran(this)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Pembayaran</label>
              <input type="text" id="tpembayaran1" name="tpembayaran1" @if($peminjaman1) disabled @endif @if($pesan1 && $pesan1->jenis1 === 'Pinjaman Pertama') disabled @endif class="form-control pembayaran" value="{{ $pesan1pem->tpembayaran1 ?? $posts1->tpembayaran1 ?? '0' }}" oninput="hitungPembayaran(this)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Bunga</label>
              <input type="text" id="tbunga1" name="tbunga1" class="form-control bunga" value="{{ $pesan1pem->tbunga1 ?? $posts1->tbunga1 ?? '0.5' }}" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Total Pokok</label>
              <input type="text" id="ttotalpokok1" name="ttotalpokok1" class="form-control total-pokok" value="{{ 'Rp. ' . number_format($pesan1pem->ttotalpokok1 ?? 0, 0, ',', '.') ?? 'Rp. ' . number_format($posts1->ttotalpokok1 ?? 0, 0, ',', '.') }}" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Total Bunga</label>
              <input type="text" id="ttotalbunga1" name="ttotalbunga1" class="form-control total-bunga" value="{{ 'Rp. ' . number_format($pesan1pem->ttotalbunga1 ?? 0, 0, ',', '.') ?? 'Rp. ' . number_format($posts1->ttotalbunga1 ?? 0, 0, ',', '.') }}" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Total Pembayaran</label>
              <input type="text" id="ttotalpembayaran1" name="ttotalpembayaran1" class="form-control total-pembayaran" value="{{ 'Rp. ' . number_format($pesan1pem->ttotalpembayaran1 ?? 0, 0, ',', '.') ?? 'Rp. ' . number_format($posts1->ttotalpembayaran1 ?? 0, 0, ',', '.') }}" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
            </div>
            <div class="col-md-12">
              <label class="form-label">Deskripsi Keperluan</label>
              <input type="text" name="deskripsi1" @if($peminjaman1) disabled @endif @if($pesan1 && $pesan1->jenis1 === 'Pinjaman Pertama') disabled @endif class="form-control deskripsi-keperluan" id="deskripsi1" value="{{ $pesan1pem->deskripsi1 ?? $posts1->deskripsi1 ?? ' ' }}"/>
            </div>
            <div class="col-md-12">
              <button type="submit" class="btn btn-save form-control pesan1" id="pesan1"
                  @if($peminjaman1) disabled @endif
                  @if($pesan1 && $pesan1->jenis1 === 'Pinjaman Pertama') disabled @endif>
                  <i class="bi bi-check-circle"></i> Save
              </button>
            </div>
            <div class="col-md-12">
              <button type="button" class="btn btn-save form-control peminjaman1" id="peminjaman1"
                @if($peminjaman1 || !$pesan1 || $pesan1->jenis1 === 'Peminjaman Pertama') disabled @endif
                onclick="editPDF1()">
                <i class="fa-solid fa-file-pdf pe-1"></i>Download PDF
              </button>
            </div>
          </div>
        </div>  
      </form>

      <!-- Card Peminjaman 2 -->
      <form id="form-peminjaman2" class="formku" action="{{ route('user.Pesan1') }}" method="post">
        @csrf
        <input type="hidden" id="pesan_id" name="pesan_id" value="{{ Auth::user()->id }}">
        <input type="hidden" id="jenis_form1" name="jenis1" value="Pinjaman Kedua">
        <div class="card mt-4">
          <p class="alert alert-danger @if(!$peminjaman1) d-flex @else d-none @endif" role="alert">
            <i class="bi bi-x-circle pe-1"></i>
            Lakukan Pinjaman Pertama Terlebih Dahulu
          </p>
          <p class="alert alert-success @if($peminjaman2) d-flex @else d-none @endif" role="alert">
            <i class="bi bi-check-circle pe-1"></i>
            Sudah Melakukan Pinjaman
          </p>
          <div class="alert alert-warning @if($pesan2 && $pesan2->jenis1 === 'Pinjaman Kedua') d-flex @else d-none @endif" role="alert">
            <i class="bi bi-clock pe-1"></i>Pesan Sudah Terkirim
        </div>
          <h5 class="fw-bold">Pinjaman Kedua</h5>
          <p class="alert-text">*Masukkan nilai ke dalam tabel dengan benar</p>
          <div class="row g-3">
            <div class="col-md-4">
              <label class="form-label">Total Peminjaman</label>
              <input type="text" id="ttotalpeminjaman2" name="ttotalpeminjaman1" @if(!$peminjaman1) disabled @endif @if($peminjaman2) disabled @endif  @if($pesan2 && $pesan2->jenis1 === 'Pinjaman Kedua') disabled @endif class="form-control total-peminjaman totalpeminjamanPDF" value="{{ 'Rp. ' . number_format($pesan2pem->ttotalpeminjaman1 ?? 0, 0, ',', '.') ?? 'Rp. ' . number_format($posts2->ttotalpeminjaman2 ?? 0, 0, ',', '.') }}" oninput="hitungPembayaran(this)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Pembayaran</label>
              <input type="text" id="tpembayaran2" name="tpembayaran1" @if(!$peminjaman1) disabled @endif @if($peminjaman2) disabled @endif @if($pesan2 && $pesan2->jenis1 === 'Pinjaman Kedua') disabled @endif class="form-control pembayaran pembayaranPDF" value="{{ $pesan2pem->tpembayaran1 ?? $posts2->tpembayaran2 ?? '0' }}" oninput="hitungPembayaran(this)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Bunga</label>
              <input type="text" id="tbunga2" name="tbunga1" class="form-control bunga bungaPDF" value="{{ $pesan2pem->tbunga2 ?? $posts2->tbunga2 ?? '0.5' }}" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Total Pokok</label>
              <input type="text" id="ttotalpokok2" name="ttotalpokok1" class="form-control total-pokok totalpokokPDF" value="{{ 'Rp. ' . number_format($pesan2pem->ttotalpokok1 ?? 0, 0, ',', '.') ?? 'Rp. ' . number_format($posts2->ttotalpokok2 ?? 0, 0, ',', '.') }}" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Total Bunga</label>
              <input type="text" id="ttotalbunga2" name="ttotalbunga1" class="form-control total-bunga totalbungaPDF" value="{{ 'Rp. ' . number_format($pesan2pem->ttotalbunga1 ?? 0, 0, ',', '.') ?? 'Rp. ' . number_format($posts2->ttotalbunga2 ?? 0, 0, ',', '.') }}" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Total Pembayaran</label>
              <input type="text" id="ttotalpembayaran2" name="ttotalpembayaran1" class="form-control total-pembayaran totalpembayaranPDF" value="{{ 'Rp. ' . number_format($pesan2pem->ttotalpembayaran1 ?? 0, 0, ',', '.') ?? 'Rp. ' . number_format($posts2->ttotalpembayaran2 ?? 0, 0, ',', '.') }}" readonly style="background-color: rgba(128, 128, 128, 0.302)" />
            </div>
            <div class="col-md-12">
              <label class="form-label">Deskripsi Keperluan</label>
              <input type="text" name="deskripsi1" @if(!$peminjaman1) disabled @endif @if($peminjaman2) disabled @endif @if($pesan2 && $pesan2->jenis1 === 'Pinjaman Kedua') disabled @endif class="form-control deskripsi-keperluanPDF" id="deskripsi2" required value="{{ $pesan2pem->deskripsi1 ?? $posts2->deskripsi2 ?? ' '}}"/>
            </div>
            <div class="col-md-12">
              <button type="submit" class="btn btn-save form-control pesan1" id="pesan1"
              @if($peminjaman2) disabled @endif
              @if($pesan2 && $pesan2->jenis1 === 'Pinjaman Kedua') disabled @endif
              @if(!$peminjaman1) disabled @endif>
              <i class="bi bi-check-circle"></i> Save
            </button>
          </div>
          <div class="col-md-12">
            <button type="button" class="btn btn-save form-control peminjaman2" id="peminjaman2"
            @if($peminjaman2) disabled @endif
            @if($peminjaman2 || !$pesan2 || $pesan2->jenis1 === 'Peminjaman Kedua') disabled @endif
            onclick="editPDF2()">
            <i class="fa-solid fa-file-pdf pe-1"></i>Download PDF
          </button>
          </div>
          </div>
        </div>
      </div>
    </form>

    <script src="../js/script_user_peminjaman.js"></script>
    <script>
// Peminjaman ke 1
async function editPDF1() {
  const existingPdfBytes = await fetch("../pdf/Form-Pinjaman.pdf").then((res) => res.arrayBuffer());

  // Load PDF menggunakan pdf-lib
  const pdfDoc = await PDFLib.PDFDocument.load(existingPdfBytes);
  const pages = pdfDoc.getPages();
  const firstPage = pages[0];

  // Ambil data dari input form
  let no = document.querySelector(".no").value;
  let nama = document.querySelector(".namalengkap").value;
  let telepon = document.querySelector(".telepon").value;
  let tanggallahir = document.querySelector(".tanggallahir").value;
  let alamat = document.querySelector(".alamat").value;
  let noktp = document.querySelector(".noktp").value;
  let totalPeminjaman = document.querySelector(".total-peminjaman").value;
  let pembayaran = document.querySelector(".pembayaran").value;
  let bunga = document.querySelector(".bunga").value;
  let totalPokok = document.querySelector(".total-pokok").value;
  let totalBunga = document.querySelector(".total-bunga").value;
  let totalPembayaran = document.querySelector(".total-pembayaran").value;
  let deskripsikeperluan = document.querySelector(".deskripsi-keperluan").value;
  let deskripsi = document.getElementById("deskripsi1").value.trim();

  // Tambahkan teks ke dalam PDF
  firstPage.drawText(`${no}`, { x: 205, y: 698, size: 9 });
  firstPage.drawText(`${nama}`, { x: 230, y: 698, size: 9 });
  firstPage.drawText(`${tanggallahir}`, { x: 205, y: 647, size: 9 });
  firstPage.drawText(`${alamat}`, { x: 205, y: 621, size: 9 });
  firstPage.drawText(`${telepon}`, { x: 205, y: 595, size: 9 });
  firstPage.drawText(`${noktp}`, { x: 205, y: 672, size: 9 });
  firstPage.drawText(`${totalPeminjaman}`, { x: 165, y: 533, size: 9 });
  firstPage.drawText(`${pembayaran}`, { x: 175, y: 508, size: 9 });
  firstPage.drawText(`${deskripsikeperluan}`, { x: 165, y: 482, size: 9 });
  firstPage.drawText(`${totalPokok}`, { x: 205, y: 458, size: 9 });
  firstPage.drawText(`${totalBunga}`, { x: 205, y: 432, size: 9 });
  firstPage.drawText(`${totalPembayaran}`, { x: 205, y: 408, size: 9 });

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

// Jangan taruh event listener di dalam fungsi
document.querySelector(".peminjaman1").addEventListener("click", editPDF1);

            // Peminjaman ke 2
        async function editPDF2() {
        const existingPdfBytes = await fetch("../pdf/Form-Pinjaman.pdf").then((res) => res.arrayBuffer());

        // Load PDF menggunakan pdf-lib
        const pdfDoc = await PDFLib.PDFDocument.load(existingPdfBytes);
        const pages = pdfDoc.getPages();
        const firstPage = pages[0];

        // Ambil data dari input form
        let no = document.querySelector(".no").value;
        let nama = document.querySelector(".namalengkap").value;
        let telepon = document.querySelector(".telepon").value;
        let tanggallahir = document.querySelector(".tanggallahir").value;
        let alamat = document.querySelector(".alamat").value;
        let noktp = document.querySelector(".noktp").value;
        let totalPeminjaman = document.querySelector(".totalpeminjamanPDF").value;
        let pembayaran = document.querySelector(".pembayaranPDF").value;
        let bunga = document.querySelector(".bungaPDF").value;
        let totalPokok = document.querySelector(".totalpokokPDF").value;
        let totalBunga = document.querySelector(".totalbungaPDF").value;
        let totalPembayaran = document.querySelector(".totalpembayaranPDF").value;
        let deskripsikeperluan = document.querySelector(".deskripsi-keperluanPDF").value;
        let deskripsi = document.getElementById("deskripsi2").value.trim();
        let disabledpeminjaman = document.getElementById("peminjaman2");
        
                    // Tambahkan teks ke dalam PDF
        firstPage.drawText(`${no}`, { x: 205, y: 698, size: 9 });
        firstPage.drawText(`${nama}`, { x: 230, y: 698, size: 9 });
        firstPage.drawText(`${tanggallahir}`, { x: 205, y: 647, size: 9 });
        firstPage.drawText(`${alamat}`, { x: 205, y: 621, size: 9 });
        firstPage.drawText(`${telepon}`, { x: 205, y: 595, size: 9 });
        firstPage.drawText(`${noktp}`, { x: 205, y: 672, size: 9 });
        firstPage.drawText(`${totalPeminjaman}`, { x: 165, y: 533, size: 9 });
        firstPage.drawText(`${pembayaran}`, { x: 175, y: 508, size: 9 });
        firstPage.drawText(`${deskripsikeperluan}`, { x: 165, y: 482, size: 9 });
        firstPage.drawText(`${totalPokok}`, { x: 205, y: 458, size: 9 });
        firstPage.drawText(`${totalBunga}`, { x: 205, y: 432, size: 9 });
        firstPage.drawText(`${totalPembayaran}`, { x: 205, y: 408, size: 9 });

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
      document.querySelector(".peminjaman2").addEventListener("click", editPDF2);
    </script>
  </body>
</html>
