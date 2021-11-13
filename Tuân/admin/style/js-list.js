var cedit = document.querySelectorAll('.js-edit');
var showValueId = document.querySelector('.output-id');
var showValueName = document.querySelector('.output-name');
var formAction = document.querySelector('form');
var showRow = document.querySelectorAll('.table .row-select')
for(var i of cedit) {
    // i.addEventListener('click', function(e) {
    //     //Hiển thị giá trị của id
    //     valueId = e.path[3].childNodes[1].innerHTML;
    //     showValueId.innerHTML = valueId;
    //     valueName = e.path[3].childNodes[3].innerHTML;
    //     showValueName.innerHTML = valueName;
    //     // Kiểm tra độ dài của form với đầu vào là input
    //     check = e.path[6].childNodes[5].childNodes[3].childNodes[3].childNodes[1];
    //     for(var x = 5,y = 0; y < check.length - 2; y++, x+=2) {
    //         //Biến value đươc bắt sự kiện từ btn edit và lấy giá trị của row
    //         const value = e.path[3].childNodes[x].innerHTML;
    //         //Biến showValue được bắt sự kiện đến form input 
    //         const showValue = e.path[6].childNodes[5].childNodes[3].childNodes[3].childNodes[1][y];
    //         //đưa giá trị đã lấy từ row ghi vào input
    //         showValue.value = value;
    //     }
    //     //Lấy giá trị của id đưa vào action 
    //     formAction.action = `token-edit.php?id=${valueId}`;
    //     // console.log(e.path[6].childNodes)

    // });
    // i.addEventListener('click', function(e) {
    //     console.log(e);
    // })
}

