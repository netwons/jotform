<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="<?= Url('/css/font.css');?>">
    <script type="text/javascript" src="<?= Url('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js');?>"></script>
</head>
<body>

<div>
    Name:<input type="text" name="name" id="name">
    <span id="name_error"></span>
</div>
<br>
<div>
    email:<input type="email" name="email" id="email">
    <span id="email_error"></span>
</div>
<br>
<div>
    password:<input type="password" name="password" id="password">
    <span id="password_error"></span>
</div>
<br>
<span id="success_message"></span>
<button id="save_button">Save</button>
<span class="gg">masoud مسعود</span>

</body>

</html>
<script type="text/javascript">
//    $(document).ready(function(){
//       $('#save_button').click(function(){
//           var name=$("#name").val();
//           var email=$("#email").val();
//           var password=$("#password").val();
//           $.ajax({
//              url:"http://localhost:8000/api/save",
//               post:"POST",
//               data:{
//                  name:name,
//                   email:email,
//                   password:password
//               },
//               success:function (data) {
//                   $("#name_error").html();
//                   $("#email_error").html();
//                   $("#password_error").html();
//                   $("#success_message").html("successfull");
//               },
//               error:function (data) {
//                   $("#name_error").html();
//                   $("#email_error").html();
//                   $("#password_error").html();
//                   $("#success_message").html("");
//                   var error=data.responseJSON;
//                   $.each(error,function(key,value){
//                      if(key=='name'){
//                          $("name_error").html(value);
//                      }
//                       if(key=='email'){
//                           $("email_error").html(value);
//                       }
//                       if(key=='password'){
//                           $("password_error").html(value);
//                       }
//                   });
//               }
//           });
//
//       }) ;
//    });

</script>