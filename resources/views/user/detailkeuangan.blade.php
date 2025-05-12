@include('layout.header_user')

@include('layout.navbar_user')

    <!-- Box -->
    <div class="container my-5">
      <!-- Judul Detail Keuangan -->
      <h3 class="header-title">DETAIL KEUANGAN PRIBADI</h3>
      <h6 class="text-deskripsi text-danger header-tittle">*Perhatikan tabel - tabel tersebut, jika ada kesalahan segera hubungi admin</h6>
      <div class="container my-5">
        <div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false">
          <div class="carousel-inner">

            @if (!$peminjaman1)          
            <div class="carousel-item active">
              <div class="card-custom p-4 p-md-5 shadow-sm mb-4">
                <h3 class="fw-bold mb-3">Cicilan Pertama</h3>
                  <p class="text-danger fw-semibold mb-3">*Belum Melakukan Pinjaman</p>
                <div class="row gy-3">
                  <!-- Sisa Cicilan -->
                  <div class="col-12 col-md-6">
                    <div class="card h-100 gradient-abu text-white p-4 p-md-4 rounded-3">
                      <h4 class="fw-bold">Sisa Cicilan</h4>
                      <h2 class="fw-bold">Rp. 0</h2>
                      <p class="mt-2 mb-0"><small>*Hubungi Admin Jika Belum Terupdate</small></p>
                    </div>
                  </div>
            
                  <!-- Grid Kanan: Pokok, Peminjaman, Denda, Peminjaman -->
                  <div class="col-12 col-md-6">
                    <div class="row g-3">
                      <div class="col-6">
                        <div class="card h-100 gradient-abu text-white p-3 p-md-4 rounded-3">
                          <h6 class="fw-bold mb-1">Peminjaman</h6>
                          <p class="mb-0 fw-bold">Rp. 0</p>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="card h-100 gradient-abu text-white p-3 p-md-4 rounded-3">
                          <h6 class="fw-bold mb-1">Bunga</h6>
                          <p class="mb-0 fw-bold">Rp. 0</p>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="card h-100 gradient-abu text-white p-3 p-md-4 rounded-3">
                          <h6 class="fw-bold mb-1">Denda</h6>
                          <p class="mb-0 fw-bold">Rp. 0</p>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="card h-100 gradient-abu text-white p-3 p-md-4 rounded-3">
                          <h6 class="fw-bold mb-1">Yang Ke -</h6>
                          <p class="mb-0 fw-bold">0</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            @else

            <div class="carousel-item active">
              <div class="card-custom p-4 p-md-5 shadow-sm mb-4">
                <h3 class="fw-bold mb-3">Cicilan Pertama</h3>
                @if ($peminjaman1->ttotalbunga1 == 0)
                  <p class="text-success fw-semibold mb-3">*Sudah Membayar</p>
                @else
                  <p class="text-danger fw-semibold mb-3">*Belum Membayar</p>
                @endif
            
                <div class="row gy-3">
                  <!-- Sisa Cicilan -->
                  <div class="col-12 col-md-6">
                    <div class="card h-100 gradient-green text-white p-4 p-md-4 rounded-3">
                      <h4 class="fw-bold">Sisa Cicilan</h4>
                      <h2 class="fw-bold">Rp. {{ number_format($peminjaman1->pokok1 ?? 0, 0, ',', '.') }}</h2>
                      <p class="mt-2 mb-0"><small>*Hubungi Admin Jika Belum Terupdate</small></p>
                    </div>
                  </div>
            
                  <!-- Grid Kanan: Pokok, Peminjaman, Denda, Peminjaman -->
                  <div class="col-12 col-md-6">
                    <div class="row g-3">
                      <div class="col-6">
                        <div class="card h-100 gradient-green text-white p-3 p-md-4 rounded-3">
                          <h6 class="fw-bold mb-1">Peminjaman</h6>
                          <p class="mb-0 fw-bold">Rp. {{ number_format($peminjaman1->ttotalpeminjaman1 ?? 0, 0, ',', '.') }}</p>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="card h-100 gradient-blue text-white p-3 p-md-4 rounded-3">
                          <h6 class="fw-bold mb-1">Bunga</h6>
                          <p class="mb-0 fw-bold">Rp. {{ number_format($peminjaman1->ttotalbunga1 ?? 0, 0, ',', '.') }}</p>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="card h-100 gradient-red text-white p-3 p-md-4 rounded-3">
                          <h6 class="fw-bold mb-1">Denda</h6>
                          <p class="mb-0 fw-bold">Rp. {{ number_format($peminjaman1->denda ?? 0, 0, ',', '.') }}</p>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="card h-100 gradient-blue text-white p-3 p-md-4 rounded-3">
                          <h6 class="fw-bold mb-1">Yang Ke -</h6>
                          <p class="mb-0 fw-bold">{{ $peminjaman1->tpembayaran1 ?? '0' }}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endif
            
            @if (!$peminjaman2)
            
            <div class="carousel-item">
              <div class="card-custom p-4 p-md-5 shadow-sm mb-4">
                <h3 class="fw-bold mb-3">Cicilan Kedua</h3>
                  <p class="text-danger fw-semibold mb-3">*Belum Melakukan Pinjaman</p>
                <div class="row gy-3">
                  <!-- Sisa Cicilan -->
                  <div class="col-12 col-md-6">
                    <div class="card h-100 gradient-abu text-white p-4 p-md-4 rounded-3">
                      <h4 class="fw-bold">Sisa Cicilan</h4>
                      <h2 class="fw-bold">Rp. 0</h2>
                      <p class="mt-2 mb-0"><small>*Hubungi Admin Jika Belum Terupdate</small></p>
                    </div>
                  </div>
            
                  <!-- Grid Kanan: Pokok, Peminjaman, Denda, Peminjaman -->
                  <div class="col-12 col-md-6">
                    <div class="row g-3">
                      <div class="col-6">
                        <div class="card h-100 gradient-abu text-white p-3 p-md-4 rounded-3">
                          <h6 class="fw-bold mb-1">Peminjaman</h6>
                          <p class="mb-0 fw-bold">Rp. 0</p>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="card h-100 gradient-abu text-white p-3 p-md-4 rounded-3">
                          <h6 class="fw-bold mb-1">Bunga</h6>
                          <p class="mb-0 fw-bold">Rp. 0</p>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="card h-100 gradient-abu text-white p-3 p-md-4 rounded-3">
                          <h6 class="fw-bold mb-1">Denda</h6>
                          <p class="mb-0 fw-bold">Rp. 0</p>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="card h-100 gradient-abu text-white p-3 p-md-4 rounded-3">
                          <h6 class="fw-bold mb-1">Yang Ke -</h6>
                          <p class="mb-0 fw-bold">0</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            @else

            <div class="carousel-item">
              <div class="card-custom p-4 p-md-5 shadow-sm mb-4">
                <h3 class="fw-bold mb-3">Cicilan Kedua</h3>
                @if ($peminjaman2->ttotalbunga2 == 0)
                  <p class="text-success fw-semibold mb-3">*Sudah Membayar</p>
                @else
                  <p class="text-danger fw-semibold mb-3">*Belum Membayar</p>
                @endif
            
                <div class="row gy-3">
                  <!-- Sisa Cicilan -->
                  <div class="col-12 col-md-6">
                    <div class="card h-100 gradient-green text-white p-4 p-md-4 rounded-3">
                      <h4 class="fw-bold">Sisa Cicilan</h4>
                      <h2 class="fw-bold">Rp. {{ number_format($peminjaman2->pokok2 ?? 0, 0, ',', '.') }}</h2>
                      <p class="mt-2 mb-0"><small>*Hubungi Admin Jika Belum Terupdate</small></p>
                    </div>
                  </div>
            
                  <!-- Grid Kanan: Pokok, Peminjaman, Denda, Peminjaman -->
                  <div class="col-12 col-md-6">
                    <div class="row g-3">
                      <div class="col-6">
                        <div class="card h-100 gradient-green text-white p-3 p-md-4 rounded-3">
                          <h6 class="fw-bold mb-1">Peminjaman</h6>
                          <p class="mb-0 fw-bold">Rp. {{ number_format($peminjaman2->ttotalpeminjaman2 ?? 0, 0, ',', '.') }}</p>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="card h-100 gradient-blue text-white p-3 p-md-4 rounded-3">
                          <h6 class="fw-bold mb-1">Bunga</h6>
                          <p class="mb-0 fw-bold">Rp. {{ number_format($peminjaman2->ttotalbunga2 ?? 0, 0, ',', '.') }}</p>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="card h-100 gradient-red text-white p-3 p-md-4 rounded-3">
                          <h6 class="fw-bold mb-1">Denda</h6>
                          <p class="mb-0 fw-bold">Rp. {{ number_format($peminjaman2->denda2 ?? 0, 0, ',', '.') }}</p>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="card h-100 gradient-blue text-white p-3 p-md-4 rounded-3">
                          <h6 class="fw-bold mb-1">Yang Ke -</h6>
                          <p class="mb-0 fw-bold">{{ $peminjaman2->tpembayaran2 ?? '0' }}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endif

            <div class="carousel-item">
              <div class="card-custom p-4 p-md-5 shadow-sm mb-4">
                <h3 class="fw-bold mb-3">Tabungan</h3>
                  <p class="text-danger fw-semibold mb-3">*Tidak Wajib Membayar</p>
            
                <div class="row gy-3">
                  <!-- Sisa Cicilan -->
                  <div class="col-12">
                    <div class="card h-100 gradient-green text-white p-4 p-md-4 rounded-3">
                      <h4 class="fw-bold">Tabungan</h4>
                      <h2 class="fw-bold">Rp. {{ number_format($tabungan->tabungan ?? 0, 0, ',', '.') }}</h2>
                      <p class="mt-2 mb-0"><small>*Hubungi Admin Jika Belum Terupdate</small></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
            <i class="fa-solid fa-chevron-left"></i>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
            <i class="fa-solid fa-chevron-right"></i>
            <span class="visually-hidden">Next</span>
          </button>

        </div>
        <div class="container table-container"  style="overflow-x: auto">
          <h4 class="mb-4 text-center"><strong>Riwayat Pembayaran</strong></h4>
          <table id="paymentTable" class="table table-striped table-hover align-middle">
            <thead class="table-dark">
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jenis</th>
                <th class="d-none d-md-table-cell">Pembayaran Pokok/Tabungan</th>
                <th class="d-none d-md-table-cell">Bunga</th>
                <th class="d-none d-md-table-cell">Denda</th>
                <th class="d-none d-md-table-cell">Total Pembayaran</th>
                <th class="d-none d-md-table-cell">Tabungan Sebelumnya</th>
                <th class="d-none d-md-table-cell">Sisa Pokok/Tabungan</th>
                <th>Lihat Detail</th>
              </tr>
            </thead>
            <tbody>
              @php $no = 1; @endphp
              @foreach ($tabel_pembayaran1 as $post )
              <tr>
                <td class="no-tabel">{{ $no++  }}</td>
                <td>{{ $post->created_at->format('d M Y') }}</td>
                <td>{{$post->jenis1 ?? ' '}}</td>
                <td class="d-none d-md-table-cell">{{ 'Rp. ' . number_format($post->pokok_dibayar ?? 0, 0, ',', '.') }}</td>
                <td class="d-none d-md-table-cell">{{ 'Rp. ' . number_format($post->bunga_dibayar ?? 0, 0, ',', '.') }}</td>
                <td class="d-none d-md-table-cell">{{ 'Rp. ' . number_format($post->denda_dibayar ?? 0, 0, ',', '.') }}</td>
                <td class="d-none d-md-table-cell">{{ 'Rp. ' . number_format($post->jumlah_pembayaran  ?? 0, 0, ',', '.') }}</td>
                <td class="d-none d-md-table-cell">Rp. 0</td>
                <td class="d-none d-md-table-cell">{{ 'Rp. ' . number_format($post->pokok1 ?? 0, 0, ',', '.') }}</td>
                <td style="width:100px">
                  <div class="">
                      @if($post->jenis1 === 'Peminjaman Pertama')
                      <a href="#"
                          style="--bs-btn-padding-y: .15rem; --bs-btn-padding-x: .4rem; --bs-btn-font-size: .75rem;"
                         class="btn btn-primary btn-sm"
                         data-bs-toggle="modal"
                         data-bs-target="#exampleModalPeminjaman1"
                         data-id="{{ $post->pembayaran1->id }}"
                         data-jenis1="{{ $post->jenis1 }}"
                         data-pokok1="{{ $post->pokok1 }}"
                         data-jumlah_pembayaran="{{ $post->jumlah_pembayaran }}"
                         data-pokok_dibayar="{{ $post->pokok_dibayar }}"
                         data-bunga_dibayar="{{ $post->bunga_dibayar }}"
                         data-denda_dibayar="{{ $post->denda_dibayar }}"
                         data-ttotalbunga1="{{ $post->ttotalbunga1 }}"
                      >
                      <i class="bi bi-eye-fill"></i>
                      </a>
                      @endif
              </tr>  
              @endforeach

              @foreach ($tabel_pembayaran2 as $post )
              <tr>
                <td class="no-tabel">{{ $no++  }}</td>
                <td>{{ $post->created_at->format('d M Y') }}</td>
                <td>{{$post->jenis2 ?? ' '}}</td>
                <td class="d-none d-md-table-cell">{{ 'Rp. ' . number_format($post->pokok_dibayar2 ?? 0, 0, ',', '.') }}</td>
                <td class="d-none d-md-table-cell">{{ 'Rp. ' . number_format($post->bunga_dibayar2 ?? 0, 0, ',', '.') }}</td>
                <td class="d-none d-md-table-cell">{{ 'Rp. ' . number_format($post->denda_dibayar2 ?? 0, 0, ',', '.') }}</td>
                <td class="d-none d-md-table-cell">{{ 'Rp. ' . number_format($post->jumlah_pembayaran2  ?? 0, 0, ',', '.') }}</td>
                <td class="d-none d-md-table-cell">Rp. 0</td>
                <td class="d-none d-md-table-cell">{{ 'Rp. ' . number_format($post->pokok2 ?? 0, 0, ',', '.') }}</td>
                <td style="width:100px">
                  <div class="">
                      @if($post->jenis2 === 'Peminjaman Kedua')
                      <a href="#"
                        style="--bs-btn-padding-y: .15rem; --bs-btn-padding-x: .4rem; --bs-btn-font-size: .75rem;"
                        class="btn btn-primary btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#exampleModalPeminjaman2"
                        data-id="{{ $post->pembayaran2->id }}"
                        data-jenis2="{{ $post->jenis2 }}"
                        data-pokok2="{{ $post->pokok2 }}"
                        data-jumlah_pembayaran2="{{ $post->jumlah_pembayaran2 }}"
                        data-pokok_dibayar2="{{ $post->pokok_dibayar2 }}"
                        data-bunga_dibayar2="{{ $post->bunga_dibayar2 }}"
                        data-denda_dibayar2="{{ $post->denda_dibayar2 }}"
                        data-ttotalbunga2="{{ $post->ttotalbunga2 }}"
                    >
                    <i class="bi bi-eye-fill"></i>
                   </a>
                      @endif
              </tr>  
              @endforeach

              @foreach ($tabel_pembayarantabungan as $post )
              <tr>
                <td class="no-tabel">{{ $no++  }}</td>
                <td>{{ $post->created_at->format('d M Y') }}</td>
                <td>{{$post->jenis1 ?? ' '}}</td>
                <td class="d-none d-md-table-cell">{{ 'Rp. ' . number_format($post->pembayarantabungan ?? 0, 0, ',', '.') }}</td>
                <td class="d-none d-md-table-cell">Rp. 0</td>
                <td class="d-none d-md-table-cell">Rp. 0</td>
                <td class="d-none d-md-table-cell">{{ 'Rp. ' . number_format($post->pembayarantabungan  ?? 0, 0, ',', '.') }}</td>
                <td class="d-none d-md-table-cell">{{ 'Rp. ' . number_format($post->tabungansebelumnya ?? 0, 0, ',', '.') }}</td>
                <td class="d-none d-md-table-cell">{{ 'Rp. ' . number_format($post->sisatabungan ?? 0, 0, ',', '.') }}</td>
                <td style="width:100px">
                  <div class="">
                      @if($post->jenis1 === 'Pembayaran Tabungan')
                      <a href="#"
                      style="--bs-btn-padding-y: .15rem; --bs-btn-padding-x: .4rem; --bs-btn-font-size: .75rem;"
                         class="btn btn-primary btn-sm"
                         data-bs-toggle="modal"
                         data-bs-target="#exampleModalTabungan"
                         data-id="{{ $post->tabungan->id }}"
                         data-jenis1="{{ $post->jenis1 }}"
                         data-pembayarantabungan="{{ $post->pembayarantabungan }}"
                         data-tabungansebelumnya="{{ $post->tabungansebelumnya }}"
                         data-sisatabungan="{{ $post->sisatabungan }}"

                      >
                      <i class="bi bi-eye-fill"></i>
                      </a>
                      @endif
              </tr>  
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

