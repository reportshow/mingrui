 <!-- Info Boxes Style 2 -->
  <div class="info-box bg-<?=$model->color ?>">
    <span class="info-box-icon">
    <i class="ion ion-<?=$model->icon ?>">
     
    </i>
    </span>

    <div class="info-box-content">
      <span class="info-box-text"><?=$model->tag ?></span>
      <span class="info-box-number"><?=$model->total ?></span>

      <div class="progress">
        <div class="progress-bar" style="width: <?=$model->percent ?>"></div>
      </div>
          <span class="progress-description">
            <?=$model->percent ?> <?=$model->partinfo ?>
          </span>
    </div>
    <!-- /.info-box-content -->
  </div>