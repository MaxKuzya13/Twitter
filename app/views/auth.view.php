<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/auth.css">
    <title>Twitter login</title>
</head>
<body>
<div class="container-auth">
    <div class="box-one-auth">
        <div class="row-one-auth">
            <i class=""><a href="<?=ROOT?>/home">x</a></i>
        </div>
        <div class="row-two-auth">
            <i class="fab fa-twitter"><img src="<?=ROOT?>/assets/images/icons8-twitter-48.png" width="25" </i>
        </div>
    </div>
    <div class="box-two-auth">
        <h1>Введіть свій пароль</h1>
        <div class="inp">
            <form method="post">
                <input value="<?=old_value('email')?>" name="email" type="text" placeholder="Телефон, електронна пошта або ім'я користувача"/>
                <div><small style="color: red"><?=$user->getError('email')?></small></div>
                <input name="password" type="password" placeholder="Пароль"/>
                <div><small style="color: red"><?=$user->getError('password')?></small></div>
        </div>
    </div>

    <div class="box-three-auth">
        <button class="next-btn-auth">Увійти</button>
                </form>
        <p>Не маєте профілю? <a href="<?=ROOT?>/signup">Зареєструйтеся</a></p>
    </div>
</div>

</body>
</html>