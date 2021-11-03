// Start Modal edit token
const editETs = document.querySelectorAll('.js-ET');
const modaET = document.querySelector('.js-modaET');
const modaContainerET = document.querySelector('.js-modaET-container');
const modaCloseET = document.querySelector('.js-modaET-close');

// Hàm hiển thị Modal edit token (thêm class open vào moda)
function showForm() {
    modaET.classList.add('open')
}

// Hàm ẩn Modal edit token (gỡ bỏ class open của moda)
function hideForm() {
    modaET.classList.remove('open')
}

// Nghe hành vi click vào "edit" trong page "manage-token"
for (const editET of editETs) {
    editET.addEventListener('click', showForm)
}


// Nghe hành vi click vào button close
modaCloseET.addEventListener('click', hideForm)

modaET.addEventListener('click', hideForm)

modaContainerET.addEventListener('click', function (event) {
    event.stopPropagation()
})
// End Modal edit token