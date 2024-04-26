<style>
    .droppable-active {
        background-color: #ffe !important;
    }

    .tools a {
        cursor: pointer;
        font-size: 80%;
    }

    .form-body .col-md-6,
    .form-body .col-md-12 {
        min-height: 400px;
    }

    .draggable {
        cursor: move;
    }
</style>
<script>
    $(document).ready(function() {
        setup_draggable();

        $("#n-columns").on("change", function() {
            var v = $(this).val();
            $('#grid').val(v);
            if (v === "1") {
                var $col = $('.form-body .col-md-12').toggle(true);
                $('.form-body .col-md-6 .draggable').each(function(i, el) {
                    $(this).remove().appendTo($col);
                })
                $('.form-body .col-md-6').toggle(false);
            } else {
                var $col = $('.form-body .col-md-6').toggle(true);
                $(".form-body .col-md-12 .draggable").each(function(i, el) {
                    $(this).remove().appendTo(i % 2 ? $col[1] : $col[0]);
                });
                $('.form-body .col-md-12').toggle(false);
            }
        });

        $("#copy-to-clipboard").on("click", function() {
            var $copy = $(".form-body").parent().clone().appendTo(document.body);
            $copy.find(".tools, :hidden").remove();
            $.each(["draggable", "droppable", "sortable", "dropped",
                "ui-sortable", "ui-draggable", "ui-droppable", "form-body"
            ], function(i, c) {
                $copy.find("." + c).removeClass(c);
            })
            var html = html_beautify($copy.html());
            $copy.remove();

            $modal = get_modal(html).modal("show");
            $modal.find(".btn").remove();
            $modal.find(".modal-title").html("Copy HTML");
            $modal.find(":input:first").select().focus();

            return false;
        })


    });

    var setup_draggable = function() {
        $(".draggable").draggable({
            appendTo: "body",
            helper: "clone"
        });
        $(".droppable").droppable({
            accept: ".draggable",
            helper: "clone",
            hoverClass: "droppable-active",
            drop: function(event, ui) {
                $(".empty-form").remove();
                var $orig = $(ui.draggable)
                if (!$(ui.draggable).hasClass("dropped")) {
                    var $el = $orig
                        .clone()
                        .addClass("dropped")
                        .css({
                            "position": "static",
                            "left": null,
                            "right": null
                        })
                        .appendTo(this);

                    // update id
                    var id = $orig.find(":input").attr("id");

                    if (id) {
                        id = id.split("-").slice(0, -1).join("-") + "-" +
                            (parseInt(id.split("-").slice(-1)[0]) + 1)

                        $orig.find(":input").attr("id", id);
                        $orig.find("label").attr("for", id);
                    }

                    // tools
                    $('<p class="tools">\
						<a class="edit-link"><i class="fas fa-pen-square"> Edit</i><a> | \
						<a class="remove-link"><i class="fas fa-trash-alt"> Remove</i></a></p>').appendTo($el);
                } else {
                    if ($(this)[0] != $orig.parent()[0]) {
                        var $el = $orig
                            .clone()
                            .css({
                                "position": "static",
                                "left": null,
                                "right": null
                            })
                            .appendTo(this);
                        $orig.remove();
                    }
                }
            }
        }).sortable();

    }

    var get_modal = function(content) {
        var modal = $('<div class="modal" style="overflow: auto;" tabindex="-1">\
			<div class="modal-dialog">\
				<div class="modal-content">\
					<div class="modal-header">\
						<a type="button" class="close"\
							data-dismiss="modal" aria-hidden="true">&times;</a>\
						<h4 class="modal-title">Edit HTML</h4>\
					</div>\
					<div class="modal-body ui-front">\
						<textarea class="form-control" \
							style="min-height: 200px; margin-bottom: 10px;\
							font-family: Monaco, Fixed">' + content + '</textarea>\
						<button class="btn btn-success">Update</button>\
					</div>\
				</div>\
			</div>\
			</div>').appendTo(document.body);

        return modal;
    };

    $(document).on("click", ".edit-link", function(ev) {
        var $el = $(this).parent().parent();
        var $el_copy = $el.clone();

        var $edit_btn = $el_copy.find(".edit-link").parent().remove();

        var $modal = get_modal(html_beautify($el_copy.html())).modal("show");
        $modal.find(":input:first").focus();
        $modal.find(".btn-success").click(function(ev2) {
            var html = $modal.find("textarea").val();
            if (!html) {
                $el.remove();
            } else {
                $el.html(html);
                $edit_btn.appendTo($el);
            }
            $modal.modal("hide");
            return false;
        })
    });

    $(document).on("click", ".remove-link", function(ev) {
        $(this).parent().parent().remove();
    });
</script>
<nav class="navbar navbar-default navbar-fixed" role="navigation">
    <div class="navbar-header">
        <a class="navbar-brand" href="#">MN 1.0.0 Form Builder</a>
    </div>
    <form class="navbar-form navbar-left">
        <div class="form-group">
            <select class="form-control" id="n-columns">
                <option value="1">1 Column</option>
                <option value="2">2 Column</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" data-clipboard-text="testing" id="copy-to-clipboard">HTML</button>
    </form>
</nav>
<div style="margin-top: -20px;">
    <div class="row">
        <div class="col-md-3" style="padding: 20px; background-color: #fff;">
            <h3>Elements</h3>
            <!-- <form role="form"> -->
            <div class="form-group draggable">
                <input for="input-text-1" name="label[]" placeholder="Text Input" style="border:none">
                <input type="text" name="content[]" class="form-control" id="input-id-1" placeholder="Enter Your Info">
                <input type="hidden" name="type[]" value="text">
            </div>
            <div class="form-group draggable">
                <input for="input-password-1" name="label[]" placeholder="Date" style="border:none">
                <input type="date" name="content[]" class="form-control" id="input-password-1" placeholder="Password">
                <input type="hidden" name="type[]" value="date">
            </div>
            <div class="form-group draggable">
                <input for="input-password-1" name="label[]" placeholder="Textarea" style="border:none">
                <input type="hidden" name="type[]" value="textarea">
                <textarea name="content[]" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="form-group draggable">
                <input for="input-file-1" name="label[]" placeholder="File input" style="border:none">
                <input name="content[]" type="file" id="input-file-1">
                <input type="hidden" name="type[]" value="file">
            </div>
            <!-- </form> -->
        </div>
        <div class="col-md-9" style="padding: 0px;">
            <div style="background-color: #fff; border-radius: 5px; padding: 20px; 
						box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175); ">
                <div class="text-muted empty-form text-center" style="font-size: 24px;">Drag & Drop elements to build form.</div>
                <form method="post" action="">
                    <div class="row form-body">
                        <div class="col-md-12 droppable sortable">
                        </div>
                        <div class="col-md-6 droppable sortable" style="display: none;">
                        </div>
                        <div class="col-md-6 droppable sortable" style="display: none;">
                        </div>

                        <input type="hidden" name="grid[]" id="grid">
                        <input type="hidden" name="submit_custom_form" value="1">
                        <button class="btn btn-sm btn-outline-secondary" name="submit_custom_form">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>