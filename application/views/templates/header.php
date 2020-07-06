<!-- CDN -->
<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/flatly/bootstrap.min.css" rel="stylesheet" integrity="sha384-yrfSO0DBjS56u5M+SjWTyAHujrkiYVtRYh2dtB3yLQtUz3bodOeialO59u5lUCFF" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="css/style.css" rel="stylesheet">

<!-- Menu -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="<?php echo base_url(); ?>">iShare</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url(); ?>">Home</span></a>
            </li>
            <?php if ($this->session->userdata('logged_in')) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url(); ?>create">Criar</a>
                </li>
            <?php endif; ?>
        </ul>
        <ul class="na navbar-nav navbar-right">
            <?php if (!$this->session->userdata('logged_in')) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url(); ?>login">Login</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url(); ?>register">Registar</a>
                </li>
            <?php endif; ?>
            <?php if ($this->session->userdata('logged_in')) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url(); ?>logout">Logout</a>
                </li>
                <li>
                    <img class="logged_user" src="images/user_photo/<?php echo $this->session->userdata('user_photo'); ?>.jpg">
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
<br>
</div>
<div class="container">
    <!-- Login feito com sucesso -->
    <?php if ($this->session->flashdata('login_success')) : ?>
        <?php echo '<div class="alert alert-dismissible alert-success" style="margin-right: 10px;">
        <button type="button" class="close" data-dismiss="alert">&times;</button>' . $this->session->flashdata('login_success') . '</a></div>'; ?>
    <?php endif; ?>
    <!-- Login falhado -->
    <?php if ($this->session->flashdata('login_error')) : ?>
        <?php echo '<div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>' . $this->session->flashdata('login_error') . '</a></div>'; ?>
    <?php endif; ?>
    <!-- Logout -->
    <?php if ($this->session->flashdata('logout')) : ?>
        <?php echo '<div class="alert alert-dismissible alert-success" style="margin-right: 10px;">
        <button type="button" class="close" data-dismiss="alert">&times;</button>' . $this->session->flashdata('logout') . '</a></div>'; ?>
    <?php endif; ?>
    <!-- Erro de signup -->
    <?php if ($this->session->flashdata('signup_error')) : ?>
        <?php echo '<div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>' . $this->session->flashdata('signup_error') . '</a></div>'; ?>
    <?php endif; ?>
    <!-- Signup feito com sucesso -->
    <?php if ($this->session->flashdata('signup_success')) : ?>
        <?php echo '<div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>' . $this->session->flashdata('signup_success') . '</a></div>'; ?>
    <?php endif; ?>
    <!-- Signup feito com sucesso -->
    <?php if ($this->session->flashdata('repeated_tag')) : ?>
        <?php echo '<div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>' . $this->session->flashdata('repeated_tag') . '</a></div>'; ?>
    <?php endif; ?>
</div>