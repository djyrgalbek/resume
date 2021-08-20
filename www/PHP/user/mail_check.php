<?php
  $surname = $_POST['surname']; 
  $name = $_POST['name']; 
  $patronymic = $_POST['patronymic']; 
  $mail = $_POST['mail'];
  $password = $_POST['password'];
  $passwordTrue = $_POST['passwordTrue'];

    $userDB = mysql_connect ("localhost","root","","user");
    mysql_set_charset ("utf-8", $userDB);
    mysql_select_db ("user", $userDB) or die("Нет соединения с БД. ".mysql_error());

    $userData = mysql_query ("SELECT * FROM `applicant` WHERE `mail` = '$mail' ", $userDB);
    $num_rows=mysql_num_rows($userData);

    if ($num_rows != 0)
    {
        echo 'false';
    }
    else if ($passwordTrue == 'true')
    {
        mysql_query ("INSERT INTO `applicant`(`id`, `mail`, `surname`, `name`, `patronymic`, `password`) VALUES (NULL, '$mail', '$surname', '$name', '$patronymic', '$password')", $userDB);
        echo 'true';

        mail(
            $mail,
            'Потверждение почты',
            '<html><body style="background: #aec792;">
            <div style="width: 100%; padding: 5px; background: #ecb41c; color: white; margin-bottom: 7px;"><p align="center"><b><span style="color: #0f6acf;">F</span>rame-Set.kg</b></p></div>
            <p style="margin-bottom: 20px;">Поздравляем! Вы зарегистрировались на сайте Frame-Set.kg как <b>соискатель</b>
            <br /><br />Ваши персональные данные:<br />
            <b>ФИО: </b>'.$surname.' '.$name.' '.$patronymic.'<br />
            <b>Логин: </b>'.$mail.'<br />
            <b>Пароль: </b>'.$password.'
            <br /><br />Надеемся, что наш сервис поможет вам найти работу Вашей мечты!)</p>
            
            <p align="right">С уважением, команда <b>Frame-Set.kg</b></p>
            </body></html>',
            "From: t.jyrgal@bk.ru\r\n"
            ."Content-type: text/html; charset=utf-8\r\n"
            ."X-Mailer: PHP mail script");
    }
    else
    {
        $rand = rand(10000, 99999);
        echo $rand;
        mail(
        $mail,
        'Потверждение почты',
        '<html><body style="background: #aec792;">
        <div style="width: 100%; padding: 5px; background: #ecb41c; color: white; margin-bottom: 7px;"><p align="center"><b><span style="color: #0f6acf;">F</span>rame-Set.kg</b></p></div>
        <p style="margin-bottom: 20px;">До завершения регистрации остались считанные шаги). Для потверждения, укажите код ниже в поле регистрации на сайте.
    
        <br /><br /><b>Код потверждения: </b>'.$rand.'
        <br />Если вы не отправляли это письмо, то просто проигнорируйте.</p>
        <p align="right">С уважением, команда <b>Frame-Set.kg</b></p>
        </body></html>',
        "From: t.jyrgal@bk.ru\r\n"
        ."Content-type: text/html; charset=utf-8\r\n"
        ."X-Mailer: PHP mail script");

    }
    
    mysql_close();
