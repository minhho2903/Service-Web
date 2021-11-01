// Start Modal Thông tin chi tiết
const details = document.querySelector('.js-details');
const modaDT = document.querySelector('.js-modaDT');
const modaContainerDT = document.querySelector('.js-modaDT-container');
const modaCloseDT = document.querySelector('.js-modaDT-close');

// Hàm hiển thị Modal Thông tin chi tiết (thêm class open vào moda)
function showForm() {
    modaDT.classList.add('open')
}

// Hàm ẩn Modal Thông tin chi tiết (gỡ bỏ class open của moda)
function hideForm() {
    modaDT.classList.remove('open')
}

// Nghe hành vi click của "Thông tin chi tiết"
details.addEventListener('click', showForm)


// Nghe hành vi click vào button close
modaCloseDT.addEventListener('click', hideForm)

// click ra ngoài để thoát moda
modaDT.addEventListener('click', hideForm)

modaContainerDT.addEventListener('click', function (event) {
    event.stopPropagation()
})
// End Modal Thông tin chi tiết