// Start Modal edit user
const editEUs = document.querySelectorAll('.js-EU');
const modaEU = document.querySelector('.js-modaEU');
const modaContainerEU = document.querySelector('.js-modaEU-container');
const modaCloseEU = document.querySelector('.js-modaEU-close');

// Hàm hiển thị Modal edit user (thêm class open vào moda)
function showForm() {
    modaEU.classList.add('open')
}

// Hàm ẩn Modal edit user (gỡ bỏ class open của moda)
function hideForm() {
    modaEU.classList.remove('open')
}

// Nghe hành vi click vào "edit" trong page "manage-user"
for (const editEU of editEUs) {
    editEU.addEventListener('click', showForm)
}


// Nghe hành vi click vào button close
modaCloseEU.addEventListener('click', hideForm)

modaEU.addEventListener('click', hideForm)

modaContainerEU.addEventListener('click', function (event) {
    event.stopPropagation()
})
// End Modal edit user