<?php echo validation_errors();?>

<?php echo form_open('login'); ?>
<div class="row">
    <div class="col-md-6 offset-md-3">
        <label>Email</label>
        <input type="text" class="form-control" name="email">
    </div>
    <div class="col-md-6 offset-md-3">
        <label>Password</label>
        <input type="password" class="form-control" name="password">
    </div>
    <div class="col-md-6 offset-md-3">
        <button type="submit" class="btn btn-primary">Login</button>
    </div>
</div>