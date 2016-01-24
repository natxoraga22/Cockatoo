<?php
switch ($widget_label) {
    case "Posts":
        $panel_type = "panel-primary";
        $fa_icon = "fa-file-text";
        break;
    case "Comments":
        $panel_type = "panel-green";
        $fa_icon = "fa-comments";
        break;
    case "Users":
        $panel_type = "panel-yellow";
        $fa_icon = "fa-users";
        break;
    case "Categories":
        $panel_type = "panel-red";
        $fa_icon = "fa-tags";
        break;
    default: break;
}
?> 

<div class="col-lg-3 col-md-6">
    <div class="panel <?php echo $panel_type ?>">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-5x <?php echo $fa_icon ?>"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <div class='huge'><?php echo $count_label ?></div>
                    <div><?php echo $widget_label ?></div>
                </div>
            </div>
        </div>
        <a href="<?php echo $widget_link ?>">
            <div class="panel-footer">
                <span class="pull-left">View Details</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
</div>