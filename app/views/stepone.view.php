<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/signup_one.css">
    <title>Twitter login</title>
</head>
<body>

<?php if($section == 'stepone') :?>

<div class="container">
        <div class="box-one">
            <div class="row-one">
                <i class=""><a href="<?=ROOT?>/home">x</a></i>
            </div>
            <div class="row-two">
               <h3>Крок 1 із 5</h3>
            </div>
        </div>
        <div class="box-two">
            <h1 class="header">Створіть свій профіль</h1>
            <form method="post" action="">
                <div class="input-box">
                    <input value="<?=old_value('username')?>" name="username" maxlength="50" type="text">
                    <label> Ім'я </label>
                    <span>0 / 50</span>
                    <div><small style="color: red"><?=$user->getError('username')?></small></div>
                </div>

                <div class="input-box">
                    <input value="<?=old_value('email')?>" name="email" type="email">
                    <label>Ел. пошта</label>
                    <div><small style="color: red"><?=$user->getError('email')?></small></div>
                </div>

                <div class="input-box">
                    <input name="password" type="password">
                    <label>Введіть пароль</label>
                    <div><small style="color: red"><?=$user->getError('password')?></small></div>
                </div>

                <div class="row-three">
                    <h4>Дата народження</h4>
                </div>

                <div class="row-three">
                    <p>
                        Ці дані не будуть загальнодоступні. Підтвердьте свій вік, навіть якщо це профіль компанії, домашнього улюбленця чи ще чогось.
                    </p>
                </div>
                    <div class="area">
                        <div class="area-month">
                            <label for=""><span>Місяць</span></label>
                            <select name="month" id="">
                                <option disabled value></option>
                                <option value="1">Січень</option>
                                <option value="2">Лютий</option>
                                <option value="3">Березень</option>
                                <option value="4">Квітень</option>
                                <option value="5">Травень</option>
                                <option value="6">Червень</option>
                                <option value="7">Липень</option>
                                <option value="8">Серпень</option>
                                <option value="9">Вересень</option>
                                <option value="10">Жовтень</option>
                                <option value="11">Листопад</option>
                                <option value="12">Грудень</option>
                            </select>
                        </div>

                        <div class="area-day">
                            <label for=""><span>День</span></label>
                            <select name="day" id="">
                                <option value="1" >1</option>
                                <option value="2" >2</option>
                                <option value="3" >3</option>
                                <option value="4" >4</option>
                                <option value="5" >5</option>
                                <option value="6" >6</option>
                                <option value="7" >7</option>
                                <option value="8" >8</option>
                                <option value="9" >9</option>
                                <option value="10" >10</option>
                                <option value="11" >11</option>
                                <option value="12" >12</option>
                                <option value="13" >13</option>
                                <option value="14" >14</option>
                                <option value="15" >15</option>
                                <option value="16" >16</option>
                                <option value="17" >17</option>
                                <option value="18" >18</option>
                                <option value="19" >19</option>
                                <option value="20" >20</option>
                                <option value="21" >21</option>
                                <option value="22" >22</option>
                                <option value="23" >23</option>
                                <option value="24" >24</option>
                                <option value="25" >25</option>
                                <option value="26" >26</option>
                                <option value="27" >27</option>
                                <option value="28" >28</option>
                                <option value="29" >29</option>
                                <option value="30" >30</option>
                                <option value="31" >31</option>
                            </select>
                        </div>

                        <div class="area-year">
                            <label for=""><span>Рік</span></label>
                            <select name="year" id="">
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>
                                <option value="2021">2021</option>
                                <option value="2020">2020</option>
                                <option value="2019">2019</option>
                                <option value="2018">2018</option>
                                <option value="2017">2017</option>
                                <option value="2016">2016</option>
                                <option value="2015">2015</option>
                                <option value="2014">2014</option>
                                <option value="2013">2013</option>
                                <option value="2012">2012</option>
                                <option value="2011">2011</option>
                                <option value="2010">2010</option>
                                <option value="2009">2009</option>
                            </select>
                        </div>
                    </div>
            </div>
            <button class="next-btn">Далі</button>
    </form>
</div>

<?php elseif ($section == 'steptwo') :?>