<!-- Modal Peminjaman Pertama -->
<div class="modal fade" id="exampleModalPeminjaman1" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">  
            <h5 class="modal-title">Pembayaran Peminjaman Pertama</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" class="form-control" id="modal-id" readonly>
            <div class="mb-3"><label>Jenis</label><input type="text" class="form-control" id="modal-jenis1" readonly></div>
            <div class="mb-3"><label>Pembayaran Pokok</label><input type="text" class="form-control" id="modal-pokok_dibayar"readonly></div>
            <div class="mb-3"><label>Bunga</label><input type="text" class="form-control" id="modal-bunga_dibayar"readonly></div>
            <div class="mb-3"><label>Denda</label><input type="text" class="form-control" id="modal-denda_dibayar"readonly></div>
            <div class="mb-3"><label>Total Pembayaran</label><input type="text" class="form-control" id="modal-jumlah_pembayaran"readonly></div>
            <div class="mb-3"><label>Sisa Pokok</label><input type="text" class="form-control" id="modal-pokok1"readonly></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
    </div>
  </div>
</div>

<!-- Modal Peminjaman Kedua -->
<div class="modal fade" id="exampleModalPeminjaman2" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">  
            <h5 class="modal-title">Pembayaran Peminjaman Kedua</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" class="form-control" id="modal-id" readonly>
            <div class="mb-3"><label>Jenis</label><input type="text" class="form-control" id="modal-jenis2" readonly></div>
            <div class="mb-3"><label>Pembayaran Pokok</label><input type="text" class="form-control" id="modal-pokok_dibayar2"readonly></div>
            <div class="mb-3"><label>Bunga</label><input type="text" class="form-control" id="modal-bunga_dibayar2"readonly></div>
            <div class="mb-3"><label>Denda</label><input type="text" class="form-control" id="modal-denda_dibayar2"readonly></div>
            <div class="mb-3"><label>Total Pembayaran</label><input type="text" class="form-control" id="modal-jumlah_pembayaran2"readonly></div>
            <div class="mb-3"><label>Sisa Pokok</label><input type="text" class="form-control" id="modal-pokok2"readonly></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
    </div>
  </div>
