This is main
<br>
<?php print_r($posts); ?>
<br>
<?php foreach ($posts as $post) : ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-2 userimg_div">
                <p class="username">@<?php echo $post['user_name']; ?></p>
                <img class="user_image" src="images/user_photo/<?php echo $post['user_photo']; ?>.jpg">
            </div>
            <div class="col-lg-4 content">
                <div class="row">
                    <p class="title"> <?php echo $post['post_title']; ?> <small class="text-muted"> <?php echo $post['post_date']; ?></small></p>
                    <?php if ($this->session->userdata('logged_in')) : ?>
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"></a>
                            <div class="dropdown-menu" style="">
                                <a class="dropdown-item" href="<?php echo base_url(); ?>edit/<?php echo $post['post_id']; ?>">Editar</a>
                                <a class="dropdown-item" href="<?php echo base_url(); ?>delete/<?php echo $post['post_id']; ?>">Apagar</a>
                                <a class="dropdown-item" href="#">Privado</a>
                                <a class="dropdown-item" href="#">Reportar</a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <p><?php echo $post['post_content']; ?></p>
                <a href="<?php echo $post['post_url']; ?>"><?php echo $post['post_url']; ?></a>
                <div class="row">
                    <p class="tagStyle">Tag</p>
                    <p class="tagStyle">Tag</p>
                    <p class="tagStyle">Tag</p>
                    <div>
                        <button class="likebtn">
                            <svg class="bi bi-heart" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 01.176-.17C12.72-3.042 23.333 4.867 8 15z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 postimg_div">
                <img class="post_image" src="images/image_placeholder.png">
            </div>
        </div>
    </div>
<?php endforeach; ?>