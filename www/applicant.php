
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="CSS/main.css">
    <link rel="stylesheet" type="text/css" href="CSS/header.css">
    <link rel="stylesheet" type="text/css" href="CSS/sidePanel.css">
    <link rel="stylesheet" type="text/css" href="CSS/content.css">

    <script type="text/javascript" src="JS/main.js" ></script>

    <script type="text/javascript" src="JS/jquery-321js-1.js" ></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script>
    var codeMailRandom;
    var passwordTrue = 'false';
    
    $( document ).ready(function(){
	  $( "#Ajax" ).click(function(){ // задаем функцию при нажатиии на элемент #Ajax
	    $.ajax({
            url: 'PHP/user/mail_check.php',
            type: "POST",
            data: { // данные, которые будут отправлены на сервер
	            surname: surname_r.val(),
                name: name_r.val(),
                patronymic: patronymic_r.val(),
                mail: mail_r.val(),
                password: $("#password").val(),
                passwordTrue: passwordTrue
	        },
            success: function(data) {
                if (data == 'false')
                {
                    $("#login_sms3").text('Пользователь с такой почтой уже зарегистрирован!');
                }
                else if (data == 'true')
                {
                    alert ('Поздравляем! Вы успешно зарегистрировались на нашем сервере.');
                    passwordTrue = 'false';
                  
                }
                else
                {
                    codeMailRandom = data;
                    alert ("На вашу почту был отправлен код потверждения. Пожалуйста введите его.");
                    codeMailBox ();
                }
            }
        });
	  });
    });	
    </script>

    <title>Ищу работу в Кыргызстане | Frame set.kg</title>

</head>

<body>

    <div id="main">
        <div class="main-box">
            <?php include 'PHP/header.php'; ?>
        </div>

        <div class="main-box">
            <?php include 'PHP/sidePanel/applicantSidePanel.php'; ?>
        </div>

        <div class="main-box">  
            <?php include 'PHP/content.php'; ?>
       </div>
    </div>

</body>
</html>