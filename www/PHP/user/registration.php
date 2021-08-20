<?php
    if (isset($_POST['mail']) && isset($_POST['surname']) && isset($_POST['name']) 
    && isset($_POST['patronymic']))

    {
        $mail = $_POST['mail'];
        $surname = $_POST['surname'];
        $name = $_POST['name'];
        $patronymic = $_POST['patronymic'];

    $userDB = mysql_connect ("localhost","root","","user");
    mysql_set_charset ("utf-8", $userDB);
    mysql_select_db ("user", $userDB) or die("Нет соединения с БД. ".mysql_error());


    $userData = mysql_query ("SELECT * FROM `applicant` WHERE `mail` = '$mail' ", $userDB);

    $num_rows=mysql_num_rows($userData);
    //echo "<br />Почта: $mail";
    //echo "<br />Количество похожих: $num_rows";

    if ($num_rows != 0)
    {
        echo '<script> alert ("Пользователь с таким именем уже существует!"); </script>';
        echo '<script> document.location.href="index.php"; </script>';
    }
    else
    {
        mysql_query ("INSERT INTO `applicant`(`id`, `mail`, `surname`, `name`, `patronymic`) VALUES (NULL, '$mail', '$surname', '$name', '$patronymic')", $userDB);
        echo '<script> document.location.href="index.php"; </script>';
    }

    mysql_close();
}
?>

<style>
    #registration
    {
        display: none;
        position: relative;
        top: 0px;
        width: 500px;
        background: #fff;
        border: 1px solid #dfdfdf;
        padding: 20px 20px 0px 20px;
        margin: auto;
        margin-bottom: 100px;
        opacity: 0;
        box-shadow: 0px 5px 20px #252525;
    }
    .registrationTitle{
        display: flex;
        flex-wrap: nowrap;
        width: auto;
        padding-bottom: 15px;
        background: #fff;
        border-bottom: 1px solid #ecb41c;
    }
    .registrationTitle div{
        width: 50%;
        /*background: green;*/
    }
    .registrationTitle h1
    {
        font: normal 20px 'Roboto Condensed', sans-serif;
        color: #000;
    }
    .registrationUser
    {
        display: flex;
        flex-wrap: nowrap;
        width: auto;
        padding-bottom: 20px;
        background: #fff;
        margin-top: 20px;
    }
    .registrationUser div
    {
        width: 50%;
        padding: 15px 20px 15px 0px;
        /*background: green;*/
    }
    .registrationUser h2
    {
        font: normal 17px 'Roboto Condensed', sans-serif;
        color: #000;
        margin-bottom: 8px;
    }
    .registrationUser input
    {
        width: calc(100% - 14px);
        padding: 5px 5px 5px 7px;
        font: normal 14px Arial, Tahoma sans-serif;
        color: #000;
        margin-bottom: 15px;
        border: 1px solid #a9a9a9;
    }
    .registrationUser div p
    {
        font: normal 12px Arial, Tahoma sans-serif;
        color: red;
        margin-bottom: 5px;
    }
    .registrationUser div .reg
    {
        margin-top: 15px;
        margin-bottom: 23px;
        width: calc(100% - 14px);
        padding: 7px;
        background: #19b421;
        text-align: center;
        font: normal 14px Arial, Tahoma sans-serif;
        color: #fff;
        border-radius: 3px;
        pointer-events: auto;
    }
    .registrationUser div .reg:hover
    {
        background: #1dc525;
    }
    .registrationUser div a
    {
        font: normal 14px Arial, Tahoma sans-serif;
        color: #ecb41c;
        text-decoration: underline;
    }
    .registrationUser div a:hover
    {
        color: #1dc525;
    }
    .registrationUser div img
    {
        display: inline-block;
        margin-bottom: 20px;
    }
    .registrationUser div .CodeMailBox,.registrationUser div .PasswordBox
    {
        display: none;
        width: 100%;
        padding: 0;
    }
    .registrationUser div .CodeMailBox h2
    {
        font-size: 15px;
    }
    .registrationUser div .CodeMailBox h2 .userMail
    {
        color: #1dc525;
    }
</style>
    <p id ="Ajax"></p>
