<div class="progress-group">
	<span class="progress-text"><?=$model->tag ?></span>
	<span class="progress-number"><b><?=$model->done ?></b>/<?=$model->total ?></span>

	<div class="progress sm">
	  <div class="progress-bar progress-bar-<?=$model->color ?>" style="width: <?=$model->percent ?>"></div>
	</div>
</div>