document.querySelector(".hamburger").addEventListener("click", function () {
    document.querySelector(".sidebar").classList.toggle("show");
});

document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("formku");

    form.addEventListener("submit", function (e) {
        e.preventDefault(); // ⛔ mencegah form langsung terkirim

        const password = document.getElementById("password").value;
        const verifikasi = document.getElementById("verifikasi_password").value;

        if (password !== verifikasi) {
            Swal.fire({
                icon: "error",
                title: "Password Tidak Sama",
                text: "Silahkan Coba Lagi",
            });
            return;
        }

        if (password.length < 6) {
            Swal.fire({
                icon: "error",
                title: "Password Harus Lebih Dari 6 Karakter",
                text: "Silahkan Coba Lagi",
            });
            return;
        }

        if (!/\d/.test(password)) {
            Swal.fire({
                icon: "error",
                title: "Password Tidak Ada Angka",
                text: "Silahkan Coba Lagi",
            });
            return;
        }

        // tampilkan konfirmasi
        Swal.fire({
            title: "Apakah Data Sudah Benar ? ",
            text: "Klik Ya Jika Sudah Yakin",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya",
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); // ✅ submit manual setelah konfirmasi
            }
        });
    });
});
