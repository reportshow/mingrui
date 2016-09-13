<?php

?>
<style type="text/css">
.direct-chat-text.bg-blue{margin-left: 0px;}
  .direct-chat-text.bg-blue:after{ border-right-color:#0073b7;}

.direct-chat-text.bg-aqua{margin-left: 0px;}
  .direct-chat-text.bg-aqua:after{ border-right-color:#00c0ef;}


}
</style>
<ul class="timeline" style="margin-left: 60px;">

<?php

$TIME_HTML =$date = 0;
foreach ($models as $key => $model) {

    $date1 = date('Y-m-d', strtotime($model->createtime));
    if ($date1 != $date) {
        timeHtml($date1);
        $date = $date1;
    }
    echo $this->render('TimeLine-item', ['model' => $model]);

}

function timeHtml($date1)
{
    echo <<<HTML
    <!-- timeline time label -->
    <li class="time-label" style="margin-left:-55px;">
        <span class="bg-green">
            $date1
        </span>
    </li>
    <!-- /.timeline-label -->
HTML;
}
?>
</ul>