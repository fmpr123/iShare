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
<?php echo form_close(); ?>

<div class="row">
    <div class="col-md-6 offset-md-3">
        <button class="btn btn-primary" id="ct">Preview Thumbnail</button>
    </div>
    <div class="col-md-6 offset-md-3">
        <br>
        <img class="image_preview" src="" alt="" id="img">
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#ct').on('click', function() {
            var userUrl = document.getElementById('url').value;
            $.ajax({
                url: "https://api.linkpreview.net?key=8f9f867a82e13139b24bf9c7d9cb9387&q=" + userUrl,
                success: function(result) {
                    document.getElementById("img").src = result.image;
                }
            });
        });
    });
</script>