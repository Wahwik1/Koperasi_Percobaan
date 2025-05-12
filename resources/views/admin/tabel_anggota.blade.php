@include('layout.admin_header')
   
@include('layout.admin_navbar')

<div class="container mt-5">
    <h2 class="text-center fw-bold">TABEL USER</h2>
    <div class="mb-3 text-center">
      <input type="text" id="customSearchBox" class="form-control" placeholder="Cari data pengguna...">
    </div>
    <div class="text-center">
        <table class="table table-bordered" id="paymentTable">
            @if (session('success-update'))
                <script>
                   Swal.fire({
                      title: "Data Berhasil Diubah",
                      text: "Silahkan Dicek !",
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

            @if (session('failed'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('failed') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
          <thead>
            <tr class="table-dark">
              <th>NO</th>
              <th>NAMA</th>
              <th class="d-none d-md-table-cell">NIK</th>
              <th class="d-none d-md-table-cell">NOMER HP</th>
              <th class="d-none d-md-table-cell">PASSWORD</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="userTable">
            <!-- Contoh data -->
            @foreach ($posts as $post)
            @if (!$post->is_admin)
            <tr>
                <td class="no-tabel">{{ $post->id }}</td>
                <td>{{ $post->name }}</td>
                <td class="d-none d-md-table-cell">{{ $post->nik }}</td>
                <td class="d-none d-md-table-cell">{{ $post->nohp }}</td>
                <td class="password d-none d-md-table-cell">{{ $post->password }}</td>
                <td class="no-tabel" style="width:50px">
                  <div class="d-flex justify-content-between">
                      <a href="{{ route('edit.anggota', $post->id) }}" 
                        class="btn btn-primary btn-sm edit-btn" 
                        data-bs-toggle="modal" 
                        data-bs-target="#exampleModal"
                        data-id="{{ $post->id }}"
                        data-name="{{ $post->name }}"
                        data-email="{{ $post->email }}"
                        data-ttl="{{ $post->ttl }}"
                        data-nik="{{ $post->nik }}"
                        data-nohp="{{ $post->nohp }}"
                        data-alamat="{{ $post->alamat }}"
                        data-password="{{ $post->password }}"
                        >
                        <i class="fas fa-edit"></i>
                      </a>
                      <form class="form-hapus" action="{{ route('delete.anggota', $post->id) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm ms-2"><i class="fas fa-trash"></i></button>
                      </form>
                    </div>
                </td>
            </tr>
            @endif
            @endforeach
        </table>
      </div>
    </div>
    
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action="{{ route('update.anggota', $post->id) }}" method="POST">
          @csrf
          <input type="hidden" id="modal-id" name="id">
  
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Anggota</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
  
          <div class="modal-body">
            <div class="mb-3">
              <label for="modal-name" class="form-label">Nama</label>
              <input type="text" class="form-control" name="name" id="modal-name">
            </div>
            <div class="mb-3">
              <label for="modal-email" class="form-label">Email</label>
              <input type="text" class="form-control" name="email" id="modal-email">
            </div>
            <div class="mb-3">
              <label for="modal-nik" class="form-label">NIK</label>
              <input type="text" class="form-control" name="nik" id="modal-nik">
            </div>
            <div class="mb-3">
              <label for="modal-ttl" class="form-label">Tempat, Tanggal Lahir</label>
              <input type="text" class="form-control" name="ttl" id="modal-ttl">
            </div>
            <div class="mb-3">
              <label for="modal-nohp" class="form-label">No HP</label>
              <input type="text" class="form-control" name="nohp" id="modal-nohp">
            </div>
            <div class="mb-3">
              <label for="modal-alamat" class="form-label">Alamat</label>
              <input type="text" class="form-control" name="alamat" id="modal-alamat">
            </div>
            <div class="mb-3">
              <label for="modal-password" class="form-label">Password</label>
              <input type="password" class="form-control" name="password" id="modal-password">
            </div>
          </div>
  
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
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
  </body>
</html>