</div>


<!-- Modal Tabungan -->
<div class="modal fade" id="exampleModalTabungan" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <input type="hidden" id="modal-pesan_idtabungan" name="pinjaman_id">
        <div class="modal-header">  
            <h5 class="modal-title">Pembayaran Tabungan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" class="form-control" id="modal-id" readonly>
            <div class="mb-3"><label>Jenis</label><input type="text" class="form-control" id="modal-jenistabungan" name="jenis1" readonly></div>
            <div class="mb-3"><label>Pembayaran Tabungan</label><input type="text" class="form-control" id="modal-pembayarantabungan"readonly></div>
            <div class="mb-3"><label>Tabungan Sebelumnya</label><input type="text" class="form-control" id="modal-tabungansebelumnya"readonly></div>
            <div class="mb-3"><label>Sisa Tabungan</label><input type="text" class="form-control" id="modal-sisatabungan"readonly></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
    </div>
  </div>
</div>

<script src="../js/user_detailkeuangan.js"></script>

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
        $("#paymentTable").DataTable({
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ entri",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                paginate: {
                    previous: "Sebelumnya",
                    next: "Berikutnya",
                },
                zeroRecords: "Data tidak ditemukan",
            },
        });
        });

    </script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.min.js" integrity="sha384-VQqxDN0EQCkWoxt/0vsQvZswzTHUVOImccYmSyhJTp7kGtPed0Qcx8rK9h9YEgx+" crossorigin="anonymous"></script>
  </body>
</html>
