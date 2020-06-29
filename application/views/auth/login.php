<?php echo validation_errors(); ?>

<div class="container">
    <?php echo form_open('login'); ?>
    <div class="row">
        <div class="col-md-12">
            <label>Email</label>
            <input type="text" class="form-control" name="email">
        </div>
        <div class="col-md-12">
            <label>Password</label>
            <input type="password" class="form-control" name="password">
        </div>
        <div class="col-md-12">
            <br>
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </div>
</div>