<br>
This is main
<br>
<?php print_r($posts); ?>
<br>
<?php foreach ($posts as $post) : ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-2 userimg_div">
                <p class="username">@<?php echo $post['name']; ?></p>
                <img class="user_image" src="images/user_photo/<?php echo $post['photo']; ?>.jpg">
            </div>
            <div class="col-lg-4 content">
                <div class="row">
                    <p class="title"> <?php echo $post['title']; ?> <small class="text-muted"> <?php echo $post['created_at']; ?></small></p>
                    <?php if ($this->session->userdata('logged_in')) : ?>
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"></a>
                            <div class="dropdown-menu" style="">
                                <a class="dropdown-item" href="#">Editar</a>
                                <a class="dropdown-item" href="#">Privado</a>
                                <a class="dropdown-item" href="#">Reportar</a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <p><?php echo $post['content']; ?></p>
                <a href="<?php echo $post['url']; ?>"><?php echo $post['url']; ?></a>
                <div class="row">
                    <p class="tagStyle">Tag</p>
                    <p class="tagStyle">Tag</p>
                    <p class="tagStyle">Tag</p>
                </div>
            </div>
            <div class="col-lg-2 postimg_div">
                <img class="post_image" src="images/image_placeholder.png">
            </div>
        </div>
    </div>
<?php endforeach; ?>