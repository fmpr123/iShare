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
        <input type="text" class="form-control" name="url" id="url">
    </div>
    <div class="col-md-6 offset-md-3">
        <br>
        <button type="submit" class="btn btn-primary">Criar</button>
    </div>
</div>
<img src="" alt="" id="img">
<span id="res"></span>

<script type="text/javascript">
    $(document).ready(function() {
        <?php
        $target = urlencode("https://www.google.com");
        $key = "8f9f867a82e13139b24bf9c7d9cb9387";
        $ret = file_get_contents("https://api.linkpreview.net?key={$key}&q={$target}");
        $result = json_decode($ret);
        $image = $result->image;
        ?>
        document.getElementById("img").src = '<?php echo $image;?>';
        
        $('#url').on('paste', function() {
            var teste = document.getElementById('url').value;
            $('#res').html(teste);
            console.log(teste);
        });
    });
</script>