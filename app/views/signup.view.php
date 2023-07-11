<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/signup.css">
    <title>Twitter login</title>
</head>
<body>
<div class="container">
    <div class="box-one">
        <div class="row-one">
            <i class=""><a href="<?=ROOT?>/home">x</a></i>
        </div>
        <div class="row-two">
            <i class="fab fa-twitter"><img src="<?=ROOT?>/assets/images/icons8-twitter-48.png" width="25" </i>
        </div>
    </div>
    <div class="box-two">
        <h1 class="header">Приєднуйтеся до Твіттера сьогодні</h1>
        <button>
            <img src="<?=ROOT?>/assets/images/google.png" width="19">
            <span>Зареєструватися через Google</span>
        </button>
        <button>
            <img src="<?=ROOT?>/assets/images/apple.png" width="19">
            <span>Зареєструватися за допомогою Apple</span>
        </button>

        <span>або</span>

        <button class="next-btn"><a href="<?=ROOT?>/stepone">Створити профіль</a></button>

        <div class="terms">
            <span>Реєструючись, ви погоджуєтеся з <a>Умовами надання послуг</a> і <a>Політикою конфіденційності</a>, включаючи
                <a>Політику використання файлів cookie.</a></span>
        </div>
    </div>
    <p>Уже маєте профіль? <a href="<?=ROOT?>/login">Увійдіть</a></p>
</div>

</body>
</html>