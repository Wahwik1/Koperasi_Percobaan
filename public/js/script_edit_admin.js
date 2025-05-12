document.querySelector(".hamburger").addEventListener("click", function () {
    document.querySelector(".sidebar").classList.toggle("show");
});

let liveDateInterval; // Variabel untuk menyimpan interval

// Fungsi untuk mengupdate tanggal real-time
function updateLiveDate() {
    const now = new Date();
    const options = {
        day: "numeric",
        month: "long",
        year: "numeric",
        hour: "2-digit",
        minute: "2-digit",
        second: "2-digit",
    };
    document.getElementById("liveDate").textContent = now.toLocaleDateString(
        "id-ID",
        options
    );
}

// Fungsi untuk mengupdate tanggal dari input & stop real-time update
function updateDateFromInput() {
    clearInterval(liveDateInterval); // Hentikan real-time update
    const selectedDate = document.getElementById("datePicker").value;
    if (selectedDate) {
        const formattedDate = new Date(selectedDate).toLocaleDateString(
            "id-ID",
            { day: "numeric", month: "long", year: "numeric" }
        );
        document.getElementById("liveDate").textContent = formattedDate;
    }
}

// Mulai interval untuk update real-time setiap detik
liveDateInterval = setInterval(updateLiveDate, 1000);

// Event listener untuk perubahan pada input date
document
    .getElementById("datePicker")
    .addEventListener("change", updateDateFromInput);

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".total-peminjaman").forEach(function (input) {
        input.addEventListener("input", function (e) {
            let value = e.target.value.replace(/[^0-9]/g, ""); // Hanya angka
            if (value) {
                e.target.value = "Rp. " + parseInt(value).toLocaleString(); // Format dengan Rp.
            } else {
                e.target.value = ""; // Kosongkan jika tidak ada angka
            }
        });
    });

    document.querySelectorAll(".nomorpeserta").forEach(function (input) {
        input.addEventListener("input", function (e) {
            e.target.value = e.target.value.replace(/[^0-9]/g, ""); // Hanya angka
            if (input.value.length > 3) {
                input.value = input.value.slice(0, 3); // Potong jika lebih dari 3 angka
            }
        });
    });

    document.querySelectorAll(".pembayaran").forEach(function (input) {
        input.addEventListener("input", function (e) {
            e.target.value = e.target.value.replace(/[^0-9]/g, ""); // Hanya angka
        });
    });
});

