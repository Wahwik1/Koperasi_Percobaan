document.querySelector(".hamburger").addEventListener("click", function () {
    document.querySelector(".sidebar").classList.toggle("show");
});

function formatRupiah(angka) {
    const number = parseFloat(angka);
    if (isNaN(number)) return "Rp. 0";
    return "Rp. " + number.toLocaleString("id-ID");
}
const modal = document.getElementById("exampleModalPeminjaman1");
modal.addEventListener("show.bs.modal", function (event) {
    const button = event.relatedTarget;

    // Isi data ke form modal
    document.getElementById("modal-id").value = button.getAttribute("data-id");
    document.getElementById("modal-jenis1").value =
        button.getAttribute("data-jenis1");
    document.getElementById("modal-pokok_dibayar").value = formatRupiah(
        button.getAttribute("data-pokok_dibayar")
    );
    document.getElementById("modal-bunga_dibayar").value = formatRupiah(
        button.getAttribute("data-bunga_dibayar")
    );
    document.getElementById("modal-denda_dibayar").value = formatRupiah(
        button.getAttribute("data-denda_dibayar")
    );
    document.getElementById("modal-jumlah_pembayaran").value = formatRupiah(
        button.getAttribute("data-jumlah_pembayaran")
    );
    document.getElementById("modal-pokok1").value = formatRupiah(
        button.getAttribute("data-pokok1")
    );
});

const modal2 = document.getElementById("exampleModalPeminjaman2");
modal2.addEventListener("show.bs.modal", function (event) {
    const button = event.relatedTarget;

    // Isi data ke form modal
    document.getElementById("modal-id").value = button.getAttribute("data-id");
    document.getElementById("modal-jenis2").value =
        button.getAttribute("data-jenis2");
    document.getElementById("modal-pokok_dibayar2").value = formatRupiah(
        button.getAttribute("data-pokok_dibayar2")
    );
    document.getElementById("modal-bunga_dibayar2").value = formatRupiah(
        button.getAttribute("data-bunga_dibayar2")
    );
    document.getElementById("modal-denda_dibayar2").value = formatRupiah(
        button.getAttribute("data-denda_dibayar2")
    );
    document.getElementById("modal-jumlah_pembayaran2").value = formatRupiah(
        button.getAttribute("data-jumlah_pembayaran2")
    );
    document.getElementById("modal-pokok2").value = formatRupiah(
        button.getAttribute("data-pokok2")
    );
});

const modal1 = document.getElementById("exampleModalTabungan");
modal1.addEventListener("show.bs.modal", function (event) {
    const button = event.relatedTarget;

    // Isi data ke form modal
    document.getElementById("modal-id").value = button.getAttribute("data-id");
    document.getElementById("modal-jenistabungan").value =
        button.getAttribute("data-jenis1");
    document.getElementById("modal-pembayarantabungan").value = formatRupiah(
        button.getAttribute("data-pembayarantabungan")
    );
    document.getElementById("modal-tabungansebelumnya").value = formatRupiah(
        button.getAttribute("data-tabungansebelumnya")
    );
    document.getElementById("modal-sisatabungan").value = formatRupiah(
        button.getAttribute("data-sisatabungan")
    );
});
