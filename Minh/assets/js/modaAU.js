// Start Modal add user
const addAU = document.querySelector('.js-AU');
const modaAU = document.querySelector('.js-modaAU');
const modaContainerAU = document.querySelector('.js-modaAU-container');
const modaCloseAU = document.querySelector('.js-modaAU-close');

// Hàm hiển thị Modal add user (thêm class open vào moda)
function showForm() {
    modaAU.classList.add('open')
}

// Hàm ẩn Modal add user (gỡ bỏ class open của moda)
function hideForm() {
    modaAU.classList.remove('open')
}

// Nghe hành vi click vào "add" trong page "manage-user"
addAU.addEventListener('click', showForm)

// Nghe hành vi click vào button close
modaCloseAU.addEventListener('click', hideForm)

modaAU.addEventListener('click', hideForm)

modaContainerAU.addEventListener('click', function (event) {
    event.stopPropagation()
})
// End Modal add user