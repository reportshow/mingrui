<?php
if (empty($title)) {
    $title = '抱歉';
}
$bgtxt = '';
if(!empty($background)){
	$bgtxt = "background-color: $background !important;border:0px";
	//exit($bgtxt);
}

?><div class="alert alert-info alert-dismissible" style="<?=$bgtxt?>">
    <h4>
        <i class="icon fa fa-info">
        </i>
        <?=$title?>
    </h4>
    <?=$message?>
</div>