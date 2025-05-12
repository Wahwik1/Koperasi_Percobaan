@include('layout.admin_header')
@include('layout.admin_navbar')

    @if (session('success-update'))
    <script>
    Swal.fire({
        title: "Peminjaman Berhasil",
        text: "Silahkan Di Cek",
        icon: "success",
    });
    </script>
    @endif

    @if (session('success-tabungan'))
    <script>
    Swal.fire({
        title: "Penarikan Tabungan Berhasil",
        text: "Silahkan Di Cek",
        icon: "success",
    });
    </script>
    @endif

    @if (session('success-delete'))
    <script>
    Swal.fire({
        title: "Data Berhasil Di Hapus",
        text: "Silahkan Dicek !",
        icon: "success",
    });
    </script>
    @endif

<div class="container mt-5">
    <h2 class="text-center fw-bold">TABEL PESAN</h2>
    <div class="div mt-5">
        <div class="mb-3 text-center">
            <input type="text" id="customSearchBox" class="form-control" placeholder="Cari data pengguna...">
          </div>
        <div class="text-center">
            <table class="table table-bordered" id="paymentTable">
                <thead>
                    <tr class="table-dark">
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>TANGGAL</th>
                        <th class="d-none d-md-table-cell">TOTAL PEMINJAMAN</th>
                        <th class="d-none d-md-table-cell">JENIS PEMINJAMAN</th>
                        <th class="d-none d-xxl-table-cell">BERAPA KALI PINJAMAN</th>
                        <th class="d-none d-md-table-cell">PENARIKAN TABUNGAN</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody id="userTable">
                    @foreach ($posts as $no => $post)
                    <tr>
                        <td>{{ $no + 1 }}</td>
                        <td>{{ $post->pesan1->name }}</td>
                        <td>{{ $post->created_at->format('d M Y') }}</td>
                        <td class="d-none d-md-table-cell">{{ 'Rp. ' . number_format($post->ttotalpeminjaman1 ?? 0, 0, ',', '.') }}</td>
                        <td class="d-none d-md-table-cell">{{ $post->jenis1 }}</td>
                        <td class="d-none d-lg-table-cell">{{ $post->tpembayaran1 }}</td>
                        <td class="d-none d-md-table-cell">{{ 'Rp. ' . number_format($post->penarikantabungan ?? 0, 0, ',', '.') }}</td>
                        <td style="width:100px">
                            <div class="d-flex justify-content-between">
                                @if($post->jenis1 === 'Penarikan Tabungan')
                                <a href="#"
                                   class="btn btn-primary btn-sm"
                                   data-bs-toggle="modal"
                                   data-bs-target="#exampleModalTabungan"
                                   data-id="{{ $post->pesan1->id }}"
                                   data-pesan_id="{{ $post->pesan_id }}"
                                   data-jenis1="{{ $post->jenis1 }}"
                                   data-penarikantabungan="{{ $post->penarikantabungan }}"
                                   data-tabungansaatini="{{ $post->tabungansaatini }}"
                                   data-sisatabungan="{{ $post->sisatabungan }}"

                                >
                                <i class="fas fa-edit"></i>
                                </a>
                                @else
                                <a href="#"
                                   class="btn btn-primary btn-sm"
                                   data-bs-toggle="modal"
                                   data-bs-target="#exampleModal"
                                   data-id="{{ $post->pesan1->id }}"
                                   data-pesan_id="{{ $post->pesan_id }}"
                                   data-jenis1="{{ $post->jenis1 }}"
                                   data-ttotalpeminjaman1="{{ $post->ttotalpeminjaman1 }}"
                                   data-tpembayaran1="{{ $post->tpembayaran1 }}"
                                   data-tbunga1="{{ $post->tbunga1 }}"
                                   data-ttotalpokok1="{{ $post->ttotalpokok1 }}"
                                   data-ttotalbunga1="{{ $post->ttotalbunga1 }}"
                                   data-ttotalpembayaran1="{{ $post->ttotalpembayaran1 }}"
                                   data-deskripsi1="{{ $post->deskripsi1 }}"
                                >
                                    <i class="fas fa-edit"></i>
                                </a>
                                @endif
                                <form class="form-hapus" action="{{ route('delete.pesan', $post->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="form-peminjaman" action="{{ route('admin.PindahPinjaman') }}" method="POST">
        @csrf
        <input type="hidden" id="modal-pesan_id" name="pinjaman_id">
        <div class="modal-header">
            <h5 class="modal-title">Tabel Peminjaman Anggota</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" class="form-control" id="modal-id" readonly>
            <div class="mb-3"><label>Jenis</label><input type="text" class="form-control" id="modal-jenis1" name="jenis1" readonly></div>
            <div class="mb-3"><label>Total Peminjaman</label><input type="text" class="form-control" id="modal-ttotalpeminjaman1" name="ttotalpeminjaman1" readonly></div>
            <div class="mb-3"><label>Cicilan</label><input type="text" class="form-control" id="modal-tpembayaran1" name="tpembayaran1" readonly></div>
            <div class="mb-3"><label>Bunga</label><input type="text" class="form-control" id="modal-tbunga1" name="tbunga1" readonly></div>
            <div class="mb-3"><label>Total Pokok</label><input type="text" class="form-control" id="modal-ttotalpokok1" name="ttotalpokok1" readonly></div>
            <div class="mb-3"><label>Total Bunga</label><input type="text" class="form-control" id="modal-ttotalbunga1" name="ttotalbunga1" readonly></div>
            <div class="mb-3"><label>Total Pembayaran</label><input type="text" class="form-control" id="modal-ttotalpembayaran1" name="ttotalpembayaran1" readonly></div>
            <div class="mb-3"><label>Deskripsi</label><input type="text" class="form-control" id="modal-deskripsi1" name="deskripsi1" readonly></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary" id="btn-simpan">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Tabungan -->
