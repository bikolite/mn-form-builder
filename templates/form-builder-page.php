<nav class="navbar navbar-default navbar-fixed" role="navigation" style="margin: 0;">
    <div class="navbar-header">
        <a class="navbar-brand" href="#">MN 1.0.0 Form Builder</a>
    </div>
</nav>

<div style="margin: 0 13px;">
    <div class="form_builder" style="margin-top: 5px">
        <div class="row">
            <div class="col-sm-2 p-0">
                <nav class="nav-sidebar">
                    <div style="padding: 0 5px;">Basic Components</div>
                    <ul class="nav">
                        <li class="form_bal_textfield">
                            <a href="javascript:;" style="display: flex; align-items:center; justify-content:space-between"><span>Text Field</span> <i class="fa fa-plus pull-right"></i>
                        </li>
                        <li class="form_bal_textarea">
                            <a href="javascript:;" style="display: flex; align-items:center; justify-content:space-between"><span>Text Area</span> <i class="fa fa-plus pull-right"></i></a>
                        </li>
                        <li class="form_bal_email">
                            <a href="javascript:;" style="display: flex; align-items:center; justify-content:space-between"><span>Email</span> <i class="fa fa-plus pull-right"></i></a>
                        </li>
                        <li class="form_bal_number">
                            <a href="javascript:;" style="display: flex; align-items:center; justify-content:space-between"><span>Number</span> <i class="fa fa-plus pull-right"></i></a>
                        </li>
                        <li class="form_bal_password">
                            <a href="javascript:;" style="display: flex; align-items:center; justify-content:space-between"><span>Password</span> <i class="fa fa-plus pull-right"></i></a>
                        </li>
                        <li class="form_bal_date">
                            <a href="javascript:;" style="display: flex; align-items:center; justify-content:space-between"><span>Date</span> <i class="fa fa-plus pull-right"></i></a>
                        </li>
                        <li class="form_bal_button" style="padding-bottom: 5px;">
                            <a href="javascript:;" style="display: flex; align-items:center; justify-content:space-between"><span>Button </span><i class="fa fa-plus pull-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-4 bal_builder">
                <div class="form_builder_area"></div>
            </div>
            <div class="col-md-6">
                <div class="col-md-12">
                    <form class="form-horizontal" method="post" action="">
                        <div class="preview" id="preview">
                        </div>
                        <div style="display: none" class="form-group plain_html"><textarea rows="50" class="form-control"></textarea></div>

                        <input type="hidden" name="submit_custom_form" value="1">
                        <button class="btn btn-sm btn-outline-secondary" style="margin-top: 10px;" name="submit_custom_form">Save Form</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>