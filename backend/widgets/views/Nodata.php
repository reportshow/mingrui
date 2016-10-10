<?php
if (empty($title)) {
    $title = '抱歉';
}

?><div class="alert alert-info alert-dismissible">
    <h4>
        <i class="icon fa fa-info">
        </i>
        <?=$title?>
    </h4>
    <?=$message?>
</div>