<?php show($data);
?>
<div class="container">
    <div class="box-one">
        <div class="row-one">
            <i class=""><a href="<?=ROOT?>/stepone/stepone">back</a></i>
        </div>
        <div class="row-two">
            <h3>Крок 2 із 5</h3>
        </div>
    </div>
    <div class="box-two">
        <h1 class="header">Налаштуйте персоналізацію</h1>

        <div class="row-three">
            <h3>Відстежуйте, де в Інтернеті для вас відображається вміст Твіттера</h3>
        </div>

        <div class="row-four">
            <span>Твіттер використовує ці дані для персоналізації. Ця історія переглядів веб-сторінок ніколи не зберігатиметься в поєднанні з вашим іменем, адресою електронної пошти чи номером телефону.</span>
            <input type="checkbox">
        </div>

        <div class="terms">
            <span>
                Реєструючись, ви приймаєте наші <a href="https://twitter.com/en/tos#new">Умови</a>, <a href="https://twitter.com/en/privacy">Політику конфіденційності</a> та <a
                    href="https://help.twitter.com/en/rules-and-policies/twitter-cookies">Політику використання файлів cookie</a>. Twitter може використовувати ваші контактні дані, зокрема адресу електронної пошти та номер телефону, для цілей, окреслених у нашій Політиці конфіденційності.
                <a href="https://twitter.com/en/privacy">Детальніше</a>
            </span>
        </div>


    </div>
    <button class="next-btn"><a href="<?=ROOT?>/stepone/stepthree">Далі</a></button>
</div>

_______________________________________________________________________________________________

<?php elseif ($section == 'stepthree') :?>

    <?php show($data); ?>
<div class="container">
    <div class="box-one">
        <div class="row-one">
            <i class=""><a href="<?=ROOT?>/stepone/steptwo">back</a></i>
        </div>
        <div class="row-two">
            <h3>Крок 3 із 5</h3>
        </div>
    </div>
    <div class="box-two">
        <h1 class="header">Створіть свій профіль</h1>
        <div class="input-box">
            <input type="text">
            <label> Ім'я </label>
        </div>

        <div class="input-box">
            <input type="text">
            <label> Ел. пошта </label>
        </div>

        <div class="input-box">
            <input type="text">
            <label> Дата народ. </label>
        </div>

        <div class="terms">
            <span>
                Реєструючись, ви приймаєте наші <a href="https://twitter.com/en/tos#new">Умови надання послуг</a>, <a href="https://twitter.com/en/privacy">Політику конфіденційності</a>, зокрема <a
                    href="https://help.twitter.com/en/rules-and-policies/twitter-cookies">Політику використання файлів cookie</a>. Твіттер може використовувати ваші контактні дані, зокрема адресу електронної пошти та номер телефону, для цілей, окреслених у нашій Політиці конфіденційності, наприклад для захисту вашого профілю та персоналізації нашого сервісу, зокрема реклами. <a
                    href="https://twitter.com/en/privacy">Детальніше</a>. Інші користувачі зможуть знайти вас за адресою електронної пошти або номером телефону, якщо вони надані. Ви можете змінити це налаштування <a
                    href="<?=ROOT?>/privacy">тут</a>.
            </span>
        </div>
    </div>
    <button class="next-btn-three"><a href="<?=ROOT?>/stepone/stepfour">Зареєструватись</a></button>
</div>

_________________________________________________________________________________________________

<?php elseif ($section == 'stepfour') :?>

    <?php show($data); ?>
<div class="container">
    <div class="box-one">
        <div class="row-one">
            <i class=""><a href="<?=ROOT?>/stepone/stepthree">back</a></i>
        </div>
        <div class="row-two">
            <h3>Крок 4 із 5</h3>
        </div>
    </div>
    <div class="box-two">
        <h1 class="header">Ми надіслали вам код</h1>
        <span class="span-start">Введіть його нижче, щоб пти maxit2301@gmail.com.</span>
        <form class="form-four" action="">
            <div class="input-box">
                <input type="text">
                <label>Введіть код</label>
            </div>
            <p class="p-start"><a href="№">Не отримали листа?</a></p>

    </div>
    <button class="next-btn"><a href="<?=ROOT?>/stepone/stepfive">Далі</a></button>
    </form>
</div>

_________________________________________________________________________________________________

<?php elseif ($section == 'stepfive') :?>

    <?php show($data); ?>
<div class="container">
    <div class="box-one">
        <div class="row-one">
            <h3>Крок 5 із 5</h3>
        </div>
    </div>
    <div class="box-two">
        <h1 class="header">Вам знадобиться пароль</h1>
        <span class="span-start">Він має складатися щонайменше із 8 символів.</span>
        <form class="form-four" action="">

            <div class="input-box">
                <input type="text">
                <label>Введіть пароль</label>
            </div>

    </div>
    <button class="next-btn"><a href="<?=ROOT?>/login">Далі</a></button>
    </form>
</div>

<?php endif; ?>

</body>
</html>
