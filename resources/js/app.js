import './bootstrap';
import 'tinymce/tinymce';
import 'tinymce/skins/ui/oxide/skin.min.css';
import 'tinymce/skins/content/default/content.min.css';
import 'tinymce/skins/content/default/content.css';
import 'tinymce/icons/default/icons';
import 'tinymce/themes/silver/theme';
import 'tinymce/models/dom/model';
import 'tinymce/plugins/lists/plugin.js';
import Alpine from 'alpinejs';
import $ from 'jquery';

window.addEventListener('DOMContentLoaded', () => {
    tinymce.init({
        selector: 'textarea',
        plugins: ['code', 'lists'],
        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
    });

    const clearButton = document.getElementById("clear-image");
    const imageInput = document.getElementById("image");
    const imagePreview = document.getElementById("image-preview-image");

    if (imageInput != null) {
        imageInput.addEventListener("change", function () {
            if (imageInput.value !== "") {
                clearButton.style.display = "inline-block";
                imagePreview.style.display = "inline-block";
                previewImage();
            } else {
                clearButton.style.display = "none";
                imagePreview.style.display = "none";

                clearImagePreview();
            }
        });
    }

    if (clearButton != null) {
        clearButton.addEventListener("click", function () {
            imageInput.value = "";
            clearButton.style.display = "none";
            imagePreview.style.display = "none";

            clearImagePreview();
        });
    }

    function previewImage() {
        if (imageInput.files && imageInput.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                imagePreview.src = e.target.result;
            };

            reader.readAsDataURL(imageInput.files[0]);
        }
    }

    function clearImagePreview() {
        imagePreview.src = '';
    }

    $('.delete-post').on('click', function () {
        const postId = $(this).closest('.post').data('post-id');

        $.ajax({
            url: `/post`,
            type: 'DELETE',
            data: {
                id: postId
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function () {
                $(`.post[data-post-id="${postId}"]`).remove();
            },
            error: function () {
                alert('Failed to delete post. Please try again later.');
            }
        });
    });
});

window.Alpine = Alpine;

Alpine.start();
