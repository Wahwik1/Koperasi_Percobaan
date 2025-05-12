document.addEventListener("DOMContentLoaded", function () {
    // Overbook ke-1
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

    // Overbook ke-2
    document.querySelectorAll(".total-peminjamanPDF").forEach(function (input) {
        input.addEventListener("input", function (e) {
            let value = e.target.value.replace(/[^0-9]/g, ""); // Hanya angka
            if (value) {
                e.target.value = "Rp. " + parseInt(value).toLocaleString(); // Format dengan Rp.
            } else {
                e.target.value = ""; // Kosongkan jika tidak ada angka
            }
        });
    });

    document.querySelectorAll(".pembayaranPDF").forEach(function (input) {
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
    let totalpokoksebelumnya =
        parseFloat(
            card
                .querySelector(".total-pokoksebelumnya")
                .value.replace(/[^0-9]/g, "")
        ) || 0;
    let pembayaran =
        parseInt(
            card.querySelector(".pembayaran").value.replace(/[^0-9]/g, "")
        ) || 1;
    let bungaPersen =
        parseFloat(card.querySelector(".bunga").value.replace("%", "")) || 0;

    // Lakukan perhitungan
    let totalPokok = totalPeminjaman / pembayaran;
    let totalBunga = (totalPeminjaman * bungaPersen) / 100;
    let totalPembayaran = totalPokok + totalBunga;
    let totaldidapatkan = totalPeminjaman - totalpokoksebelumnya;

    // Update nilai pada form
    card.querySelector(
        ".total-pokok"
    ).value = `Rp. ${totalPokok.toLocaleString()}`;
    card.querySelector(
        ".total-bunga"
    ).value = `Rp. ${totalBunga.toLocaleString()}`;
    card.querySelector(
        ".total-pembayaran"
    ).value = `Rp. ${totalPembayaran.toLocaleString()}`;
    card.querySelector(
        ".total-didapatkan"
    ).value = `Rp. ${totaldidapatkan.toLocaleString()}`;
}

// Peminjaman ke 1
async function editPDF1() {
    const existingPdfBytes = await fetch("../pdf/Form-Pinjaman.pdf").then(
        (res) => res.arrayBuffer()
    );

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
    let deskripsikeperluan = document.querySelector(
        ".deskripsi-keperluan"
    ).value;

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
document.querySelector(".overbook1").addEventListener("click", editPDF1);

// Peminjaman ke 2
async function editPDF2() {
    const existingPdfBytes = await fetch("../pdf/Form-Pinjaman.pdf").then(
        (res) => res.arrayBuffer()
    );

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
    let deskripsikeperluan = document.querySelector(
        ".deskripsikeperluanPDF"
    ).value;
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
document.querySelector(".overbook2").addEventListener("click", editPDF2);

document
    .getElementById("form-overbook1")
    .addEventListener("submit", function (e) {
        e.preventDefault(); // Hentikan submit default

        let deskripsi = document.getElementById("deskripsi1").value.trim();
        let ttotalpeminjaman1 = document
            .getElementById("ttotalpeminjaman1")
            .value.trim();
        let tpembayaran1 = document.getElementById("tpembayaran1").value.trim();
        let jenis1 = document.getElementById("jenis1").value;
        const totalPeminjaman =
            parseFloat(
                document
                    .querySelector(".total-peminjaman")
                    .value.replace(/[^0-9]/g, "")
            ) || 0;
        const pokoksebelumnya =
            parseFloat(
                document
                    .querySelector(".total-pokoksebelumnya")
                    .value.replace(/[^0-9]/g, "")
            ) || 0;
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

        if (totalPeminjaman < pokoksebelumnya) {
            Swal.fire({
                icon: "error",
                title: "Peminjaman Kurang",
                text: "Silakan coba lagi.",
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

document
    .getElementById("form-overbook2")
    .addEventListener("submit", function (e) {
        e.preventDefault(); // Hentikan submit default

        let deskripsi = document.getElementById("deskripsi2").value.trim();
        let ttotalpeminjaman1 = document
            .getElementById("ttotalpeminjaman2")
            .value.trim();
        let tpembayaran1 = document.getElementById("tpembayaran2").value.trim();
        let jenis1 = document.getElementById("jenis2").value;
        let sisa_pokok2 = document.getElementById("sisa_pokok2").value.trim();
        let totalyangdidapatkan2 = document
            .getElementById("totalyangdidapatkan2")
            .value.trim();
        const totalPeminjaman =
            parseFloat(
                document
                    .querySelector(".totalpeminjamanPDF")
                    .value.replace(/[^0-9]/g, "")
            ) || 0;
        const pokoksebelumnya =
            parseFloat(
                document
                    .querySelector(".totalpokoksebelumnyaPDF")
                    .value.replace(/[^0-9]/g, "")
            ) || 0;
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

        if (totalPeminjaman < pokoksebelumnya) {
            Swal.fire({
                icon: "error",
                title: "Peminjaman Kurang",
                text: "Silakan coba lagi.",
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
