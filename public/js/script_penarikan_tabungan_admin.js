function realtimedate() {
    let liveDateInterval; // Variabel untuk menyimpan interval

    // Fungsi untuk mengupdate tanggal real-time
    function updateLiveDate() {
        const now = new Date();
        const options = { day: "numeric", month: "long", year: "numeric" };
        document.getElementById("liveDate").textContent =
            now.toLocaleDateString("id-ID", options);
    }
    // Mulai interval untuk update real-time setiap detik
    liveDateInterval = setInterval(updateLiveDate, 1000);

    // Event listener untuk perubahan pada input date
    document.getElementById("datePicker");
}

console.log(realtimedate());

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".nomorpeserta").forEach(function (input) {
        input.addEventListener("input", function (e) {
            e.target.value = e.target.value.replace(/[^0-9]/g, ""); // Hanya angka
            if (input.value.length > 3) {
                input.value = input.value.slice(0, 3); // Potong jika lebih dari 3 angka
            }
        });
    });
    document.querySelectorAll(".penarikan-tabungan").forEach(function (input) {
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
document.querySelector(".hamburger").addEventListener("click", function () {
    document.querySelector(".sidebar").classList.toggle("show");
});
function hitungPembayaran(input) {
    let card = input.closest(".card");
    let penarikantabungan =
        parseFloat(
            card
                .querySelector(".penarikan-tabungan")
                .value.replace(/[^0-9]/g, "")
        ) || 0;
    let tabungansaatini =
        parseFloat(
            card
                .querySelector(".tabungan-saat-ini")
                .value.replace(/[^0-9]/g, "")
        ) || 0;

    let totaltabungan = tabungansaatini - penarikantabungan;

    card.querySelector(
        ".sisa-tabungan"
    ).value = `Rp. ${totaltabungan.toLocaleString()}`;
}
