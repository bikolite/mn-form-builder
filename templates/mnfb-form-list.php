<?php
global $wpdb;
$table_name = $wpdb->prefix . 'fields';
$form_data = $wpdb->get_results("SELECT * FROM $table_name");

// Encode form_data into JSON format
$form_data_json = json_encode($form_data, JSON_PRETTY_PRINT);
?>

<!-- JSON output -->
<div id="json-output" style="display: none;"><?php echo htmlspecialchars($form_data_json); ?></div>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Form Data</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($form_data as $index => $row) : ?>
    <tr>
        <td><?php echo $index + 1 ?></td>
        <td>
            <?php
            // Decode the JSON-encoded form data
            $decoded_data = json_decode($row->form_data, true);

            // Check if decoding was successful
            if ($decoded_data !== null) {
                // Output each value from the decoded data
                foreach ($decoded_data as $key => $value) {
                    // Check if $value is an array
                    if (is_array($value)) {
                        // If $value is an array, convert it to a string
                        $value = implode(', ', $value);
                    }
                    echo "<p>$value</p>";
                }
            } else {
                // Display an error message if decoding failed
                echo "<p>Error decoding JSON data</p>";
            }
            ?>
        </td>
    </tr>
<?php endforeach; ?>



    </tbody>
</table>

<script>
    // Example of using JSON data in JavaScript
    document.addEventListener("DOMContentLoaded", function() {
        var jsonData = JSON.parse(document.getElementById('json-output').textContent);
        console.log(jsonData);
    });
</script>