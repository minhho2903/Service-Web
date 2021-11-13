// Start Modal information detail
const viewIDs = document.querySelectorAll('.js-ID');
const modaID = document.querySelector('.js-modaID');
const modaContainerID = document.querySelector('.js-modaID-container');
const modaCloseID = document.querySelector('.js-modaID-close');

// Hàm hiển thị Modal information detail (thêm class open vào moda)
function showForm() {
    modaID.classList.add('open')
}

// Hàm ẩn Modal information detail (gỡ bỏ class open của moda)
function hideForm() {
    modaID.classList.remove('open')
}

// Nghe hành vi click vào "information detail" trong page "manage-list"
for (const viewID of viewIDs) {
    viewID.addEventListener('click', showForm)
}


// Nghe hành vi click vào button close
modaCloseID.addEventListener('click', hideForm)

modaID.addEventListener('click', hideForm)

modaContainerID.addEventListener('click', function (event) {
    event.stopPropagation()
})
// End Modal information detail