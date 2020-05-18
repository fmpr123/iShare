<?php echo form_open('search'); ?>
<div class="row">
    <div class="col-md-4 offset-md-3">
        <input type="text" class="form-control" name="search">
    </div>
    <div style="padding-right: 15px">
        <select class="custom-select" name="choice">
            <option selected="">Filtro</option>
            <option value="title">Título</option>
            <option value="content">Conteúdo</option>
            <option value="tag">Tag</option>
            <option value="name">Nome</option>
        </select>
    </div>
    <div>
        <button type="submit" class="btn btn-primary">Pesquisar</button>
    </div>
</div>
<?php echo form_close(); ?>
<br>
<?php foreach ($posts as $post) : ?>
    <div class="container offset-md-3">
        <div class="row">
            <div class="col-lg-2 post_userimg">
                <p class="username">@<?php echo $post['user_name']; ?></p>
                <img class="user_image" src="images/user_photo/<?php echo $post['user_photo']; ?>.jpg">
            </div>
            <div class="col-lg-4 content">
                <div class="row">
                    <p class="title"> <?php echo $post['post_title']; ?> <small class="text-muted"> <?php echo $post['post_date']; ?></small></p>
                    <?php if ($this->session->userdata('logged_in')) : ?>
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"></a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?php echo base_url(); ?>edit/<?php echo $post['post_id']; ?>">Editar</a>
                                <a class="dropdown-item" href="<?php echo base_url(); ?>delete/<?php echo $post['post_id']; ?>">Apagar</a>
                                <a class="dropdown-item" href="<?php echo base_url(); ?>private/<?php echo $post['post_id']; ?>">Privado</a>
                                <a class="dropdown-item" href="<?php echo base_url(); ?>report/<?php echo $post['post_id']; ?>">Reportar</a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="post_content">
                    <p><?php echo $post['post_content']; ?></p>
                </div>
                <div class="post_url">
                    <a href="<?php echo $post['post_url']; ?>"><?php echo $post['post_url']; ?></a>
                </div>
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
            <div class="col-lg-3">
                <?php if ($post['image'] == "") : ?>
                    <img class="post_image" src="images/image_placeholder.png">
                <?php else : ?>
                    <img class="post_image" src="<?php echo $post['image']; ?>">
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script>
    // $(document).ready(function() {
    //     $('#ct').on('click', function() {
    //         $.ajax({

    //         });
    //     });
    // });
</script>