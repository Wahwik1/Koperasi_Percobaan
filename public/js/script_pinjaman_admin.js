function realtimedate() {
    function updateLiveDate() {
        const now = new Date();
        const options = { day: "numeric", month: "long", year: "numeric" };
        document.getElementById("liveDate").textContent =
            now.toLocaleDateString("id-ID", options);
    }

    updateLiveDate(); // Langsung tampilkan saat load
    setInterval(updateLiveDate, 1000); // Update tiap detik
}

realtimedate(); // Panggil fungsi

document.querySelector(".hamburger").addEventListener("click", function () {
    document.querySelector(".sidebar").classList.toggle("show");
});

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".nomorpeserta").forEach(function (input) {
        input.addEventListener("input", function (e) {
            e.target.value = e.target.value.replace(/[^0-9]/g, ""); // Hanya angka
            if (input.value.length > 3) {
                input.value = input.value.slice(0, 3); // Potong jika lebih dari 3 angka
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

    document.querySelectorAll(".nomorpeserta").forEach(function (input) {
        input.addEventListener("input", function (e) {
            e.target.value = e.target.value.replace(/[^0-9]/g, ""); // Hanya angka
        });
    });

    document.querySelectorAll(".pembayaran").forEach(function (input) {
        input.addEventListener("input", function (e) {
            e.target.value = e.target.value.replace(/[^0-9]/g, ""); // Hanya angka
        });
    });
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
        let nomor = document.getElementById("nomor").value.trim();
        let tanggal_pembayaran = document.getElementById("tanggal_pembayaran");
        const card = this.querySelector(".card");

        const fields = [
            ".total-peminjaman",
            ".total-pokok",
            ".total-bunga",
            ".total-pembayaran",
        ];

        if (!nomor) {
            Swal.fire({
                icon: "error",
                title: "Nomor Belum Diisi!",
                text: "Mohon Isi Nomor Terlebih Dahulu",
            });
            return;
        }
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
                tanggal_pembayaran.value = new Date()
                    .toISOString()
                    .split("T")[0];
                this.submit(); // Submit manual kalau semua OK
            }
        });
    });

document
    .getElementById("form-peminjaman2")
    .addEventListener("submit", function (e) {
        e.preventDefault(); // Hentikan submit default

        let deskripsi = document.getElementById("deskripsi2").value.trim();
        let ttotalpeminjaman2 = document
            .getElementById("ttotalpeminjaman2")
            .value.trim();
        let tpembayaran2 = document.getElementById("tpembayaran2").value.trim();
        let nomor = document.getElementById("nomor").value.trim();
        const card = this.querySelector(".card");

        const fields = [
            ".total-peminjaman",
            ".total-pokok",
            ".total-bunga",
            ".total-pembayaran",
        ];

        if (!nomor) {
            Swal.fire({
                icon: "error",
                title: "Nomor Belum Diisi!",
                text: "Mohon Isi Nomor Terlebih Dahulu",
            });
            return;
        }
        if (!ttotalpeminjaman2 || !tpembayaran2) {
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
                this.submit(); // Submit manual kalau semua OK
            }
        });
    });

// document.addEventListener("DOMContentLoaded", function () {
//     const nomorInput = document.querySelector(".nomorpeserta");
//     const namaInput = document.querySelector(".nama");
//     const nohpInput = document.querySelector(".nohp");
//     const ttlInput = document.querySelector(".ttl");
//     const alamatInput = document.querySelector(".alamat");
//     const pinjamanIdHidden = document.getElementById("pinjaman_id");
//     const pinjamanIdHidden2 = document.getElementById("pinjaman_id2");
//     const btnKirim = document.querySelector(".btn-kirim");
//     const alert_kirim = document.querySelector(".alert_kirim");

//     // Ambil data user berdasarkan nomor
//     nomorInput.addEventListener("change", function () {
//         const nomor = this.value;

//         fetch(`/admin/cek-user/${nomor}`)
//             .then((response) => response.json())
//             .then((data) => {
//                 if (data) {
//                     namaInput.value = data.nama;
//                     nohpInput.value = data.nohp;
//                     ttlInput.value = data.ttl;
//                     alamatInput.value = data.alamat;
//                     pinjamanIdHidden.value = data.id;
//                     pinjamanIdHidden2.value = data.id;
//                 }

//                 if ($peminjaman1) {
//                     btnKirim.disabled = true;
//                     btnKirim.classList.add("disabled");
//                     alert_kirim.classList.remove("d-none");
//                 } else {
//                     alert("Data peserta tidak ditemukan");
//                     namaInput.value = "";
//                     nohpInput.value = "";
//                     ttlInput.value = "";
//                     alamatInput.value = "";
//                     pinjamanIdHidden.value = "";
//                     pinjamanIdHidden2.value = "";
//                 }
//             })
//             .catch((err) => {
//                 console.error("Gagal mengambil data user:", err);
//             });
//     });
// });

document.querySelector("formku").addEventListener("submit", function (e) {
    const card = this.querySelector(".card");
    // Ambil input dan bersihkan
    const totalPeminjaman = card.querySelector(".total-peminjaman");
    const totalPokok = card.querySelector(".total-pokok");
    const totalBunga = card.querySelector(".total-bunga");
    const totalPembayaran = card.querySelector(".total-pembayaran");

    totalPeminjaman.value = totalPeminjaman.value.replace(/[^0-9]/g, "");
    totalPokok.value = totalPokok.value.replace(/[^0-9]/g, "");
    totalBunga.value = totalBunga.value.replace(/[^0-9]/g, "");
    totalPembayaran.value = totalPembayaran.value.replace(/[^0-9]/g, "");
});

document.querySelector("formku2").addEventListener("submit", function (e) {
    const card = this.querySelector(".card");

    // Ambil input dan bersihkan
    const totalPeminjaman = card.querySelector(".total-peminjaman");
    const totalPokok = card.querySelector(".total-pokok");
    const totalBunga = card.querySelector(".total-bunga");
    const totalPembayaran = card.querySelector(".total-pembayaran");

    totalPeminjaman.value = totalPeminjaman.value.replace(/[^0-9]/g, "");
    totalPokok.value = totalPokok.value.replace(/[^0-9]/g, "");
    totalBunga.value = totalBunga.value.replace(/[^0-9]/g, "");
    totalPembayaran.value = totalPembayaran.value.replace(/[^0-9]/g, "");
});
