<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home / Twitter</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/create_tweet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
</head>
<body>

        <form onsubmit="new_tweet(event)" class="container_create" method="post" enctype="multipart/form-data">
            <div class="class_11">
                <i class=""><a href="<?=ROOT?>/homefull">x</a></i>
            </div>

            <div class="tweet__box_one">
                <div class="tweet__left">
                    <img src="<?=ROOT?>/assets/images/no_image.jpg" alt="">
                </div>
                <div class="tweet__body_one">
                    <div class="tweet__header">
                       <button type="button">Everyone <img src="<?=ROOT?>/assets/images/down.png"></button>
                    </div>
                    <textarea class="js-description" name="description" placeholder="What`s happening?"></textarea>
                    <div class="file_box">
                        <input class="js-file" onchange="display_file(event)" type="file" name="file">
                        <img class="tweet_img" src="" width="100%" height="200" hidden="hidden">
                        <video class="tweet_video" controls width="100%" height="500" hidden="hidden">
                            <source src="" type="video/mp4">
                        </video>
                    </div>
                </div>

            </div>

            <div class="class_3">
                <button type="button"><a href=""><img src="<?=ROOT?>/assets/images/globe.png" alt=""> Everyone can reply</a></button>
            </div>

            <div class="class_4">
                <div class="class_5">
                    <ul style="list-style: none">
                        <li><img src="<?=ROOT?>/assets/images/picture.png"></li>
                        <li><img src="<?=ROOT?>/assets/images/gif.png"></li>
                        <li><img src="<?=ROOT?>/assets/images/poll.png"></li>
                        <li><img src="<?=ROOT?>/assets/images/happy.png"></li>
                        <li><img src="<?=ROOT?>/assets/images/schedule.png"></li>
                        <li><img src="<?=ROOT?>/assets/images/location.png"></li>
                    </ul>
                </div>
                <script>
                    function display_file(e)
                    {
                        let file = e.currentTarget.files[0];
                        let allowed_image = ['image/jpeg', 'image/png', 'image/webp'];
                        let allowed_video = ['video/mp4'];

                        if(!allowed_image.includes(file.type) && !allowed_video.includes(file.type))
                        {
                            file_added = false;
                            alert('File type not valid! Files type allowed: '+allowed.toString().replaceAll('image/', ''));
                            return;
                        }

                        if(allowed_video.includes(file.type))
                        {
                            file_added = true;
                            e.currentTarget.parentNode.querySelector('.tweet_video').src = URL.createObjectURL(file);
                            document.querySelector(".tweet_video").removeAttribute("hidden");

                        }

                        if(allowed_image.includes(file.type))
                        {
                            file_added = true;
                            e.currentTarget.parentNode.querySelector('.tweet_img').src = URL.createObjectURL(file);
                            document.querySelector(".tweet_img").removeAttribute("hidden");
                        }



                    }
                </script>
                <div class="class_6">
                    <button>Tweet</button>
                </div>
            </div>
            <div class="prog js-prog hide">
                <div class="prog-bar js-prog-bar">0%</div>
            </div>
        </form>

</body>

<script>
    let file_added = false;
    let mode = '<?=$action?>';

    function new_tweet(e)
    {
        e.preventDefault();
        let obj = {};
        obj.data_type = "new_tweet";

        obj.description = e.currentTarget.querySelector(".js-description").value.trim();

        if(file_added)
            obj.file = e.currentTarget.querySelector(".js-file").files[0];

        if(obj.description == '')
        {
            alert("Enter a description");
            e.currentTarget.querySelector(".js-description").focus();
            return;
        }

        send_data(obj);
    }

    function send_data(obj)
    {
        let myform = new FormData();

        for(key in obj)
        {
            myform.append(key, obj[key]);
        }

        let progbar = document.querySelector(".js-prog-bar");
        progbar.style.width = "0%";
        progbar.innerHTML = "0%";
        document.querySelector(".js-prog").classList.remove("hide");

        var xhr = new XMLHttpRequest();

        xhr.upload.addEventListener('progress', function(e)
        {
            let percent = Math.round((e.loaded / e.total) * 100);
            progbar.style.width = percent + "%";
            progbar.innerHTML = percent + "%";
        });

        xhr.addEventListener('readystatechange', function()
        {
            if (xhr.readyState == 4)
            {
                if(xhr.status == 200)
                {
                    document.querySelector(".js-prog").classList.add("hide");
                    handle_result(xhr.responseText);
                } else {
                    alert('Could not send data. Please check your connection')
                }
            }
        });
        xhr.open('post', '<?=ROOT?>/ajax', true);
        xhr.send(myform);
    }

    function handle_result(result)
    {
        console.log(result);
        let obj = JSON.parse(result);

        if(obj.success)
        {
           window.location.href = '<?=ROOT?>/homefull';
        } else {
            alert("Please fix the errors");
            for (key in obj.errors){
                alert(obj.errors[key]);
            }
        }

    }

</script>