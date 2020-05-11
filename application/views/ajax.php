this is ajax
<br>
<!-- <?php
        $target = urlencode("https://www.google.com");
        $key = "8f9f867a82e13139b24bf9c7d9cb9387";
        $ret = file_get_contents("https://api.linkpreview.net?key={$key}&q={$target}");
        $result = json_decode($ret);
        $image = $result->image;
        ?>
<br>
<img src="<?php echo $image; ?>" alt=""> -->
<br>
<div class="col-md-6 offset-md-3">
    <label>Url</label>
    <input type="text" class="form-control" id="url">
    <button id="btn">Test</button>
    <span id="confirm"></span>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#btn').click(function(){
            $('#confirm').html("ola");
        });
    });
</script>