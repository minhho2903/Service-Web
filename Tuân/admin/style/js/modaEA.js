// Start Modal edit user
const editEAs = document.querySelectorAll('.js-EA');
const modaEA = document.querySelector('.js-modaEA');
const modaContainerEA = document.querySelector('.js-modaEA-container');
const modaCloseEA = document.querySelector('.js-modaEA-close');

// Hàm hiển thị Modal edit user (thêm class open vào moda)
function showForm() {
    modaEA.classList.add('open')
}

// Hàm ẩn Modal edit user (gỡ bỏ class open của moda)
function hideForm() {
    modaEA.classList.remove('open')
}

// Nghe hành vi click vào "edit" trong page "manage-user"
for (const editEA of editEAs) {
    editEA.addEventListener('click', showForm)
}


// Nghe hành vi click vào button close
modaCloseEA.addEventListener('click', hideForm)

modaEA.addEventListener('click', hideForm)

modaContainerEA.addEventListener('click', function (event) {
    event.stopPropagation()
})
// End Modal edit user