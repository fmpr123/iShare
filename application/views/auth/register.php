<?php echo validation_errors(); ?>

<?php echo form_open('register'); ?>
<div class="row">
    <div class="col-md-6 offset-md-3">
        <label>Nome</label>
        <input type="text" class="form-control" name="name">
    </div>
    <div class="col-md-6 offset-md-3">
        <label>Email</label>
        <input type="text" class="form-control" name="email">
    </div>
    <div class="col-md-6 offset-md-3">
        <label>Foto</label>
        <input type="text" class="form-control" name="photo">
    </div>
    <div class="col-md-6 offset-md-3">
        <label>Password</label>
        <input type="password" class="form-control" name="password">
    </div>
    <div class="col-md-6 offset-md-3">
        <button type="submit" class="btn btn-primary">Registar</button>
    </div>
</div>