<div class="modal fade" id="exampleModalTabungan" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="form-tabungan" action="{{ route('admin.PindahPinjaman') }}" method="POST">
        @csrf
        <input type="hidden" id="modal-pesan_idtabungan" name="pinjaman_id">
        <div class="modal-header">  
            <h5 class="modal-title">Penarikan Tabungan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" class="form-control" id="modal-id" readonly>
            <div class="mb-3"><label>Jenis</label><input type="text" class="form-control" id="modal-jenistabungan" name="jenis1" readonly></div>
            <div class="mb-3"><label>Penarikan Tabungan</label><input type="text" class="form-control" id="modal-penarikantabungan" name="penarikantabungan" readonly></div>
            <div class="mb-3"><label>Tabungan Saat Ini</label><input type="text" class="form-control" id="modal-tabungansaatini" name="tabungansaatini" readonly></div>
            <div class="mb-3"><label>Sisa Tabungan</label><input type="text" class="form-control" id="modal-sisatabungan" name="sisatabungan" readonly></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary" id="btn-simpan">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
<script src="../js/script_tabel_anggota_admin.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.min.js" integrity="sha384-VQqxDN0EQCkWoxt/0vsQvZswzTHUVOImccYmSyhJTp7kGtPed0Qcx8rK9h9YEgx+" crossorigin="anonymous"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {
    // Pastikan hanya satu instance DataTable
    var table = $("#paymentTable").DataTable({
        // Optional: Nonaktifkan search bawaan
        dom: 't<"bottom"p>',
    });

    // Hubungkan custom search box
    $("#customSearchBox").on("keyup", function () {
        table.search(this.value).draw();
    });
});
</script>
<script>
function formatRupiah(angka) {
    const number = parseFloat(angka);
    if (isNaN(number)) return 'Rp. 0';
    return 'Rp. ' + number.toLocaleString('id-ID');
}

function unformatRupiah(rupiah) {
    return parseInt(rupiah.replace(/[^0-9]/g, '')) || 0;
}

const modal = document.getElementById('exampleModal');
modal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;

    // Isi data ke form modal
    document.getElementById('modal-id').value = button.getAttribute('data-id');
    document.getElementById('modal-pesan_id').value = button.getAttribute('data-pesan_id');
    document.getElementById('modal-jenis1').value = button.getAttribute('data-jenis1');
    document.getElementById('modal-ttotalpeminjaman1').value = formatRupiah(button.getAttribute('data-ttotalpeminjaman1'));
    document.getElementById('modal-tpembayaran1').value = button.getAttribute('data-tpembayaran1');
    document.getElementById('modal-tbunga1').value = button.getAttribute('data-tbunga1');
    document.getElementById('modal-ttotalpokok1').value = formatRupiah(button.getAttribute('data-ttotalpokok1'));
    document.getElementById('modal-ttotalbunga1').value = formatRupiah(button.getAttribute('data-ttotalbunga1'));
    document.getElementById('modal-ttotalpembayaran1').value = formatRupiah(button.getAttribute('data-ttotalpembayaran1'));
    document.getElementById('modal-deskripsi1').value = button.getAttribute('data-deskripsi1');
    const jenis = button.getAttribute('data-jenis1');

    const btnSimpan = document.getElementById('btn-simpan');
    const textPeminjaman = document.getElementById('text-peminjaman');

});

const modal1 = document.getElementById('exampleModalTabungan');
modal1.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;

    // Isi data ke form modal
    document.getElementById('modal-id').value = button.getAttribute('data-id');
    document.getElementById('modal-pesan_idtabungan').value = button.getAttribute('data-pesan_id');
    document.getElementById('modal-jenistabungan').value = button.getAttribute('data-jenis1');
    document.getElementById('modal-penarikantabungan').value = formatRupiah(button.getAttribute('data-penarikantabungan'));
    document.getElementById('modal-tabungansaatini').value = formatRupiah(button.getAttribute('data-tabungansaatini'));
    document.getElementById('modal-sisatabungan').value = formatRupiah(button.getAttribute('data-sisatabungan'));

    const jenis = button.getAttribute('data-jenis1');

    const btnSimpan = document.getElementById('btn-simpan');
    const textPeminjaman = document.getElementById('text-peminjaman');

});

document.getElementById("form-peminjaman").addEventListener("submit", function(e) {
    e.preventDefault();
    document.getElementById('modal-ttotalpeminjaman1').value = unformatRupiah(document.getElementById('modal-ttotalpeminjaman1').value);
    document.getElementById('modal-ttotalpokok1').value = unformatRupiah(document.getElementById('modal-ttotalpokok1').value);
    document.getElementById('modal-ttotalbunga1').value = unformatRupiah(document.getElementById('modal-ttotalbunga1').value);
    document.getElementById('modal-ttotalpembayaran1').value = unformatRupiah(document.getElementById('modal-ttotalpembayaran1').value);
    this.submit();
});

document.getElementById("form-tabungan").addEventListener("submit", function(e) {
    e.preventDefault();
    document.getElementById('modal-penarikantabungan').value = unformatRupiah(document.getElementById('modal-penarikantabungan').value);
    document.getElementById('modal-tabungansaatini').value = unformatRupiah(document.getElementById('modal-tabungansaatini').value);
    document.getElementById('modal-sisatabungan').value = unformatRupiah(document.getElementById('modal-sisatabungan').value);
    this.submit();
});
</script>
  </body>
  </html>
  