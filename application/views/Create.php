<?php echo validation_errors(); ?>

<?php echo form_open('create'); ?>
<div class="row">
    <div class="col-md-6 offset-md-3">
        <label>Título</label>
        <input type="text" class="form-control" name="title">
    </div>
    <div class="col-md-6 offset-md-3">
        <label>Conteúdo</label>
        <input type="text" class="form-control" name="content">
    </div>
    <div class="col-md-6 offset-md-3">
        <label>Url</label>
        <input type="text" class="form-control" name="url">
    </div>
    <div class="col-md-6 offset-md-3">
        <br>
        <button type="submit" class="btn btn-primary">Criar</button>
    </div>
</div>