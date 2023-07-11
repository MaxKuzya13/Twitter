<div class="background__container">
    <form onsubmit="new_reply_for_reply(event)" method="post" enctype="multipart/form-data">
        <div class="tweet-reply-container">
            <div class="tweet-reply-header">
                <a href="<?=ROOT?>/homefull" class="tweet-reply-exit"><img src="<?=ROOT?>/assets/images/exit.png" width="13" height="13"></a>
            </div>
            <div class="tweet-reply_body">
                <div class="tweet-reply_box">
                    <div class="tweet-reply-box-spec"></div>
                    <div class="tweet-reply-box-wrapper">
                        <div class="tweet-reply-box-avatar">
                            <div class="tweet-reply-box-avatar-main"><img src="<?=get_image($line->avatar)?>" width="50" height="50"></div>
                            <div class="vertical-line"></div>
                        </div>
                        <div class="tweet-reply-box-desc">
                            <div class="tweet-reply-box-desc-header">
                                <h4><?=esc($line->username)?></h4>
                                <input id="replying_id" type="hidden" value="<?=$line->user_id?>">

                                <span>@<?=esc($line->username)?></span>
                                <p>May 28</p>
                            </div>
                            <div class="tweet--reply--box-desc--main">
                                <span><?=esc($line->description)?></span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="tweet-reply-replying">
                    <div class="tweet-reply-replying-left"><div class="vertical-line"></div></div>
                    <div class="tweet-reply-replying-right">
                        <span>Replying to</span><p>

                                <?php if($line->username === $recipient->username): ?>
                                    @<?=esc($line->username)?>
                                <?php else: ?>
                                    @<?=esc($line->username)?>  and @<?=esc($recipient->username)?>
                                <?php endif; ?>

                        </p>
                    </div>
                </div>
                <div class="tweet-reply-text-box">
                    <div class="tweet-reply-text-box--main">
                        <div class="tweet-reply-text-box-main-avatar"><img src="<?=get_image($user->avatar)?>" width="50" height="50"></div>
                        <div class="tweet-reply-text-box-main-text">
                            <textarea class="js-reply-description" name="reply" id="reply" cols="30" rows="10" placeholder="Tweet your reply!"></textarea>
                        </div>
                    </div>
                    <div class="tweet-reply-text-box-main-image-box hide">
                        <img class="js-load-image" src="" width="500" height="300">
                    </div>
                    <div class="tweet-reply-text-box-footer">
                        <div class="new__tweet-box-right-footer-logos">
                            <input type="hidden" id="reply_id" value="<?=$line->id?>">
                            <input type="hidden" id="tweet_id" value="<?=$tweet->id?>">
                            <li><img src="<?=ROOT?>/assets/images/picture.png"><input class="js-reply-file" type="file" onchange="load_image(event)"></li>
                            <li><img src="<?=ROOT?>/assets/images/gif.png"></li>
                            <li><img src="<?=ROOT?>/assets/images/poll.png"></li>
                            <li><img src="<?=ROOT?>/assets/images/happy.png"></li>
                            <li><img src="<?=ROOT?>/assets/images/schedule.png"></li>
                            <li><img src="<?=ROOT?>/assets/images/location.png"></li>

                        </div>
                        <div class="tweet-reply-text-box-footer-btn">
                            <button type="submit">Reply</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
