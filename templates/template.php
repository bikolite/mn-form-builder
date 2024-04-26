<?php
global $wpdb;
$table_name = $wpdb->prefix . 'fields';
$form_data = $wpdb->get_results("SELECT * FROM $table_name");

// Encode form_data into JSON format
$form_data_json = json_encode($form_data, JSON_PRETTY_PRINT);
?>

<!-- JSON output -->
<div id="json-output" style="display: none;"><?php echo htmlspecialchars($form_data_json); ?></div>
<?php foreach ($form_data as $row) : ?>
    <?php
    // Decode the JSON-encoded form data
    $decoded_data = json_decode($row->form_data, true);

    ?>
    <form>
        <div class="row">
            <?php

            if ($decoded_data !== null) {
                foreach ($decoded_data as $field) {
                    // print_r($field);
                    $grid = $field['grid'];
                    $class = ($grid === '1' || $grid === '') ? 'col-md-12' : 'col-md-6';
                    if (isset($field['type']) && $field['type'] === 'text') {
                    ?>
                        <div class="<?php echo  $class; ?>">
                            <label for="exampleFormControlInput1"><?php echo $field['label_name'] ?></label>
                            <input type="<?php echo $field['type'] ?>" class="form-control" id="exampleFormControlInput1" placeholder="Enter Your <?php echo $field['label_name'] ?>">
                        </div>
                    <?php
                    }elseif(isset($field['type']) && $field['type'] === 'date'){
                        ?>
                            <div class="<?php echo  $class; ?>">
                                <label for="exampleFormControlInput1"><?php echo $field['label_name'] ?></label>
                                <input type="<?php echo $field['type'] ?>" class="form-control" id="exampleFormControlInput1" placeholder="Enter Your <?php echo $field['label_name'] ?>">
                            </div>
                        <?php
                    }elseif(isset($field['type']) && $field['type'] === 'textarea'){
                        ?>
                            <div class="<?php echo  $class; ?>">
                                <label for="exampleFormControlInput1"><?php echo $field['label_name'] ?></label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="1"></textarea>
                            </div>
                        <?php
                    }elseif(isset($field['type']) && $field['type'] === 'file'){
                        ?>
                        <div class="<?php echo  $class; ?>">
                            <label for="exampleFormControlFile1"><?php echo $field['label_name'] ?></label><br>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1">
                        </div>
                        <?php
                    }
                }
            } else {
                echo "<p>Error decoding JSON data</p>";
            }

            ?>
            
            <input type="hidden" name="submit_custom_form" value="1">
            <button type="submit"style="margin-top: 20px" name="submit_custom_form" class="btn btn-primary">Submit</button>
        </div>
    </form>
<?php endforeach; ?>