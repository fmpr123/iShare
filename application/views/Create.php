<?php echo validation_errors(); ?>

<div class="container">
    <?php echo form_open('create'); ?>
    <div class="row">
        <div class="col-md-12">
            <label>Título</label>
            <input type="text" class="form-control" name="title">
        </div>
        <div class="col-md-12">
            <label>Conteúdo</label>
            <input type="text" class="form-control" name="content">
        </div>
        <div class="col-md-12">
            <label>Url</label>
            <div class="row">
                <div class="col-md-10">
                    <input type="text" class="form-control" name="url" id="url">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary" id="ct">Preview</button>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <label>Tags</label>
            <div class="row">
                <div class="col-md-7">
                    <input type="text" class="form-control" name="tags" id="tags" disabled>
                </div>
                <div class="col-md-2">
                    <select class="custom-select" name="filter" id="filter">
                        <?php foreach ($tags as $tag) : ?>
                            <option value="<?php echo $tag['name']; ?>"><?php echo $tag['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary" type="button" id="tag">Escolher</button>
                    <button class="btn btn-primary" type="button" id="clean">Limpar</button>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <br>
            <button type="submit" class="btn btn-primary">Criar</button>
        </div>
    </div>
    <?php echo form_close(); ?>
    <div class="row">
        <div class="col-md-12">
            <img class="image_preview" src="" alt="" id="img">
        </div>
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
        var times = 0;
        $('#tag').on('click', function() {
            if (times < 3) {
                var tag = document.getElementById('filter').value;
                document.getElementById("tags").value += tag + " ";
                times++;
                console.log(times);
            } else {
                window.alert("Número máximo de tags atingido.");
            }
        });
        $('#clean').on('click', function() {
            document.getElementById("tags").value = '';
            times = 0;
        });
    });
</script>