<?php echo validation_errors(); ?>

<?php echo form_open('update'); ?>
<input type="hidden" name="id" value="<?php echo $posts['id']; ?>">
<div class="row">
    <div class="col-md-6 offset-md-3">
        <label>Título</label>
        <input type="text" class="form-control" name="title" value="<?php echo $posts['title']; ?>">
    </div>
    <div class="col-md-6 offset-md-3">
        <label>Conteúdo</label>
        <input type="text" class="form-control" name="content" value="<?php echo $posts['content']; ?>">
    </div>
    <div class="col-md-6 offset-md-3">
        <label>Url</label>
        <input type="text" class="form-control" name="url" value="<?php echo $posts['url']; ?>">
    </div>
    <div class="col-md-6 offset-md-3">
        <br>
        <button type="submit" class="btn btn-primary">Editar</button>
    </div>
</div>