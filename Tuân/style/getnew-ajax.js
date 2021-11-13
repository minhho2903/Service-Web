$(document).ready(function()
{ 
    //khai báo biến submit form lấy đối tượng nút submit
    const submitNew = $("button.btn_new");
    
    //khi nút submit được click
    submitNew.click(function()
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
            url : 'get-new.php', //gửi dữ liệu sang trang get-new.php
            data : datas, //dữ liệu sẽ được gửi
            success : function(data)  // Hàm thực thi khi nhận dữ liệu được từ server
                    { 
                        $('.modal_get').html(data); //dữ liệu HTML trả về sẽ được chèn vào trong thẻ có class modal_get
                    }
            });
            return false;
    });
});