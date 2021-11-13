$(document).ready(function()
{ 
    //khai báo biến submit form lấy đối tượng nút submit
    var submit = $("button[type='submit']");

    //khi nút submit được click
    submit.click(function()
    {
    //khai báo các biến dữ liệu gửi lên server
    var token = $("input[name='tokenName']").val(); //lấy giá trị trong input user

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
            url : 'data.php', //gửi dữ liệu sang trang data.php
            data : datas, //dữ liệu sẽ được gửi
            success : function(data)  // Hàm thực thi khi nhận dữ liệu được từ server
                    { 
                        if(data == 'false') 
                        {
                        alert('Token không tồn tại');
                        }else{
                        $('#get_modal').html(data); //dữ liệu HTML trả về sẽ được chèn vào trong thẻ có id content
                        }
                    }
            });
            return false;
    });
});