<div class="Shadow_block" id="Shadow_block_reg">
    <div id="registration">
        <div class="registrationTitle">
            <div>
                <h1>Регистрация соискателя</h1>
            </div>
            <div>
                <img id="registrationExit" src="images/out.png" alt="Выход из окна регистрации Rezume.kg" width="15px" height="auto" style="display: none; float: right" onClick="RegCloseWindow()"/>
            </div>
        </div>

        <div class="registrationUser">
            <div>      
                <h2>Фамилия</h2>
                <p id="login_sms0"></p>
                <input type="text" id = "surname_r"  name="surname" onfocus="regFocus(this.id)" onblur="regBlur(this.id, 0)" placeholder="например: Айтматов" maxlength = "70" oninput = 'To_check_the_input(/[^а-яА-Яa-zA-Z\s]/g, this.value, this.id, "Фамилия может состоять только из русских и латинских букв!", 1, 0)' />
                
                <h2>Имя</h2>
                <p id="login_sms1"></p>
                <input type="text" id="name_r"  name="name" onfocus="regFocus(this.id)" onblur="regBlur(this.id, 1)" placeholder="например: Чынгыз" maxlength = "70" oninput = 'To_check_the_input(/[^а-яА-Яa-zA-Z\s]/, this.value, this.id, "Имя может состоять только из русских и латинских букв!", 1, 1)' />
                
                <h2>Отчество</h2>
                <p id="login_sms2"></p>
                <input type="text" id="patronymic_r"  name="patronymic" onfocus="regFocus(this.id)" onblur="regBlur(this.id, 2)" placeholder="например: Торекулович" maxlength = "70" oninput = 'To_check_the_input(/[^а-яА-Яa-zA-Z\s]/, this.value, this.id, "Отчество может состоять только из русских и латинских букв!", 1, 2)' />
                
                <h2>E-mail</h2>
                <p id="login_sms3"></p>
                <input type="text" id="mail_r"  name="mail" onfocus="regFocus(this.id)" onblur="regBlur(this.id, 3)" placeholder="например: Chyngyz1928@mail.ru" oninput = 'To_check_the_input(/[а-яА-Я]/, this.value, this.id, "Почта не может состоять из русских букв и пробелов!", 1, 3)' />


                <div class="CodeMailBox" id="CodeMailBox">
                    <h2>Введите пятизначный код, отправленный на <span id="userMail" class="userMail"></span></h2>
                    <p id="login_sms4"></p>
                    <input type="text" id="codeMail" name="codeMail" placeholder="Код потверждения" maxlength = "5" oninput = "CodeMail (this.value)"/>
                </div>

                <div class="PasswordBox" id="PasswordBox">
                    <h2>Придумайте пароль</h2>
                    <p id="login_sms5"></p>
                    <input type="password" id="password" name="password" placeholder="Пароль" maxlength = "30" oninput = "PasswordBoxShow (this.value)"/>
                </div>
                
    
                <p style="color: #000;">Нажимая на кнопку «Регистрация» вы принимаете условия пользовательского соглашения, представленного <a href="" target="_blank">по этой</a> ссылке.</p>
                <div id="reg" class="reg" onClick="Reg()">Далее</div>
            </div>
            <div style="border-left: 1px solid #dfdfdf; padding: 15px 15px 15px 20px; text-align: center;">
                <img src="images/logo.jpg" alt="Логотип Rezume.kg" width="200px" height="auto" />
                <a>Регистрация работодателя</a>
                <br />
                <a>Я уже зарегистрирован</a>
            </div>
        </div>
    </div>

</div>

