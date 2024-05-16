<?php
global $wpdb;
$posts = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}posts WHERE post_type = 'form-post'");
?>

<div class="container-fluid" style="border: 1px solid #E0E0E0">
    <div class="table-row header">
        <div class="wrapper attributes">
            <div class="wrapper title-comment-module-reporter">
                <!-- <div class="wrapper title-comment">
                    <div class="column comment">Form Post Title</div>
                </div> -->
                <div class="wrapper module-reporter" style="margin-left: 30px;">
                    <div class="column module">Short Code</div>
                </div>
            </div>
            <div class="wrapper status-owner-severity">
                <div class="wrapper status-owner">
                    <div class="column status">Status</div>
                    <div class="column owner">Owner</div>
                </div>
            </div>
        </div>
        <div class="wrapper dates">
            <div class="column date">Created</div>
            <div class="column date">Updated</div>
        </div>
    </div>
    <?php
    foreach ($posts as $post) {
    ?>
        <div class="table-row">
            <div class="wrapper attributes">
                <div class="wrapper title-comment-module-reporter">
                    <!-- <div class="wrapper title-comment">
                        <div class="column comment">Form Post -> <?= $post->ID; ?></div>
                    </div> -->
                    <div class="wrapper module-reporter" style="margin-left: 30px;">
                        <div class="column module">[form_builder id="<?= $post->ID; ?>"]</div>
                    </div>
                </div>
                <div class="wrapper status-owner-severity">
                    <div class="wrapper status-owner">
                        <div class="column status"><span class="label label-primary"><?= $post->post_status; ?></span></div>
                        <div class="column owner"><?php echo get_the_author_meta('display_name', $post->post_author); ?></div>
                    </div>
                </div>
            </div>
            <div class="wrapper dates">
                <div class="column date"><?= $post->post_date; ?></div>
                <div class="column date"><?= $post->post_modified; ?></div>
            </div>
        </div>
    <?php
    }
    ?>
</div>