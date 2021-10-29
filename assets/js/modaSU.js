// Start Modal Đăng ký
const signUp = document.querySelector('.js-signup');
const modaSU = document.querySelector('.js-modaSU');
const modaContainerSU = document.querySelector('.js-modaSU-container');
const modaCloseSU = document.querySelector('.js-modaSU-close');

// Hàm hiển thị Modal đăng ký (thêm class open vào moda)
function showForm() {
    modaSU.classList.add('open')
}

// Hàm ẩn Modal đăng ký (gỡ bỏ class open của moda)
function hideForm() {
    modaSU.classList.remove('open')
}

// Nghe hành vi click cùa "Đăng ký"
signUp.addEventListener('click', showForm)


// Nghe hành vi click vào button close
modaCloseSU.addEventListener('click', hideForm)

modaSU.addEventListener('click', hideForm)

modaContainerSU.addEventListener('click', function (event) {
    event.stopPropagation()
})
// End Modal đăng ký