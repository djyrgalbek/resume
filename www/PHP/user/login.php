<style>
/*----------- Стили для входа ----------*/
  
#login
{    
    display: none;
    position: relative;
    top: 50px;
    width: 500px;
    background: #fff;
    border: 1px solid #dfdfdf;
    padding: 20px 20px 0px 20px;
    margin: auto;
    opacity: 0;
    box-shadow: 0px 5px 20px #252525;
}  
.loginTitle{
    display: flex;
    flex-wrap: nowrap;
    width: auto;
    padding-bottom: 15px;
    background: #fff;
    border-bottom: 1px solid #ecb41c;
}
.loginTitle div{
    width: 50%;
    /*background: green;*/
}
.loginTitle h1
{
    font: normal 20px 'Roboto Condensed', sans-serif;
    color: #000;
}
.inputUser
{
    display: flex;
    flex-wrap: nowrap;
    width: auto;
    padding-bottom: 20px;
    background: #fff;
    margin-top: 20px;
}
.inputUser div
{
    width: 50%;
    padding: 15px 20px 15px 0px;
    /*background: green;*/
}
.inputUser h2
{
    font: normal 17px 'Roboto Condensed', sans-serif;
    color: #000;
    margin-bottom: 8px;
}
.inputUser input
{
    width: calc(100% - 15px);
    padding: 4px 4px 4px 7px;
    font: normal 14px Arial, Tahoma sans-serif;
    color: #000;
    margin-bottom: 15px;
}
.inputUser div .enter
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
}
.inputUser div .enter:hover
{
    background: #1dc525;
}
.inputUser div a
{
    font: normal 14px Arial, Tahoma sans-serif;
    color: #ecb41c;
    text-decoration: underline;
}
.inputUser div a:hover
{
    color: #1dc525;
}
.inputUser div img
{
    display: inline-block;
    margin-bottom: 20px;
}
  

</style>

<div class="Shadow_block" id="Shadow_block_login">
    <div id="login">
        <div class="loginTitle">
            <div>
                <h1>Войти на сайт</h1>
            </div>
            <div>
                <img id="loginExit" src="images/out.png" alt="Выход из окна входа Rezume.kg" width="15px" height="auto" style="display: none; float: right" onclick="LoginCloseWindow()"/>
            </div>
        </div>

        <div class="inputUser">
            <div>
                <h2>E-mail</h2>
                <input type="text" name="login" />
                <h2>Пароль</h2>
                <input type="password" name="password" />
                <div class="enter">Войти</div>
                <a style="float: right;">Забыли пароль?</a>
            </div>

            <div style="border-left: 1px solid #dfdfdf; padding: 15px 15px 15px 20px; text-align: center;">
                <img src="images/logo.jpg" alt="Логотип Rezume.kg" width="200px" height="auto" />
                <a>Регистрация работодателя</a>
                <br />
                <a>Регистрация соискателя</a>
            </div>

        </div>
    </div>
</div>

<script>

//----------------- Вход пользователя (login.php) -----------------

var loginSum = 0;
var logFlag = false;

function LoginOpenWindow ()// Функция, которая открывает окно для входа
{
    if (logFlag == false)
    {
        //RegCloseWindow();
        ShadowBlockOpen ('Shadow_block_login');
        logFlag = true;
    }
  
    loginSum+=0.03;
    $('#login').css('display', 'block');
    $('#login').css('opacity', loginSum);
    if(loginSum >= 1){     
        $('#loginExit').css('display', 'block');
        return false;
    }
    setTimeout("LoginOpenWindow()", 10);
}

function LoginCloseWindow ()// Функция, которая закрывает окно для входа
{
    $('#login').css('display', 'none');
    $('#login').css('opacity', "0");
    $('#loginExit').css('display', 'none');

        ShadowBlockClose ('Shadow_block_login');
        logFlag = false;
    loginSum = 0;
}


</script>
