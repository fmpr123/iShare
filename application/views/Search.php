<?php echo form_open('search'); ?>
<div class="container">
    <div class="row mt-2">
        <div class="col-md-8">
            <input type="text" class="form-control" name="search">
        </div>
        <div class="col-md-2">
            <select class="custom-select" name="filter">
                <option value="0">Filtro</option>
                <option value="older">Mais antigo</option>
                <option value="recent">Mais recente</option>
                <option value="more">Mais Likes</option>
                <option value="less">Menos Likes</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary" style="padding: 6px 42.5px;">Pesquisar</button>
        </div>
    </div>
    <?php echo form_close(); ?>
    <br>
    <?php foreach ($posts as $post) : ?>
        <?php if ($post['private'] == 0) : ?>
            <div class="row my-4">
                <div class="col-md-2 post_userimg">
                    <p class="username">@<?php echo $post['user_name']; ?></p>
                    <img class="user_image" src="images/user_photo/<?php echo $post['user_photo']; ?>.jpg">
                </div>
                <div class="col-md-8 content">
                    <div class="row clearfix">
                        <p class="title" style="align-self: center;margin-bottom: 15px;float: left;width: 77%;"> <?php echo $post['post_title']; ?> <small class="text-muted"> <?php echo $post['post_date']; ?></small></p>
                        <?php if ($this->session->userdata('logged_in')) : ?>
                            <div class="nav-item dropdown" style="float: right;width: 23%;text-align: end;">
                                <a class="nav-link dropdown-toggle" style="padding: 0 4px;" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                <div class="dropdown-menu">
                                    <?php if ($post['user_id'] == $this->session->userdata('id')) : ?>
                                        <a class="dropdown-item" href="<?php echo base_url(); ?>edit/<?php echo $post['post_id']; ?>">Editar</a>
                                        <a class="dropdown-item" href="<?php echo base_url(); ?>delete/<?php echo $post['post_id']; ?>">Apagar</a>
                                        <a class="dropdown-item" href="<?php echo base_url(); ?>private/<?php echo $post['post_id']; ?>">Privado</a>
                                    <?php endif; ?>
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
                    <div class="row" style="align-items: center;">
                        <?php
                        $string = $post['tags'];
                        $array = explode(",", $string);
                        foreach ($array as $arr) : ?>
                            <p class="tagStyle"><?php echo $arr; ?></p>
                        <?php endforeach; ?>
                        <div style="margin-bottom: 15px;">
                            <a href="<?php echo base_url(); ?>like/<?php echo $post['post_id']; ?>" class="likebtn">
                                <?php $counter = 0; ?>
                                <?php foreach ($post_rating as $rating) : ?>
                                    <?php if ($post['post_id'] == $rating['post_id'] &&  $this->session->userdata('id') == $rating['user_id']) : ?>
                                        <?php $counter+=1; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <?php if ($counter >= 1) : ?>
                                    <i class="fa fa-heart"> <?php echo $post['rating']; ?></i>
                                <?php else : ?>
                                    <i class="fa fa-heart-o"> <?php echo $post['rating']; ?></i>
                                <?php endif; ?>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-2" style="align-self: center;margin: 0 0 20px 27px;">
                    <?php if ($post['image'] == "") : ?>
                        <img class="post_image" src="images/image_placeholder.png">
                    <?php else : ?>
                        <img class="post_image" src="<?php echo $post['image']; ?>">
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>