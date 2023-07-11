
    <div class="main-tweet_box">
        <a href="">
        <div class="top-line"></div>
        <div class="tweet-box">
            <div class="tweet-left">
                <img src="<?=get_image($row->avatar ?? "")?>" alt="">
            </div>

            <div class="tweet-body">

                <div class="tweet-header">
                    <p class="tweet-name"><?=esc($row->username ?? '')?></p>
                    <p class="tweet-username"><?=esc($row->username ?? '')?></p>
                    <p class="tweet-date">Date</p>
                </div>

                <div class="tweet-desc">
                    <p><?=esc($row->description ?? 'text')?></p>
                </div>
                <?php if(!empty($row->file)): ?>
                    <div class="tweet-files">
                        <img src="<?=get_image($row->file ?? "")?>" alt="">
                    </div>
                <?php endif; ?>

                <div class="icons">
                    <div class="icons-wrapper">
                        <a class="reply-box"><img src="<?=ROOT?>/assets/images/coment.png"><span>1</span></a>
                        <a class="retweet-box"><img src=""><span>2</span></a>
                        <div class="like-box"><img src=""><span>3</span></div>
                        <div class="view-box"><img src=""><span>4</span></div>
                        <div class="save-box"><img src=""><span>5</span></div>
                    </div>
                </div>
<!--                <div class="icons">-->
<!--                    <div class="icons-wrapper">-->

<!--                    </div>-->
<!--                </div>-->

<!--                <div class="tweet-icons">-->
<!---->
<!--                    <div>-->
<!--                        <a class="reply_hover" href="--><?php //=ROOT?><!--/homefull/compose/--><?php //=$row->id?><!--"><i class="far fa-comment"></i></a>-->
<!--                        <span class="reply_counter">--><?php //=esc($row->reply)?><!--</span>-->
<!--                    </div>-->
<!---->
<!--                </div>-->

            </div>

        </div>
        </a>
    </div>


<script>
    function delete_hide(e)
    {
        e.preventDefault();

        document.querySelector(".dropdown-content").classList.remove("hide");
    }

    function get_like(e)
    {
        e.preventDefault();

        let obj = {};
        obj.data_type = 'get_like';
        obj.user_id = e.currentTarget.querySelector("#user_id").value;
        obj.tweet_id = e.currentTarget.querySelector("#tweet_id").value;

        send_data(obj);
    }

    function delete_like(e)
    {
        e.preventDefault();

        let obj = {};
        obj.data_type = 'delete_like';
        obj.user_id = e.currentTarget.querySelector("#user_id").value;
        obj.id = e.currentTarget.querySelector("#like_id").value;
        obj.tweet_id = e.currentTarget.querySelector("#tweet_id").value;


        send_data(obj);
    }

    function send_data(obj) {
        var myform = new FormData();
        var progressbar = null;

        if (typeof obj.progressbar != 'undefined')
            progressbar = document.querySelector("." + obj.progressbar);

        for (key in obj) {
            myform.append(key, obj[key]);
        }

        var ajax = new XMLHttpRequest();

        ajax.addEventListener('readystatechange', function (e) {

            if (ajax.readyState == 4 && ajax.status == 200) {
                handle_result(ajax.responseText);
            }
        });

        if (progressbar) {
            progressbar.classList.remove('d-none');
            progressbar.children[0].style.width = '0';
            progressbar.children[0].innerHTML = '0';

            ajax.upload.addEventListener('progress', function (e) {
                let percent = Math.round((e.loaded / e.total) * 100);
                progressbar.children[0].style.width = percent + '%';
                progressbar.children[0].innerHTML = percent + "%";

            });
        }


        ajax.open('post', '<?=ROOT?>/ajax', true);
        ajax.send(myform);
    }

    function handle_result(result)
    {
        console.log(result);
        let obj = JSON.parse(result);

        if(obj.success)
        {
            window.location.reload();
        } else {
            alert("Please fix the errors");
            for (key in obj.errors){
                alert(obj.errors[key]);
            }
        }

    }
</script>


