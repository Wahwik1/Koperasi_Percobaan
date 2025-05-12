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

    document.querySelectorAll(".pembayaran").forEach(function (input) {
        input.addEventListener("input", function (e) {
            e.target.value = e.target.value.replace(/[^0-9]/g, ""); // Hanya angka
        });
    });
});
document.querySelector(".hamburger").addEventListener("click", function () {
    document.querySelector(".sidebar").classList.toggle("show");
});
function hitungPembayaran(input) {
    let card = input.closest(".card");
    let totalPeminjaman =
        parseFloat(
            card.querySelector(".total-peminjaman").value.replace(/[^0-9]/g, "")
        ) || 0;
    let pembayaran =
        parseInt(
            card.querySelector(".pembayaran").value.replace(/[^0-9]/g, "")
        ) || 1;
    let bungaPersen =
        parseFloat(card.querySelector(".bunga").value.replace("%", "")) || 0;

    let totalPokok = totalPeminjaman / pembayaran;
    let totalBunga = (totalPeminjaman * bungaPersen) / 100;
    let totalPembayaran = totalPokok + totalBunga;

    card.querySelector(
        ".total-pokok"
    ).value = `Rp. ${totalPokok.toLocaleString()}`;
    card.querySelector(
        ".total-bunga"
    ).value = `Rp. ${totalBunga.toLocaleString()}`;
    card.querySelector(
        ".total-pembayaran"
    ).value = `Rp. ${totalPembayaran.toLocaleString()}`;
}

document
    .getElementById("form-peminjaman")
    .addEventListener("submit", function (e) {
        e.preventDefault(); // Hentikan submit default

        let deskripsi = document.getElementById("deskripsi1").value.trim();
        let ttotalpeminjaman1 = document
            .getElementById("ttotalpeminjaman1")
            .value.trim();
        let tpembayaran1 = document.getElementById("tpembayaran1").value.trim();
        let jenis_form1 = document.getElementById("jenis1").value;
        // const form = this;
        const card = this.querySelector(".card");

        const fields = [
            ".total-peminjaman",
            ".total-pokok",
            ".total-bunga",
            ".total-pembayaran",
        ];

        if (!ttotalpeminjaman1 || !tpembayaran1) {
            Swal.fire({
                icon: "error",
                title: "Kolom Kosong!",
                text: "Mohon Isi Kolom Terlebih Dahulu",
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
                if (deskripsi === "") {
                    Swal.fire({
                        icon: "error",
                        title: "Mohon Isikan Deskripsi Keperluan",
                        text: "Silakan isi kembali.",
                    });
                    return;
                }
                fields.forEach((selector) => {
                    const input = card.querySelector(selector);
                    if (input) {
                        input.value = input.value.replace(/[^0-9]/g, ""); // hapus Rp. dan ,
                    }
                });
                jenis_form1;
                this.submit();
            }
        });
    });

document
    .getElementById("form-peminjaman2")
    .addEventListener("submit", function (e) {
        e.preventDefault(); // Hentikan submit default

        let deskripsi = document.getElementById("deskripsi2").value.trim();
        let ttotalpeminjaman1 = document
            .getElementById("ttotalpeminjaman2")
            .value.trim();
        let tpembayaran1 = document.getElementById("tpembayaran2").value.trim();
        // let jenis1 = document.getElementById("jenis1").value.trim();
        // const form = this;
        const card = this.querySelector(".card");

        const fields = [
            ".total-peminjaman",
            ".total-pokok",
            ".total-bunga",
            ".total-pembayaran",
        ];

        if (!ttotalpeminjaman1 || !tpembayaran1) {
            Swal.fire({
                icon: "error",
                title: "Kolom Kosong!",
                text: "Mohon Isi Kolom Terlebih Dahulu",
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
                if (deskripsi === "") {
                    Swal.fire({
                        icon: "error",
                        title: "Mohon Isikan Deskripsi Keperluan",
                        text: "Silakan isi kembali.",
                    });
                    return;
                }
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
