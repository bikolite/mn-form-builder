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
                    if (isset($field['type']) && $field['type'] === 'text') {
                    ?>
                        <div class="<?php echo  $field['class']; ?>">
                            <label for="exampleFormControlInput1"><?php echo $field['label'] ?></label>
                            <input type="<?php echo $field['type'] ?>" class="form-control" id="exampleFormControlInput1" placeholder="<?php echo $field['placeholder'] ?>" <?php echo $field['required'] ?>>
                        </div>
                    <?php
                    }elseif(isset($field['type']) && $field['type'] === 'date'){
                        ?>
                            <div class="<?php echo  $field['class']; ?>">
                                <label for="exampleFormControlInput1"><?php echo $field['label'] ?></label>
                                <input type="<?php echo $field['type'] ?>" class="form-control" id="exampleFormControlInput1" placeholder="<?php echo $field['placeholder'] ?>" <?php echo $field['required'] ?>>
                            </div>
                        <?php
                    }elseif(isset($field['type']) && $field['type'] === 'textarea'){
                        ?>
                            <div class="<?php echo  $field['class']; ?>">
                                <label for="exampleFormControlInput1"><?php echo $field['label'] ?></label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="1">
                                <?php echo $field['placeholder'] ?>
                                </textarea>
                            </div>
                        <?php
                    }elseif(isset($field['type']) && $field['type'] === 'email'){
                        ?>
                        <div class="<?php echo  $field['class']; ?>">
                            <label for="exampleFormControlFile1"><?php echo $field['label'] ?></label><br>
                            <input type="<?php echo $field['type'] ?>" class="form-control" id="exampleFormControlFile1" placeholder="<?php echo $field['placeholder'] ?>" <?php echo $field['required'] ?>>
                        </div>
                        <?php
                    }elseif(isset($field['type']) && $field['type'] === 'number'){
                        ?>
                        <div class="<?php echo  $field['class']; ?>">
                            <label for="exampleFormControlFile1"><?php echo $field['label'] ?></label><br>
                            <input type="<?php echo $field['type'] ?>" class="form-control" id="exampleFormControlFile1" placeholder="<?php echo $field['placeholder'] ?>" <?php echo $field['required'] ?>>
                        </div>
                        <?php
                    }elseif(isset($field['type']) && $field['type'] === 'password'){
                        ?>
                        <div class="<?php echo  $field['class']; ?>">
                            <label for="exampleFormControlFile1"><?php echo $field['label'] ?></label><br>
                            <input type="<?php echo $field['type'] ?>" class="form-control" id="exampleFormControlFile1" placeholder="<?php echo $field['placeholder'] ?>" <?php echo $field['required'] ?>>
                        </div>
                        <?php
                    }elseif(isset($field['type']) && $field['type'] === 'button'){
                        ?>
                        <div class="<?php echo  $field['class']; ?>">
                            <button style="margin-top: 10px;" class="<?php echo  $field['label']; ?> <?php echo  $field['class']; ?>"><?php echo  $field['placeholder']; ?></button>
                        </div>
                        <?php
                    }
                }
            } else {
                echo "<p>Error decoding JSON data</p>";
            }

            ?>
        </div>
    </form>
<?php endforeach; ?>