// Peminjaman Pertama
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".pembayaran-pokok").forEach(function (input) {
        input.addEventListener("input", function (e) {
            let value = e.target.value.replace(/[^0-9]/g, ""); // Hanya angka
            if (value) {
                e.target.value = "Rp. " + parseInt(value).toLocaleString(); // Format dengan Rp.
            } else {
                e.target.value = ""; // Kosongkan jika tidak ada angka
            }
        });
    });
    document.querySelectorAll(".pembayaran-bunga").forEach(function (input) {
        input.addEventListener("input", function (e) {
            let value = e.target.value.replace(/[^0-9]/g, ""); // Hanya angka
            if (value) {
                e.target.value = "Rp. " + parseInt(value).toLocaleString(); // Format dengan Rp.
            } else {
                e.target.value = ""; // Kosongkan jika tidak ada angka
            }
        });
    });
    document.querySelectorAll(".pembayaran-denda").forEach(function (input) {
        input.addEventListener("input", function (e) {
            let value = e.target.value.replace(/[^0-9]/g, ""); // Hanya angka
            if (value) {
                e.target.value = "Rp. " + parseInt(value).toLocaleString(); // Format dengan Rp.
            } else {
                e.target.value = ""; // Kosongkan jika tidak ada angka
            }
        });
    });
    document.querySelectorAll(".total-peminjaman").forEach(function (input) {
        input.addEventListener("input", function (e) {
            let value = e.target.value.replace(/[^0-9]/g, ""); // Hanya angka
            if (value) {
                e.target.value = "Rp. " + parseInt(value).toLocaleString(); // Format dengan Rp.
            } else {
                e.target.value = ""; // Kosongkan jika tidak ada angka
            }
        });
    });
    document.querySelectorAll(".pokok-seharusnya").forEach(function (input) {
        input.addEventListener("input", function (e) {
            let value = e.target.value.replace(/[^0-9]/g, ""); // Hanya angka
            if (value) {
                e.target.value = "Rp. " + parseInt(value).toLocaleString(); // Format dengan Rp.
            } else {
                e.target.value = ""; // Kosongkan jika tidak ada angka
            }
        });
    });
    document.querySelectorAll(".sisa-pokok").forEach(function (input) {
        input.addEventListener("input", function (e) {
            let value = e.target.value.replace(/[^0-9]/g, ""); // Hanya angka
            if (value) {
                e.target.value = "Rp. " + parseInt(value).toLocaleString(); // Format dengan Rp.
            } else {
                e.target.value = ""; // Kosongkan jika tidak ada angka
            }
        });
    });
    document.querySelectorAll(".total-pembayaran").forEach(function (input) {
        input.addEventListener("input", function (e) {
            let value = e.target.value.replace(/[^0-9]/g, ""); // Hanya angka
            if (value) {
                e.target.value = "Rp. " + parseInt(value).toLocaleString(); // Format dengan Rp.
            } else {
                e.target.value = ""; // Kosongkan jika tidak ada angka
            }
        });
    });
    document.querySelectorAll(".pembayaran").forEach(function (input) {
        input.addEventListener("input", function (e) {
            e.target.value = e.target.value.replace(/[^0-9]/g, ""); // Hanya angka
            if (input.value.length > 3) {
                input.value = input.value.slice(0, 3); // Potong jika lebih dari 3 angka
            }
        });
    });
});

// ==================================================================================================================================

let isPeminjaman1Aktif = false;

document
    .querySelector(".editpeminjaman1")
    .addEventListener("click", function () {
        const tombol = document.getElementById("peminjaman1");
        const elemenInput = [
            { id: "pokok_dibayar", class: "pembayaran-pokok-background1" },
            { id: "bunga_dibayar", class: "pembayaran-bunga-background1" },
            { id: "denda", class: "pembayaran-denda-background1" },
            { id: "ttotalpeminjaman1", class: "total-peminjaman-background1" },
            { id: "tpembayaran1", class: "pembayaran-background1" },
            { id: "ttotalpokok1", class: "pokok-seharusnya-background1" },
            { id: "pokok1", class: "sisa-pokok-background1" },
            { id: "jumlah_bayar", class: "total-pembayaran-background1" },
        ];

        if (!isPeminjaman1Aktif) {
            tombol.classList.remove("disabled");

            elemenInput.forEach((item) => {
                const el = document.getElementById(item.id);
                el.classList.remove(item.class);
                el.removeAttribute("readonly");
            });
        } else {
            tombol.classList.add("disabled");

            elemenInput.forEach((item) => {
                const el = document.getElementById(item.id);
                el.classList.add(item.class);
                el.setAttribute("readonly", true);
            });
        }

        isPeminjaman1Aktif = !isPeminjaman1Aktif;
    });

let isPeminjaman2Aktif = false;

