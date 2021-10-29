// Start Modal đăng nhập
const signIn = document.querySelector('.js-signin');
const modaSI = document.querySelector('.js-modaSI');
const modaContainerSI = document.querySelector('.js-modaSI-container');
const modaCloseSI = document.querySelector('.js-modaSI-close');

// Hàm hiển thị Modal đăng nhập (thêm class open vào moda)
function showForm() {
    modaSI.classList.add('open')
}

// Hàm ẩn Modal đăng nhập (gỡ bỏ class open của moda)
function hideForm() {
    modaSI.classList.remove('open')
}

// Nghe hành vi click cùa "Đăng nhập"
signIn.addEventListener('click', showForm)


// Nghe hành vi click vào button close
modaCloseSI.addEventListener('click', hideForm)

modaSI.addEventListener('click', hideForm)

modaContainerSI.addEventListener('click', function (event) {
    event.stopPropagation()
})
// End Modal đăng nhập