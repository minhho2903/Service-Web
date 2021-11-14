$(document).ready(function()
{ 
    //khai báo biến submit form lấy đối tượng nút submit
    const submit = $("button[type='submit']");
    
    //khi nút submit được click
    submit.click(function()
    {
    //khai báo các biến dữ liệu gửi lên server
    var select = $("select[name='time']").val();
    var service = $("input[name='service']").val();
    var type = $("input[name='type']").val();

    if(select == '' || service == '' || type == ''){
        return false;
    }

    //Lấy toàn bộ dữ liệu trong Form
    var datas = $('form#form_input').serialize();
    
    //Sử dụng phương thức Ajax.
    $.ajax({
            type : 'POST', //Sử dụng kiểu gửi dữ liệu POST
            url : 'buy-token.php',
            data : datas, //dữ liệu sẽ được gửi
            success : function(data)  // Hàm thực thi khi nhận dữ liệu được từ server
                    { 
                        $('div#show-token').html(data);
                    }
            });
            return false;
    });
});