<script>
    var reg = $('#reg');
    var mail_r = $('#mail_r');
    var surname_r = $('#surname_r');
    var name_r = $('#name_r');
    var patronymic_r = $('#patronymic_r');
    var arr = [3];

 
    function regFocus (id)
    {
        $('#' + id).css('border-color', '#a9a9a9');
    }

    function regBlur (id, index)
    {
        $('#' + id).css('border-color', arr[index]);
    }

    var word;
    function To_check_the_input (pattern, val, id, text, number, index)
    { 
       
        if ( $('#' + id).val().length >= number)
        {
            arr [index] = '#a9a9a9';
            $('#login_sms' + index).html('');
        }
        var element = document.getElementById(id);
        if(pattern.test(val) == true)
        {
            $('#login_sms' + index).html(text);
        }
        else
        {
            $('#login_sms' + index).html('');
        }
        
        word = element.value.replace(pattern, '');
        if (word[0] == ' ')
        {
            word = word[0].replace (/\s/, '') + word.substr (1);
        }
      
        word = word.replace(/\s{2,}/g, ' ');
        element.value = word;
        
    }

    function check_it() {
    var testing = document.getElementById("mail_r").value;
    var rex = /^([a-z0-9_\-]+\.)*[a-z0-9_\-]+@([a-z0-9][a-z0-9\-]*[a-z0-9]\.)+[a-z]{2,4}$/i; 
    if (!rex.test(testing)){
        mail_r.css('border-color', 'red');
        arr[3] = "red";
        $('#login_sms3').html('Введите корректный e-mail!');
    }  
    }

    function Reg ()
    {
    if (reg.html() == "Далее")
    {

        if (mail_r.val() != "")
        {
                check_it ();
        }
        else if (mail_r.val() == "")
        {
                mail_r.css('border-color', 'red');
                arr[3] = "red";
                $('#login_sms3').html('Укажите вашу почту');
        }
        else
        {
                mail_r.css('border-color', '#a9a9a9');
                arr[3] = "#a9a9a9";
                $('#login_sms3').html('');
        }

        if (surname_r.val() == "")
        {
                surname_r.css('border-color', 'red');
                arr[0] = "red";
                $('#login_sms0').html('Укажите ваше фамилие');
        }
        else
        {
                surname_r.css('border-color', '#a9a9a9');
                arr[0] = "#a9a9a9";
                $('#login_sms0').html('');
        }

            if (name_r.val() == "")
        {
                name_r.css('border-color', 'red');
                arr[1] = "red";
                $('#login_sms1').html('Укажите ваше имя');
        }
        else
        {
                name_r.css('border-color', '#a9a9a9');
                arr[1] = "#a9a9a9";
                $('#login_sms1').html('');
        }

        if (patronymic_r.val() == "")
        {
                patronymic_r.css('border-color', 'red');
                arr[2] = "red";
                $('#login_sms2').html('Укажите ваше отчество');
        }
        else
        {
                patronymic_r.css('border-color', '#a9a9a9');
                arr[2] = "#a9a9a9";
                $('#login_sms2').html('');
        }

        var sum = 0;
        for (var i = 0; i < arr.length; i++)
        {
            if (arr[i] == "#a9a9a9")
            {
                sum+=1;
            }
        }

        if (sum == 4)
        {
            $('#userMail').html(mail_r.val());
            $('#Ajax').click();
        }

        }
        else if (reg.html() == "Получить пароль")
        {
        
            if ($('#codeMail').val().length <5 )
            alert ('Введите код потверждения!');
        }
        else if (reg.html() == "Отправить еще раз")
        {
            $('#Ajax').click();
            $('#login_sms4').html('');
            $('#codeMail').val('');
        }
        else
        {
            if ($('#password').val().length >= 8)
            {
                passwordTrue = 'true';
                $('#Ajax').html(mail_r.val());
                $('#Ajax').click();
                RegCloseWindow ();
            }
            else
            {
                alert ('Заполните пароль!');
            }      
        }
    }
    
    function CodeMail (val)
    {
      if (val.length == 5)
      {
        if (codeMailRandom == +val)
        {
            $('#login_sms4').css('color', 'green');
            $('#login_sms4').html('Код успешно потвержден!');
            $('#codeMail').prop('disabled',true);
            $('#PasswordBox').css('display', 'block');
            $('#reg').html('Регистрация');
        }
        else
        {
            $('#login_sms4').css('color', 'red');
            $('#login_sms4').html('Неправильный код!');
            $("#reg").html('Отправить еще раз');
        } 
      }
      else
      {
        $('#login_sms4').html('');
      }
    }

    function codeMailBox ()
    {
        $("#CodeMailBox").css('display', 'block');         
        $('#surname_r').prop('disabled',true);
        $('#name_r').prop('disabled',true);
        $('#patronymic_r').prop('disabled',true);
        $('#mail_r').prop('disabled',true);
        $("#reg").html('Получить пароль');
    }

    function PasswordBoxShow (val)
    {
        if (val.length < 8)
            $('#login_sms5').html('Пароль должен состоять из 8 и более символов');
        else
        {
            $('#login_sms5').html('');
        }
    }

    var regSum = 0;
    var regFlag = false;
    function RegOpenWindow ()
    {
        if (regFlag == false)
        {
            //LoginCloseWindow();
            ShadowBlockOpen ('Shadow_block_reg');
            regFlag = true;
        }

        regSum+=0.03;
        $('#registration').css('display', 'block');
        $('#registration').css('opacity', regSum);
        if(regSum >= 1){     
            $('#registrationExit').css('display', 'block');
            return false;
        }
        setTimeout("RegOpenWindow()", 10);
    }
    function RegCloseWindow ()
    {
        $('#registration').css('display', 'none');
        $('#registration').css('opacity', "0");
        $('#registrationExit').css('display', 'none');
        ShadowBlockClose ('Shadow_block_reg');
        ClearRegWindow ();
        DisabledRegInput ();
        regFlag = false;
        regSum = 0;
    }

    function ClearRegWindow ()
    {
        $('#surname_r').val('');
        $('#name_r').val('');
        $('#patronymic_r').val('');
        $('#mail_r').val('');
        $('#codeMail').val('');
        $("#login_sms4").html(''); 
        $('#password').val('');
    }

    function DisabledRegInput ()
    {
        $('#surname_r').prop('disabled',false);
        $('#name_r').prop('disabled',false);
        $('#patronymic_r').prop('disabled',false);
        $('#mail_r').prop('disabled',false);
        $('#codeMail').prop('disabled',false);

        $("#CodeMailBox").css('display', 'none');         
        $('#PasswordBox').css('display', 'none');
        $('#reg').html('Далее');
    }

</script>
