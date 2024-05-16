<?php
// echo $content = $post->ID;
$content = $post->post_content;
$json_data = json_decode($content);

if ($json_data === null && json_last_error() !== JSON_ERROR_NONE) {
    echo "<p>Error decoding JSON data</p>";
} else {
    
    ?> <div class="row"> <?php
    foreach ($json_data as $item) {
        if (isset($item->type) && $item->type == 'textarea') {
        ?>
            <div class="<?php
                if(isset($item->className)){
                    echo $item->className;
                }
            ?>" style="padding: 0; margin-bottom: 5px">
                <label for=""><?= $item->label ?></label>
                <textarea class="form-control" rows="<?= $item->rows ?>" id="<?= $item->type ?>"></textarea>
            </div>
        <?php
        } elseif (isset($item->type) && $item->type == 'textfield') {
        ?>
            <div class="<?php
                if(isset($item->className)){
                    echo $item->className;
                }
            ?>" style="padding: 0; margin-bottom: 5px">
                <label for=""><?= $item->label ?></label>
                <input class="form-control" type="<?= $item->key ?>" id="<?= $item->key ?>" placeholder="<?= $item->placeholder ?>">
            </div>
        <?php
        }elseif (isset($item->type) && $item->type == 'number') {
        ?>
            <div class="<?php
                if(isset($item->className)){
                    echo $item->className;
                }
            ?>" style="padding: 0; margin-bottom: 5px">
                <label for=""><?= $item->label ?></label>
                <input class="form-control" type="<?= $item->key ?>" id="<?= $item->type ?>" placeholder="<?= $item->placeholder ?>">
            </div>
        <?php
        } elseif (isset($item->type) && $item->type == 'password') {
        ?>
            <div class="<?php
                if(isset($item->className)){
                    echo $item->className;
                }
            ?>" style="padding: 0; margin-bottom: 5px">
                <label for=""><?= $item->label ?></label>
                <input class="form-control" type="<?= $item->key ?>" id="<?= $item->type ?>" placeholder="<?= $item->placeholder ?>">
            </div>
        <?php
        } elseif (isset($item->type) && $item->type == 'checkbox') {
        ?>
        <div class="form-control" style="margin-bottom: 5px">
            <input type="<?= $item->type ?>" id="<?= $item->type ?>">
            <label class="form-check-label" for="flexSwitchCheckDefault"><?= $item->label ?></label>
        </div>
        <?php
        }
        elseif (isset($item->type) && $item->type == 'select') {
            ?>
            <div class="<?php
                if(isset($item->className)){
                    echo $item->className;
                }
            ?>
            " style="padding: 0; margin-bottom: 5px">
            <select class="form-control" id="floatingSelect" aria-label="Floating label select example">
                <option selected><?= $item->label ?></option>
                <?php foreach ($item->values as $val) { ?>
                <option value="<?= $val->value ?>"><?= $val->label ?></option>
                <?php } ?>

            </select>
            </div>
            <?php
            } elseif (isset($item->type) && $item->type == 'button') {
        ?>
        <div class="form">
            <button  style="margin-top: 10px;" type="<?= $item->type ?>"class="btn btn-primary col-md-12">Submit</button>
        </div>
        <?php
        }
    }
    
    ?> </div> <?php
}
?>
