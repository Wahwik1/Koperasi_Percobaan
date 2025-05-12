document.querySelector(".hamburger").addEventListener("click", function () {
    document.querySelector(".sidebar").classList.toggle("show");
});

document.addEventListener("DOMContentLoaded", function () {
    // Pilih semua tombol edit
    const editButtons = document.querySelectorAll(".edit-btn");

    // Loop setiap tombol
    editButtons.forEach((button) => {
        button.addEventListener("click", function () {
            // Ambil nilai dari atribut data-*
            const id = this.dataset.id;
            const name = this.dataset.name;
            const email = this.dataset.email;
            const ttl = this.dataset.ttl;
            const nik = this.dataset.nik;
            const nohp = this.dataset.nohp;
            const alamat = this.dataset.alamat;
            const password = this.dataset.password;

            // Set nilai ke dalam form modal
            document.getElementById("modal-id").value = id;
            document.getElementById("modal-name").value = name;
            document.getElementById("modal-email").value = email;
            document.getElementById("modal-ttl").value = ttl;
            document.getElementById("modal-nik").value = nik;
            document.getElementById("modal-nohp").value = nohp;
            document.getElementById("modal-alamat").value = alamat;
            document.getElementById("modal-password").value = password;
        });
    });

    document.querySelectorAll(".form-hapus").forEach((form) => {
        form.addEventListener("submit", function (e) {
            e.preventDefault();

            Swal.fire({
                title: "Apakah Yakin Di Hapus?",
                text: "Klik Ya Jika Sudah Yakin",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya",
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // submit form ini
                }
            });
        });
    });
});
