        <form method="post" action="">
            <h1>Create tweet</h1>

            <div class="desc-box">
                <label for="">
                    description
                </label>
                <textarea name="description" placeholder="description"></textarea>
            </div>

            <div class="video-box">
            <label>
                <div>Featured Video:</div>
                <img src="" alt="">
                <input onchange="display_video(event)" type="file" name="file">
                <video controls width="300" height="200">
                    <source src="" type="video/mp4">
                </video>
                <script>
                    let file_added = false;


                    function display_video(e)
                    {
                        let allowed = ['video/mp4'];
                        let file = e.currentTarget.files[0];

                        if(!allowed.includes(file.type))
                        {
                            alert('Only video formats allowed are: '+allowed.toString().replaceAll("video/", ""));
                            file_added = false;
                            return;
                        }

                        file_added = true;
                        e.currentTarget.parentNode.querySelector('video').src = URL.createObjectURL(file);
                    }
                </script>
            </label>
            </div>
            <div class="last-box">
                <button class="next-btn_create">Create</button>
            </div>
        </form>
