<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/styles.css">
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
            <form method="post">
                <div class="box-two">
                    <h1>Увійдіть у Твіттер</h1>
                    <button>
                        <img src="<?=ROOT?>/assets/images/google.png" width="19">
                        <span>Вхід через Google</span>
                    </button>
                    <button>
                        <img src="<?=ROOT?>/assets/images/apple.png" width="19">
                        <span>Увійти за допомогою Apple</span>
                    </button>

                    <span>або</span>

                    <form>
                        <input type="text" name="email" placeholder="Телефон, електронна пошта або ім'я користувача"/>
                    <button class="next-btn">Далі</button>
                    </form>
                    <button>Забули пароль?</button>
                </div>
            <p>Не маєте профілю? <a href="<?=ROOT?>/signup">Зареєструйтеся</a></p>
        </div>



</body>
</html>