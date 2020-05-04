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
                                <a class="dropdown-item" href="<?php echo base_url(); ?>private/<?php echo $post['post_id']; ?>">Privado</a>
                                <a class="dropdown-item" href="<?php echo base_url(); ?>report/<?php echo $post['post_id']; ?>">Reportar</a>
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
                        <a href="<?php echo base_url(); ?>like/<?php echo $post['post_id']; ?>" class="likebtn">
                            <i class="fa fa-heart-o"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 postimg_div">
                <img class="post_image" src="images/image_placeholder.png">
            </div>
        </div>
    </div>
<?php endforeach; ?>