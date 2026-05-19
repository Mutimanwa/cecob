document.addEventListener('DOMContentLoaded', function () {

    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');
    const uploadIcon = document.getElementById('uploadIcon');

    imageInput.addEventListener('change', function (event) {

        const file = event.target.files[0];

        if (!file) {
            return;
        }

        // Vérification image
        if (!file.type.startsWith('image/')) {
            alert('Veuillez sélectionner une image valide.');
            return;
        }

        // Lecture fichier
        const reader = new FileReader();

        reader.onload = function (e) {

            imagePreview.src = e.target.result;

            imagePreview.classList.remove('d-none');

            uploadIcon.classList.add('d-none');
        };

        reader.readAsDataURL(file);

    });

});