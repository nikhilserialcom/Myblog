let sidebar = document.querySelector(".sidebar");
let closeBtn = document.querySelector("#btn");
let searchBtn = document.querySelector(".bx-search");
// const url = 'http://127.0.0.1:8000/api/search';
const search = document.getElementById('search');
const data_in_tr = document.querySelector('.data_in_tr');

const alert_box = document.querySelector('.alert');

closeBtn.addEventListener("click", () => {
    sidebar.classList.toggle("open");
    menuBtnChange();//calling the function(optional)
});

// following are the code to change sidebar button(optional)
function menuBtnChange() {
    if (sidebar.classList.contains("open")) {
        closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
    } else {
        closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");//replacing the iocns class
    }
}

$('.counter').counterUp({
    delay: 10,
    time: 1000
});

// resources/js/app.js or in your Blade file
function previewImage(event) {
    const imagePreview = document.getElementById('imagePreview');
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function () {
        imagePreview.src = reader.result;
        imagePreview.style.display = 'block';
    };

    if (file) {
        reader.readAsDataURL(file);
    }
}

setTimeout(() => {
    if (alert_box) {
        alert_box.style.display = 'none';
    }
}, 2000);


const delete_category_btn = document.querySelectorAll('.delete_category_btn');
// console.log(delete_category_btn);

delete_category_btn.forEach(element => {
    element.addEventListener('click', () => {
        const category_id = element.value;
        console.log(category_id);
        $('#deleteModal').modal('show');
        $('#category_id').val(category_id);
    })
});


// CKEDITOR.replace('body',{
//     filebrowserUploadUrl: document.querySelector('#editor').getAttribute('data-upload-url') + '?_token=' + document.querySelector('#editor').getAttribute('data-csrf-token'),
//     filebrowserUploadMethod:"form",

// });

ClassicEditor
    .create(document.querySelector('#editor'),{
            ckfinder:{
                uploadUrl: document.querySelector('#editor').getAttribute('data-upload-url') + '?_token=' + document.querySelector('#editor').getAttribute('data-csrf-token'),
            }
         })
         .then(editor => {
                console.log(editor);
        })
        .catch(error => {
                console.error(error);
        });


