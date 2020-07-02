this is ajax
<br>
<br>
<div class="col-md-12">
    <label>Tags</label>
    <input type="text" class="form-control" name="tags" id="tags" disabled="">
</div>
<div style="padding-right: 15px">
    <div class="row">
        <div>
            <select class="custom-select" name="filter" id="filter">
                <?php foreach ($tags as $tag) : ?>
                    <option value="<?php echo $tag['name']; ?>"><?php echo $tag['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button id="tag">Escolher</button>
        <button id="escolhas">Verifica</button>
        <button id="clean">Limpar</button>
    </div>
</div>

<script>
    $(document).ready(function() {
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

        $('#escolhas').on('click', function() {
            var escolhas = document.getElementById('tags').value;
            console.log(escolhas);
        });
    });
</script>

123