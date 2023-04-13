<!DOCTYPE html>
<html>
  <head>
    <title>Login Page</title>
    <style>
      body {
        background-color: #F8F8F8;
        font-family: Arial, sans-serif;
      }
      .container {
        background-color: #FFFFFF;
        border-radius: 10px;
        box-shadow: 0px 0px 10px #AAAAAA;
        margin: auto;
        max-width: 400px;
        padding: 20px;
        text-align: center;
        margin-top: 50px;
      }
      h1 {
        color: #555555;
        font-size: 28px;
        margin-bottom: 30px;
      }
      input[type=text], input[type=password] {
        border-radius: 5px;
        border: none;
        box-shadow: 0px 0px 5px #AAAAAA;
        margin-bottom: 20px;
        padding: 10px;
        width: 100%;
      }
      input[type=submit] {
        background-color: #4CAF50;
        border: none;
        border-radius: 5px;
        color: #FFFFFF;
        cursor: pointer;
        font-size: 16px;
        margin-top: 20px;
        padding: 10px;
        width: 100%;
      }
      input[type=submit]:hover {
        background-color: #3E8E41;
      }

    </style>
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  </head>
  <body>
    <div class="container">
      <h1>Login</h1>
      <div id="alert"></div>
      <form action="../handlers/allHandlers.php" method="post" id="login">
        <input type="text" placeholder="Username" name="username" required>
        <input type="password" placeholder="Password" name="password" required>
        <input type="submit" name="login" value="Login">
      </form>
      <div class="error">Invalid username or password</div>
    </div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $(".error").hide();
  $("#login").click(function(){
    var username = $('input[name=username]').val(); 
    var password = $('input[name=password]').val(); 
    var btn = $(this).val();
    event.preventDefault();
    $.ajax({
      url: "../handlers/allHandlers.php",
      type: "POST",
      data: {username: username, password: password, login: btn},
      success: function(response){
        $("#alert").fadeTo(2000, 500).slideUp(500, function(){
          $("#alert").slideUp(500);
        });
        var data = JSON.parse(response);
        if(data["status"] !== 200) {
            $("#alert").html("<div class='alert alert-danger'> <strong>Message! </strong>"+data["message"]+"</div>")
        } else if(data["status"] == 200){
            $("#alert").html("<div class='alert alert-success'> <strong>Message! </strong>"+data["message"]+"</div>")
            window.location.href = 'index.php';
          }
      }
    });
    return false;
  });
});
</script>
  </body>
</html>
