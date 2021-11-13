<html>
    <head>
        <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
    </head>
    <body>
        <form class="form-horizontal" id="form_input">
            <input type="text" name="user">
            <input type="text" name="fname">
            <button type="submit">Gửi</button>
        </form>
        
        <div id="content"></div>

        <script>
          $(document).ready(function()
          { 
              //khai báo biến submit form lấy đối tượng nút submit
              var submit = $("button[type='submit']");

              //khi nút submit được click
              submit.click(function()
              {
                //khai báo các biến dữ liệu gửi lên server
                var user = $("input[name='user']").val(); //lấy giá trị trong input user
                var fullname = $("input[name='fname']").val(); //lấy giá trị trong input user
        
                //Kiểm tra xem trường đã được nhập hay chưa
                if(user == '' || fullname == ''){
                  alert('Vui lòng nhập đầy đủ thông tin');
                  return false;
                }
        
                //Lấy toàn bộ dữ liệu trong Form
                var datas = $('form#form_input').serialize();
              
                //Sử dụng phương thức Ajax.
                $.ajax({
                      type : 'POST', //Sử dụng kiểu gửi dữ liệu POST
                      url : 'test1.php', //gửi dữ liệu sang trang data.php
                      data : datas, //dữ liệu sẽ được gửi
                      success : function(data)  // Hàm thực thi khi nhận dữ liệu được từ server
                                { 
                                  if(data == 'false') 
                                  {
                                    alert('Không có người dùng');
                                  }else{
                                    $('#content').html(data); //dữ liệu HTML trả về sẽ được chèn vào trong thẻ có id content
                                  }
                                }
                      });
                      return false;
                });
            });
        </script>
        
    </body>
</html>

