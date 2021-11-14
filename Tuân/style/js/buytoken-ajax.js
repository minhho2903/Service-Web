$(document).ready(function()
{ 
    //khai báo biến submit form lấy đối tượng nút submit
    const submit = $("button.btn_get");
    
    //khi nút submit được click
    submit.click(function()
    {
    //khai báo các biến dữ liệu gửi lên server
    var select = $('select').val();
    var service = $("input[name='recharge']").val();
    var type = $("input[name='recharge']").val();

    //Kiểm tra xem trường đã được nhập hay chưa
    if(username == ''){
        alert('Vui lòng nhập Username cần nạp');
        return false;
    }

    if(addCoin == ''){
        alert('Vui lòng nhập số XU cần nạp, 10 - 1000');
        return false;
    }

    //Lấy toàn bộ dữ liệu trong Form
    var datas = $('form#form_input').serialize();
    
    //Sử dụng phương thức Ajax.
    $.ajax({
        type : 'POST', //Sử dụng kiểu gửi dữ liệu POST
        url : './fsadf.php',
        data : datas, //dữ liệu sẽ được gửi
        success : function(data)  // Hàm thực thi khi nhận dữ liệu được từ server
            { 
                $('.message').html(data);
            }
        });
        return false;
    });
});