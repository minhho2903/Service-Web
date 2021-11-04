var cedit = document.querySelectorAll('.js-EU');
var showValueId = document.querySelector('.output-id');
var formAction = document.querySelector('form');
for(var i of cedit) { 
    i.addEventListener('click', function(e) {
        //Hiển thị giá trị của id
        valueId = e.path[3].childNodes[1].innerHTML;
        showValueId.innerHTML = valueId;
        // Kiểm tra độ dài của form với đầu vào là input
        check = e.path[7].childNodes[13].childNodes[1].childNodes[5].childNodes[1];
        for(var x = 3,y = 0; y < check.length - 1; y++, x+=2) {
            //Biến value đươc bắt sự kiện từ btn edit và lấy giá trị của row
            const value = e.path[3].childNodes[x].innerHTML;
            //Biến showValue được bắt sự kiện đến form input 
            const showValue = e.path[7].childNodes[13].childNodes[1].childNodes[5].childNodes[1][y];
            //đưa giá trị đã lấy từ row ghi vào input
            showValue.value = value;
        }
        //Lấy giá trị của id đưa vào action 
        formAction.action = `user-edit.php?id=${valueId}`;
    });
}