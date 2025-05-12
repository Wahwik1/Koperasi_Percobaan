// Hamburger
document.querySelector(".hamburger").addEventListener("click", function () {
    document.querySelector(".sidebar").classList.toggle("show");
});

// ===============================================================================================================
// Dom
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".nomorpeserta").forEach(function (input) {
        input.addEventListener("input", function (e) {
            e.target.value = e.target.value.replace(/[^0-9]/g, ""); // Hanya angka
            if (input.value.length > 3) {
                input.value = input.value.slice(0, 3); // Potong jika lebih dari 3 angka
            }
        });
    });
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
// ======================================================================================================================

// Pembayaran Peminjaman

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
});

function hitungPembayaranPeminjaman1(input) {
    let card = input.closest(".card");
    let pembayaranpokok =
        parseFloat(
            card
                .querySelector(".pembayaran-pokok1")
                .value.replace(/[^0-9]/g, "")
        ) || 0;
    let pembayaranbunga =
        parseFloat(
            card
                .querySelector(".pembayaran-bunga1")
                .value.replace(/[^0-9]/g, "")
        ) || 0;
    let pembayarandenda =
        parseFloat(
            card
                .querySelector(".pembayaran-denda1")
                .value.replace(/[^0-9]/g, "")
        ) || 0;
    let pembayaran1 =
        parseInt(
            card.querySelector(".pembayaran1").value.replace(/[^0-9]/g, "")
        ) || 0;
    let sisapokok1 =
        parseFloat(
            card.querySelector(".sisa-pokok1").value.replace(/[^0-9]/g, "")
        ) || 0;
    let totalpembayaran1 =
        parseFloat(
            card
                .querySelector(".total-pembayaran1")
                .value.replace(/[^0-9]/g, "")
        ) || 0;

    let totalpembayaran = pembayaranpokok + pembayarandenda + pembayaranbunga;
    let sisapokok = sisapokok1 - totalpembayaran;
    let pembayaran = pembayaran1 - 1;
    let pembayaranbunga1 = (pembayaranbunga.value = 0);
    card.querySelector(
        ".total-pembayaran1"
    ).value = `Rp. ${totalpembayaran.toLocaleString()}`;

    function popup1() {
        // Memunculkan Popup
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
                if (pembayaranpokok === "") {
                    Swal.fire({
                        icon: "error",
                        title: "Mohon Isikan Pembayaran",
                        text: "Silakan isi kembali.",
                    });
                    return;
                }
                card.querySelector(
                    ".pembayaran-bunga1"
                ).value = `Rp. ${pembayaranbunga1.toLocaleString()}`;
                card.querySelector(
                    ".sisa-pokok1"
                ).value = `Rp. ${sisapokok.toLocaleString()}`;
                card.querySelector(
                    ".pembayaran1"
                ).value = `${pembayaran.toLocaleString()}`;
                // Tampilkan pesan sukses setelah file siap
                Swal.fire({
                    title: "Nilai Sudah Dimasukkan",
                    text: "Silahkan Dicek !",
                    icon: "success",
                });
            }
        });
    }
    // Event listener untuk tombol Simpan PDF
    document.querySelector(".peminjaman1").addEventListener("click", popup1);
}

// Peminjaman ke 2

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
});

function hitungPembayaranPeminjaman2(input) {
    let card = input.closest(".card");
    let pembayaranpokok =
        parseFloat(
            card
                .querySelector(".pembayaran-pokok2")
                .value.replace(/[^0-9]/g, "")
        ) || 0;
    let pembayaranbunga =
        parseFloat(
            card
                .querySelector(".pembayaran-bunga2")
                .value.replace(/[^0-9]/g, "")
        ) || 0;
    let pembayarandenda =
        parseFloat(
            card
                .querySelector(".pembayaran-denda2")
                .value.replace(/[^0-9]/g, "")
        ) || 0;
    let pembayaran1 =
        parseInt(
            card.querySelector(".pembayaran2").value.replace(/[^0-9]/g, "")
        ) || 0;
    let sisapokok1 =
        parseFloat(
            card.querySelector(".sisa-pokok2").value.replace(/[^0-9]/g, "")
        ) || 0;
    let totalpembayaran1 =
        parseFloat(
            card
                .querySelector(".total-pembayaran2")
                .value.replace(/[^0-9]/g, "")
        ) || 0;

    let totalpembayaran = pembayaranpokok + pembayarandenda + pembayaranbunga;
    let sisapokok = sisapokok1 - totalpembayaran;
    let pembayaran = pembayaran1 - 1;

    card.querySelector(
        ".total-pembayaran2"
    ).value = `Rp. ${totalpembayaran.toLocaleString()}`;

    function popup2() {
        // Memunculkan Popup
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
                if (pembayaranpokok === "") {
                    Swal.fire({
                        icon: "error",
                        title: "Mohon Isikan Pembayaran",
                        text: "Silakan isi kembali.",
                    });
                    return;
                }
                card.querySelector(
                    ".sisa-pokok2"
                ).value = `Rp. ${sisapokok.toLocaleString()}`;
                card.querySelector(
                    ".pembayaran2"
                ).value = `${pembayaran.toLocaleString()}`;
                // Tampilkan pesan sukses setelah file siap
                Swal.fire({
                    title: "Nilai Sudah Dimasukkan",
                    text: "Silahkan Dicek !",
                    icon: "success",
                });
            }
        });
    }
    // Event listener untuk tombol Simpan PDF
    document.querySelector(".peminjaman2").addEventListener("click", popup2);
}

// ======================================================================================================================

// Hitung Pembayaran Tabungan
function hitungPembayaranTabungan(input) {
    let card = input.closest(".card");
    let pembayarantabungan =
        parseFloat(
            card
                .querySelector(".pembayaran-tabungan")
                .value.replace(/[^0-9]/g, "")
        ) || 0;
    let tabungansebelumnya =
        parseFloat(
            card
                .querySelector(".tabungan-sebelumnya")
                .value.replace(/[^0-9]/g, "")
        ) || 0;

    let totaltabungan = tabungansebelumnya + pembayarantabungan;

    card.querySelector(
        ".total-tabungan"
    ).value = `Rp. ${totaltabungan.toLocaleString()}`;
}

// Proses Pembuatan PDF
function pembayarantabungan() {
    // Konfirmasi sebelum cetak PDF
    Swal.fire({
        title: "Apakah Kamu Yakin ?",
        text: "Mohon Cek Ulang !",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya",
    }).then(async (result) => {
        if (result.isConfirmed) {
            // Tampilkan pesan sukses setelah file siap
            Swal.fire({
                title: "Nilai Sudah Masuk",
                text: "Silahkan Dicek !",
                icon: "success",
            });
        }
    });
}

// Event listener untuk tombol Simpan PDF
document
    .querySelector(".tombolpembayarantabungan")
    .addEventListener("click", pembayarantabungan);
