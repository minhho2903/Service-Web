// Start Modal Bảo hành
const warAcc = document.querySelector('.js-warranty');
const modaWA = document.querySelector('.js-modaWA');
const modaContainerWA = document.querySelector('.js-modaWA-container');
const modaCloseWA = document.querySelector('.js-modaWA-close');

// Hàm hiển thị Modal Bảo hành (thêm class open vào moda)
function showForm() {
    modaWA.classList.add('open')
}

// Hàm ẩn Modal Bảo hành (gỡ bỏ class open của moda)
function hideForm() {
    modaWA.classList.remove('open')
}

// Nghe hành vi click cùa "Bảo hành"
warAcc.addEventListener('click', showForm)


// Nghe hành vi click vào button close
modaCloseWA.addEventListener('click', hideForm)

// modaWA.addEventListener('click', hideForm)

modaContainerWA.addEventListener('click', function (event) {
    event.stopPropagation()
})
// End Modal Bảo hành