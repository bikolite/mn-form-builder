<div class="page-content" ng-app="formioApp">
    <div class="container-fluid">
        <div>
            <div class="row" style="margin: 0;">
                <div class="col-sm-8" style="padding: 0;">
                    <pre style="margin: 0;"><h4 style="margin-bottom: 2px;"><code>Form Builder 1.0.0  <select class="form-control form-type-select" ng-model="form.display" ng-options="display.name as display.title for display in displays"></select></code></h4></pre>
                    <div class="well" style="background-color: #fdfdfd;">
                        <form-builder form="form"></form-builder>
                    </div>
                </div>

                <div class="col-sm-4">
                    <pre><h4><code>Preview</code></h4></pre>
                    <div class="well">
                        <formio form="form" ng-if="renderForm"></formio>
                    </div>
                    
                <button class="btn btn-sm btn-primary btn-block" name="submit_custom_form">Submit Building Form</button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row" style="display: none;">
                <div class="col-sm-4">
                    <pre><h4><code>Json Format</code></h4></pre>
                    <div class="well jsonviewer">
                        <json-explorer data="form" collapsed="jsonCollapsed"></json-explorer>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function($) {
        $('button[name="submit_custom_form"]').on('click', function(e) {
            e.preventDefault();
            var textareaValue = $('#json-textarea').val();

            $.ajax({
                url: ajaxurl,
                type: 'post',
                data: {
                    action: 'save_custom_form_data',
                    textarea_content: textareaValue
                },
                success: function(response) {
                    if (response === 'success') {
                        alert('Form data saved successfully!');
                    } else {
                        alert('Error saving form data.');
                    }
                }
            });
        });
    });
</script>