document
    .querySelector(".editpeminjaman2")
    .addEventListener("click", function () {
        const tombol = document.getElementById("peminjaman2");
        const elemenInput = [
            { id: "pokok_dibayar2", class: "pembayaran-pokok-background2" },
            { id: "bunga_dibayar2", class: "pembayaran-bunga-background2" },
            { id: "denda2", class: "pembayaran-denda-background2" },
            { id: "ttotalpeminjaman2", class: "total-peminjaman-background2" },
            { id: "tpembayaran2", class: "pembayaran-background2" },
            { id: "ttotalpokok2", class: "pokok-seharusnya-background2" },
            { id: "pokok2_edit", class: "sisa-pokok-background2" },
            { id: "jumlah_bayar2", class: "total-pembayaran-background2" },
        ];

        if (!isPeminjaman2Aktif) {
            tombol.classList.remove("disabled");

            elemenInput.forEach((item) => {
                const el = document.getElementById(item.id);
                el.classList.remove(item.class);
                el.removeAttribute("readonly");
            });
        } else {
            tombol.classList.add("disabled");

            elemenInput.forEach((item) => {
                const el = document.getElementById(item.id);
                el.classList.add(item.class);
                el.setAttribute("readonly", true);
            });
        }

        isPeminjaman2Aktif = !isPeminjaman2Aktif;
    });

