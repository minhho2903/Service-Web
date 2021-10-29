// Start Modal Nhận tài khoản
const getAcc = document.querySelector('.js-getacc');
const modaGA = document.querySelector('.js-modaGA');
const modaContainerGA = document.querySelector('.js-modaGA-container');
const modaCloseGA = document.querySelector('.js-modaGA-close');

// Hàm hiển thị Modal Nhận tài khoản (thêm class open vào moda)
function showForm() {
    modaGA.classList.add('open')
}

// Hàm ẩn Modal Nhận tài khoản (gỡ bỏ class open của moda)
function hideForm() {
    modaGA.classList.remove('open')
}

// Nghe hành vi click cùa "Nhận tài khoản"
getAcc.addEventListener('click', showForm)


// Nghe hành vi click vào button close
modaCloseGA.addEventListener('click', hideForm)

// modaGA.addEventListener('click', hideForm)

modaContainerGA.addEventListener('click', function (event) {
    event.stopPropagation()
})
// End Modal Nhận tài khoản