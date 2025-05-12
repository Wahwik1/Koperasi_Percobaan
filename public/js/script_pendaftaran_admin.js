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
    document.querySelectorAll(".nik").forEach(function (input) {
        input.addEventListener("input", function (e) {
            e.target.value = e.target.value.replace(/[^0-9]/g, ""); // Hanya angka
            if (input.value.length > 16) {
                input.value = input.value.slice(0, 16); // Potong jika lebih dari 3 angka
            }
        });
    });
    document.querySelectorAll(".nohp").forEach(function (input) {
        input.addEventListener("input", function (e) {
            e.target.value = e.target.value.replace(/[^0-9]/g, ""); // Hanya angka
            if (input.value.length > 12) {
                input.value = input.value.slice(0, 12); // Potong jika lebih dari 3 angka
            }
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("formku");

    form.addEventListener("submit", function (e) {
        e.preventDefault(); // ⛔ mencegah form langsung terkirim

        const name = form.querySelector('input[name="name"]').value.trim();
        const email = form.querySelector('input[name="email"]').value.trim();
        const nik = form.querySelector('input[name="nik"]').value.trim();
        const nohp = form.querySelector('input[name="nohp"]').value.trim();
        const alamat = form.querySelector('input[name="alamat"]').value.trim();
        const password = form
            .querySelector('input[name="password"]')
            .value.trim();
        const foto = form.querySelector('input[name="foto"]').files[0];
        const verifikasi = document.getElementById("verifikasi_password").value;

        if (!name || !email || !nik || !nohp || !alamat || !password || !foto) {
            Swal.fire({
                icon: "error",
                title: "Oops!",
                text: "Semua field wajib diisi termasuk foto KTP.",
            });
            return;
        }

        if (foto && foto.type !== "image/png") {
            Swal.fire({
                icon: "error",
                title: "File tidak valid!",
                text: "Foto KTP harus berupa file PNG.",
            });
            return;
        }

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

document.getElementById("formku").addEventListener("submit", function (e) {
    const password = document.getElementById("password").value;
    const verifikasi = document.getElementById("verifikasi_password").value;

    if (password !== verifikasi) {
        e.preventDefault();
        Swal.fire({
            icon: "error",
            title: "Password Tidak Sama",
            text: "Silahkan Coba Lagi",
        });
        return;
    }
});
