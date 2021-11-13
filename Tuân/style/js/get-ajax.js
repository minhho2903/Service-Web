$(document).ready(function()
{ 
    //khai báo biến submit form lấy đối tượng nút submit
    const submit = $("button.btn_get");
    
    //khi nút submit được click
    submit.click(function()
    {
    //khai báo các biến dữ liệu gửi lên server
    var token = $("input[name='nameToken']").val(); //lấy giá trị trong input user
    var check = $("input[name='get-inf']").val();

    //Kiểm tra xem trường đã được nhập hay chưa
    if(token == ''){
        alert('Vui lòng nhập Token của bạn');
        return false;
    }

    //Lấy toàn bộ dữ liệu trong Form
    var datas = $('form#form_input').serialize();
    
    //Sử dụng phương thức Ajax.
    $.ajax({
            type : 'POST', //Sử dụng kiểu gửi dữ liệu POST
            url : 'get-info.php', //gửi dữ liệu sang trang data.php
            data : datas, check, //dữ liệu sẽ được gửi
            success : function(data)  // Hàm thực thi khi nhận dữ liệu được từ server
                    { 
                        $('#modaGA-main').html(data); //dữ liệu HTML trả về sẽ được chèn vào trong thẻ có id content
                    }
            });
            return false;
    });
});