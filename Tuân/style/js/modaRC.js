// Start Modal Nạp tiền
const getRCs = document.querySelectorAll('.js-recharge');
const modaRC = document.querySelector('.js-modaRC');
const modaContainerRC = document.querySelector('.js-modaRC-container');
const modaCloseRC = document.querySelector('.js-modaRC-close');

// Hàm hiển thị Modal Nạp tiền (thêm class open vào moda)
function showForm() {
    modaRC.classList.add('open')
}

// Hàm ẩn Modal Nạp tiền (gỡ bỏ class open của moda)
function hideForm() {
    modaRC.classList.remove('open')
}

// Nghe hành vi click vào "Nạp tiền" và icon money
for (const getRC of getRCs) {
    getRC.addEventListener('click', showForm)
}


// Nghe hành vi click vào button close
modaCloseRC.addEventListener('click', hideForm)

modaRC.addEventListener('click', hideForm)

modaContainerRC.addEventListener('click', function (event) {
    event.stopPropagation()
})
// End Modal Nạp tiền