// ==================================================================================================================================
//   Pembayaran Tabungan

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".pembayaran-tabungan").forEach(function (input) {
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

function hitungPembayaranTabungan(input) {
    let card = input.closest(".card");
    let pembayarantabunganpenambahan =
        parseFloat(
            card
                .querySelector(".pembayaran-tabungan-penambahan")
                .value.replace(/[^0-9]/g, "")
        ) || 0;
    let tabungansebelumnyapenambahan =
        parseFloat(
            card
                .querySelector(".tabungan-sebelumnya-penambahan")
                .value.replace(/[^0-9]/g, "")
        ) || 0;
    let pembayarantabunganpengurangan =
        parseFloat(
            card
                .querySelector(".pembayaran-tabungan-pengurangan")
                .value.replace(/[^0-9]/g, "")
        ) || 0;
    let tabungansebelumnyapengurangan =
        parseFloat(
            card
                .querySelector(".tabungan-sebelumnya-pengurangan")
                .value.replace(/[^0-9]/g, "")
        ) || 0;

    let totaltabunganpenambahan =
        tabungansebelumnyapenambahan + pembayarantabunganpenambahan;
    let totaltabunganpengurangan =
        tabungansebelumnyapengurangan - pembayarantabunganpengurangan;

    card.querySelector(
        ".total-tabungan-penambahan"
    ).value = `Rp. ${totaltabunganpenambahan.toLocaleString()}`;
    card.querySelector(
        ".total-tabungan-pengurangan"
    ).value = `Rp. ${totaltabunganpengurangan.toLocaleString()}`;
}

let isTabunganAktif = false; // status toggle awal

document.querySelector(".edittabungan").addEventListener("click", function () {
    const inputTabungan = document.getElementById("tabungan_edit");
    const tombolSubmit = document.getElementById("tombolpembayarantabungan");

    if (!isTabunganAktif) {
        // Aktifkan input dan tombol
        inputTabungan.classList.remove("pembayaran-tabungan-background");
        inputTabungan.removeAttribute("readonly");
        tombolSubmit.classList.remove("disabled");
    } else {
        // Nonaktifkan kembali
        inputTabungan.classList.add("pembayaran-tabungan-background");
        inputTabungan.setAttribute("readonly", true);
        tombolSubmit.classList.add("disabled");
    }

    isTabunganAktif = !isTabunganAktif; // toggle status
});

// function pembayarantabungan() {
//     let disabled = document.getElementById("tabungan_edit");
//     let disabled2 = document.getElementById("nilaitabungan2");
//     let disabledtombol = document.getElementById("tombolpembayarantabungan");
//     // Konfirmasi sebelum cetak PDF
//     Swal.fire({
//         title: "Apakah Kamu Yakin ?",
//         text: "Mohon Cek Ulang !",
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonColor: "#3085d6",
//         cancelButtonColor: "#d33",
//         confirmButtonText: "Ya",
//     }).then(async (result) => {
//         if (result.isConfirmed) {
//             disabled.classList.add("pembayaran-tabungan-background");
//             disabled2.classList.add("pembayaran-tabungan-background2");
//             disabledtombol.classList.add("disabled");
//             disabled.setAttribute("readonly", true);
//             disabled2.setAttribute("readonly", true);
//             // Tampilkan pesan sukses setelah file siap
//             Swal.fire({
//                 title: "Nilai Sudah Masuk",
//                 text: "Silahkan Dicek !",
//                 icon: "success",
//             });
//         }
//     });
// }

// Event listener untuk tombol Simpan PDF
// document
//     .querySelector(".tombolpembayarantabungan")
//     .addEventListener("click", pembayarantabungan);

// function formatRupiah(angka) {
//     // Ubah string ke angka jika perlu
//     angka = parseFloat(angka);
//     if (isNaN(angka)) return "Rp. 0";

//     return new Intl.NumberFormat("id-ID", {
//         style: "currency",
//         currency: "IDR",
//         minimumFractionDigits: 0,
//         maximumFractionDigits: 0,
//     }).format(angka);
// }

// document.querySelector(".nomorpeserta").addEventListener("keyup", function () {
//     const nomor = this.value;

//     if (nomor.length > 0) {
//         fetch(`/search-user-edit?id=${nomor}`)
//             .then((response) => response.json())
//             .then((data) => {
//                 if (data.error) {
//                     document.querySelector(".nama_edit").value = "";
//                     document.querySelector(".nohp_edit").value = "";
//                     document.querySelector(".ttl_edit").value = "";
//                     document.querySelector(".alamat_edit").value = "";
//                     document.querySelector(".tabungan_edit").value = "Rp 0";
//                     document.querySelector(".tabungan_edit2").value = "Rp 0";
//                     document.querySelector(".ttotalpeminjaman1").value = "Rp 0";
//                     document.querySelector(".tpembayaran1").value = "0";
//                     document.querySelector(".ttotalpokok1").value = "Rp 0";
//                     document.querySelector(".ttotalbunga1").value = "Rp 0";
//                     document.querySelector(".pokok1").value = "Rp 0";
//                     document.querySelector(".denda").value = "Rp 0";

//                     document.getElementById("tabungan_id").value = "";

//                     document.querySelector(".ttotalpeminjaman2").value = "Rp 0";
//                     document.querySelector(".tpembayaran2").value = "0";
//                     document.querySelector(".ttotalpokok2").value = "Rp 0";
//                     document.querySelector(".ttotalbunga2").value = "Rp 0";
//                     document.querySelector(".pokok2_edit").value = "Rp 0";
//                     document.querySelector(".denda2").value = "Rp 0";
//                     document.getElementById("pinjaman_id").value = "";
//                     document.getElementById("pinjaman_id2").value = "";

//                     return;
//                 }

//                 // Set value ke input
//                 document.querySelector(".nama_edit").value = data.nama_edit;
//                 document.querySelector(".nohp_edit").value = data.telepon_edit;
//                 document.querySelector(".ttl_edit").value = data.ttl_edit;
//                 document.querySelector(".alamat_edit").value = data.alamat_edit;
//                 document.querySelector(".tabungan_edit").value = formatRupiah(
//                     data.tabungan_edit
//                 );
//                 document.querySelector(".tabungan_edit2").value = formatRupiah(
//                     data.tabungan_edit
//                 );

//                 if (!data.pokok1_edit) {
//                     document.querySelector(".ttotalpeminjaman1").value = "Rp 0";
//                     document.querySelector(".tpembayaran1").value = "0";
//                     document.querySelector(".ttotalpokok1").value = "Rp 0";
//                     document.querySelector(".ttotalbunga1").value = "Rp 0";
//                     document.querySelector(".pokok1").value = "Rp 0";
//                     document.querySelector(".denda").value = "Rp 0";
//                     document.getElementById("tabungan_id").value = "";
//                     document.getElementById("pinjaman_id").value = "";
//                 } else {
//                     document.querySelector(".ttotalpeminjaman1").value =
//                         formatRupiah(data.ttotalpeminjaman1_edit);
//                     document.querySelector(".tpembayaran1").value =
//                         data.tpembayaran1_edit;
//                     document.querySelector(".ttotalpokok1").value =
//                         formatRupiah(data.ttotalpokok1_edit);
//                     document.querySelector(".ttotalbunga1").value =
//                         formatRupiah(data.ttotalbunga1_edit);
//                     document.querySelector(".pokok1").value = formatRupiah(
//                         data.pokok1_edit
//                     );
//                     document.querySelector(".denda").value = formatRupiah(
//                         data.denda_edit
//                     );
//                 }

//                 if (!data.pokok2_edit) {
//                     document.querySelector(".ttotalpeminjaman2").value = "Rp 0";
//                     document.querySelector(".tpembayaran2").value = "0";
//                     document.querySelector(".ttotalpokok2").value = "Rp 0";
//                     document.querySelector(".ttotalbunga2").value = "Rp 0";
//                     document.querySelector(".pokok2_edit").value = "Rp 0";
//                     document.querySelector(".denda2").value = "Rp 0";
//                     document.getElementById("pinjaman_id2").value = "";
//                 } else {
//                     document.querySelector(".ttotalpeminjaman2").value =
//                         formatRupiah(data.ttotalpeminjaman2_edit);
//                     document.querySelector(".tpembayaran2").value =
//                         data.tpembayaran2_edit;
//                     document.querySelector(".ttotalpokok2").value =
//                         formatRupiah(data.ttotalpokok2_edit);
//                     document.querySelector(".ttotalbunga2").value =
//                         formatRupiah(data.ttotalbunga2_edit);
//                     document.querySelector(".pokok2_edit").value = formatRupiah(
//                         data.pokok2_edit
//                     );
//                     document.querySelector(".denda2").value = formatRupiah(
//                         data.denda2_edit
//                     );
//                 }

//                 document.getElementById("tabungan_id").value = data.id;
//                 document.getElementById("pinjaman_id").value = data.id;
//                 document.getElementById("pinjaman_id2").value = data.id;
//             });
//     } else {
//         document.querySelector(".nama_edit").value = "";
//         document.querySelector(".nohp_edit").value = "";
//         document.querySelector(".ttl_edit").value = "";
//         document.querySelector(".alamat_edit").value = "";
//         document.querySelector(".tabungan_edit").value = "Rp 0";
//         document.querySelector(".tabungan_edit2").value = "Rp 0";
//         document.querySelector(".ttotalpeminjaman1").value = "Rp 0";
//         document.querySelector(".tpembayaran1").value = "0";
//         document.querySelector(".ttotalpokok1").value = "Rp 0";
//         document.querySelector(".ttotalbunga1").value = "Rp 0";
//         document.querySelector(".pokok1").value = "Rp 0";
//         document.querySelector(".denda").value = "Rp 0";
//         document.getElementById("tabungan_id").value = "";
//         document.getElementById("pinjaman_id").value = "";

//         document.querySelector(".ttotalpeminjaman2").value = "Rp 0";
//         document.querySelector(".tpembayaran2").value = "0";
//         document.querySelector(".ttotalpokok2").value = "Rp 0";
//         document.querySelector(".ttotalbunga2").value = "Rp 0";
//         document.querySelector(".pokok2_cicilan").value = "Rp 0";
//         document.querySelector(".denda2").value = "Rp 0";
//         document.getElementById("pinjaman_id2").value = "";
//     }
// });

// document.getElementById("form-tabungan").addEventListener("submit", function (e) {
//         e.preventDefault(); // Hentikan submit default

//         let tabungan_cicilan = document
//             .getElementById("tabungan_cicilan")
//             .value.trim();
//         let nomor = document.getElementById("nomor").value.trim();
//         const card = this.querySelector(".card");

//         const fields = [".total-tabungan"];

//         Swal.fire({
//             title: "Apakah Kamu Yakin ?",
//             text: "Mohon Cek Ulang !",
//             icon: "warning",
//             showCancelButton: true,
//             confirmButtonColor: "#3085d6",
//             cancelButtonColor: "#d33",
//             confirmButtonText: "Ya",
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 fields.forEach((selector) => {
//                     const input = card.querySelector(selector);
//                     if (input) {
//                         input.value = input.value.replace(/[^0-9]/g, ""); // hapus Rp. dan ,
//                     }
//                 });
//                 this.submit(); // Submit manual kalau semua OK
//             }
//         });
//     });
// document
//     .getElementById("form-peminjaman1")
//     .addEventListener("submit", function (e) {
//         e.preventDefault(); // Hentikan submit default

//         let pokok_dibayar = document
//             .getElementById("pokok_dibayar")
//             .value.trim();
//         let bunga_dibayar = document
//             .getElementById("bunga_dibayar")
//             .value.trim();
//         let denda_dibayar = document.getElementById("denda").value.trim();
//         let jumlah_bayar = document.getElementById("jumlah_bayar").value.trim();
//         let nomor = document.getElementById("nomor").value.trim();
//         const card = this.querySelector(".card");

//         const fields = [
//             ".pembayaran-pokok",
//             ".pembayaran-bunga",
//             ".pembayaran-denda",
//             ".total-pembayaran",
//         ];

//         Swal.fire({
//             title: "Apakah Kamu Yakin ?",
//             text: "Mohon Cek Ulang !",
//             icon: "warning",
//             showCancelButton: true,
//             confirmButtonColor: "#3085d6",
//             cancelButtonColor: "#d33",
//             confirmButtonText: "Ya",
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 fields.forEach((selector) => {
//                     const input = card.querySelector(selector);
//                     if (input) {
//                         input.value = input.value.replace(/[^0-9]/g, ""); // hapus Rp. dan ,
//                     }
//                 });
//                 this.submit(); // Submit manual kalau semua OK
//             }
//         });
//     });
// document
//     .getElementById("form-peminjaman2")
//     .addEventListener("submit", function (e) {
//         e.preventDefault(); // Hentikan submit default

//         let pokok_dibayar = document
//             .getElementById("pokok_dibayar2")
//             .value.trim();
//         let bunga_dibayar = document
//             .getElementById("bunga_dibayar2")
//             .value.trim();
//         let denda_dibayar = document.getElementById("denda2").value.trim();
//         let jumlah_bayar = document
//             .getElementById("jumlah_bayar2")
//             .value.trim();
//         let nomor = document.getElementById("nomor").value.trim();
//         const card = this.querySelector(".card");

//         const fields = [
//             ".pembayaran-pokok",
//             ".pembayaran-bunga",
//             ".pembayaran-denda",
//             ".total-pembayaran",
//         ];

//         Swal.fire({
//             title: "Apakah Kamu Yakin ?",
//             text: "Mohon Cek Ulang !",
//             icon: "warning",
//             showCancelButton: true,
//             confirmButtonColor: "#3085d6",
//             cancelButtonColor: "#d33",
//             confirmButtonText: "Ya",
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 fields.forEach((selector) => {
//                     const input = card.querySelector(selector);
//                     if (input) {
//                         input.value = input.value.replace(/[^0-9]/g, ""); // hapus Rp. dan ,
//                     }
//                 });
//                 this.submit(); // Submit manual kalau semua OK
//             }
//         });
//     });

// ===================================================================================================================================

{
    /* <form class="formku" id="form-peminjaman2" action="#" method="post">
@csrf
<input type="hidden" id="pinjaman_id2" name="pinjaman_id">
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
      <input type="text" name="bunga_dibayar2" id="bunga_dibayar2" class="form-control pembayaran-bunga pembayaran-bunga2 pembayaran-bunga-background2 ttotalbunga2" readonly value="Rp. 0"/>
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
      <input type="text" name="ttotalpokok2" id="ttotalpokok2" class="form-control pokok-seharusnya pokok-seharusnya2 pokok-seharusnya-background2 ttotalpokok2" name="ttotalpokok2" readonly value="Rp. 0"/>
    </div>
    <div class="col-md-4">
      <label class="form-label">Sisa Pokok</label>
      <input type="text" name="pokok2_edit" id="pokok2_edit" class="form-control sisa-pokok sisa-pokok2 sisa-pokok-background2 pokok2_edit" readonly value="Rp. 0"/>
    </div>
    <div class="col-md-4">
      <label class="form-label">Total Pembayaran</label>
      <input type="text" name="jumlah_bayar2" id="jumlah_bayar2" class="form-control total-pembayaran total-pembayaran1 total-pembayaran-background2" value="Rp. 0" readonly/>
    </div>

    <div class="col-md-12">
      <button type="submit" class="form-control btn btn-save mt-3 peminjaman2 disabled" id="peminjaman2"><i class="fa-regular fa-circle-check"></i> Save</button>
    </div>
  </div>
</div>
</form> */
}

// =================================================================================
// {{-- Tabungan --}}
{
    /* <form class="formku" id="form-tabungan" action="#" method="post">
  @csrf
  <input type="hidden" id="tabungan_id" name="tabungan_id">
  <div class="card mt-4">
    <div class="row align-self-end buttonedit">
      <div class="col-12">
        <button type="button" class="form-control btn btn-save mt-3 edittabungan" id="edittabungan"><i class="fa-regular fa-pen-to-square"></i></button>
      </div>
    </div>
    <h5 class="fw-bold">Tabungan</h5>
    <p class="alert-text">*Penambahan</p>
    <div class="row g-3">
      <div class="col-md-4">
        <label class="form-label">Nilai Tabungan</label>
        <input type="text" class="form-control pembayaran-tabungan pembayaran-tabungan-penambahan pembayaran-tabungan-background" id="nilaitabungan" readonly value="Rp. 0" oninput="hitungPembayaranTabungan(this)" />
      </div>
      <div class="col-md-4">
        <label class="form-label">Tabungan Sebelumnya</label>
        <input type="text" class="form-control tabungan-sebelumnya tabungan-sebelumnya-penambahan tabungan_edit" value="Rp. 0" readonly style="background-color: rgba(128, 128, 128, 0.302)"/>
      </div>
      <div class="col-md-4">
        <label class="form-label">Total Tabungan</label>
        <input type="text" class="form-control total-tabungan total-tabungan-penambahan" readonly style="background-color: rgba(128, 128, 128, 0.302)" value="Rp 0"/>
      </div>
    </div>
    <p class="alert-text" style="margin-top: 20px">*Pengurangan</p>
    <div class="row g-3">
      <div class="col-md-4">
        <label class="form-label">Nilai Tabungan</label>
        <input type="text" class="form-control pembayaran-tabungan pembayaran-tabungan-pengurangan pembayaran-tabungan-background2" readonly id="nilaitabungan2" value="Rp. 0" oninput="hitungPembayaranTabungan(this)" />
      </div>
      <div class="col-md-4">
        <label class="form-label">Tabungan Sebelumnya</label>
        <input type="text" class="form-control tabungan-sebelumnya tabungan-sebelumnya-pengurangan tabungan_edit2" value="Rp. 0" readonly" style="background-color: rgba(128, 128, 128, 0.302)"/>
      </div>
      <div class="col-md-4">
        <label class="form-label">Total Tabungan</label>
        <input type="text" class="form-control total-tabungan total-tabungan-pengurangan" readonly style="background-color: rgba(128, 128, 128, 0.302)" value="Rp 0" />
      </div>
    </div>
    <div class="col-md-12">
      <button type="submit" class="form-control btn btn-save mt-3 tombolpembayarantabungan disabled" id="tombolpembayarantabungan"><i class="fa-regular fa-circle-check"></i> Save</button>
    </div>
  </div>
</form> */
}
