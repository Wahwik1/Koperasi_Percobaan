document.querySelector(".nomorpeserta").addEventListener("keyup", function () {
    const nomor = this.value;

    if (nomor.length > 0) {
        fetch(`/search-user-overbook?id=${nomor}&pinjaman_id=${nomor}`)
            .then((response) => response.json())
            .then((data) => {
                if (data.error) {
                    // Kosongkan field jika user tidak ditemukan
                    document.querySelector(".nama-overbook").value = "";
                    document.querySelector(".nohp-overbook").value = "";
                    document.querySelector(".ttl-overbook").value = "";
                    document.querySelector(".alamat-overbook").value = "";
                    document.querySelector(".tpokok1").value = "";
                    document.querySelector(".tpokok2").value = "";
                    document.getElementById("pinjaman_id").value = "";
                    document.getElementById("pinjaman_id2").value = "";
                    return; // keluar agar tidak lanjut
                }

                // Isi data user
                document.querySelector(".nama-overbook").value =
                    data.nama_overbook;
                document.querySelector(".nohp-overbook").value =
                    data.telepon_overbook;
                document.querySelector(".ttl-overbook").value =
                    data.ttl_overbook;
                document.querySelector(".alamat-overbook").value =
                    data.alamat_overbook;

                if (!data.tpokok1) {
                    document.querySelector(".tpokok1").value = "Rp. 0";
                    btnKirim.disabled = true;
                    btnKirim.classList.add("disabled");
                    alert_kirim.classList.remove("d-none");
                } else {
                    btnKirim.disabled = false;
                    btnKirim.classList.remove("disabled");
                    alert_kirim.classList.add("d-none");
                    document.querySelector(".tpokok1").value = formatRupiah(
                        data.tpokok1
                    );
                }

                if (!data.tpokok2) {
                    document.querySelector(".tpokok2").value = "Rp. 0";
                    btnKirim2.disabled = true;
                    btnKirim2.classList.add("disabled");
                    alert_kirim2.classList.remove("d-none");
                } else {
                    btnKirim2.disabled = false;
                    btnKirim2.classList.remove("disabled");
                    alert_kirim2.classList.add("d-none");
                    document.querySelector(".tpokok2").value = formatRupiah(
                        data.tpokok2
                    );
                }
                document.getElementById("pinjaman_id").value = data.id;
                document.getElementById("pinjaman_id2").value = data.id;
            });
    } else {
        // Kosongkan semua jika input kosong
        document.querySelector(".nama-overbook").value = "";
        document.querySelector(".nohp-overbook").value = "";
        document.querySelector(".ttl-overbook").value = "";
        document.querySelector(".alamat-overbook").value = "";
        document.querySelector(".tpokok1").value = "Rp. 0";
        document.querySelector(".tpokok2").value = "Rp. 0";
        document.getElementById("pinjaman_id").value = "";
        document.getElementById("pinjaman_id2").value = "";
    }
});

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
