<script>
    document.addEventListener("DOMContentLoaded", function() {

        const input = document.getElementById('uploadFoto');
        const preview = document.getElementById('previewImage');
        const defaultIcon = document.getElementById('defaultIcon');

        if (input) {
            input.addEventListener('change', function(e) {
                const file = e.target.files[0];

                if (file) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                        defaultIcon.classList.add('hidden');
                    };

                    reader.readAsDataURL(file);
                }
            });
        }

    });

    document.getElementById('uploadFoto').addEventListener('change', function() {

        const formData = new FormData();
        formData.append('foto', this.files[0]);
        formData.append('_token', '{{ csrf_token() }}');

        fetch("{{ route('profile.foto') }}", {
                method: "POST",
                body: formData
            })
            .then(res => res.json())
            .then(() => {
                showToast("Foto berhasil diupdate", "success");
            });
    });
</script>
