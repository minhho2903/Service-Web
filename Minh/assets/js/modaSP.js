// Start Modal Hỗ trợ
const support = document.querySelector('.js-support');
const modaSP = document.querySelector('.js-modaSP');
const modaContainerSP = document.querySelector('.js-modaSP-container');

// Hàm hiển thị Modal hỗ trợ (thêm class open vào moda)
function showForm() {
    modaSP.classList.add('open')
}

// Hàm ẩn Modal hỗ trợ (gỡ bỏ class open của moda)
function hideForm() {
    modaSP.classList.remove('open')
}

// Nghe hành vi click cùa "Hỗ trợ"
support.addEventListener('click', showForm)


// Click ra ngoài để thoát Modal
modaSP.addEventListener('click', hideForm)

modaContainerSP.addEventListener('click', function (event) {
    event.stopPropagation()
})
// End Modal Hỗ trợ