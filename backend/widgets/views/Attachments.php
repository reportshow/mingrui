
<?php

if (!empty($files) && is_array($files)) {

    foreach ($files as $k => $val) {
        if ($val->type == 'image') {
            $url = $val->url;
            echo "<img src='{$url}'   class='margin' style='cursor:pointer;width:120px'>";
        } else if ($val->type == 'file') {
            $icon     = $val->icon;
            $url      = $val->url;
            $filename = $val->filename;
            echo " <a class='file' >
                     <img src='$icon'> <br><span>$filename</span>
                     </a>";
        }

    } //foreach ($model->images

} //=====if(!empty($file))


//不是初始化
if (empty($init)) {

    return;
}

?>

<style type="text/css">
  .file{margin:15px;vertical-align: middle; padding:  10px; display: inline-block;  text-align: center;
    box-shadow: 1px 1px 1px 1px rgba(206, 206, 206, 0.77);}
  .file img{height: 120px; width: 120px;  margin-bottom:15px;}
  .file{ border-top-left-radius:4px;border-top-right-radius:4px;}
  .file:hover{  cursor:pointer;}
  .file span{    display: block;    background: #6B6B6B;    color: #fff;}

</style>

<style type="text/css">
  .previewbg{
    background: rgba(0,0,0,0.5);
   display: none;
    top:0px;left:0px;width: 100%;height: 100%;
    z-index: 11111;
    position: fixed;

 }
  .previewbox{     position: absolute;   -webkit-transition:all 1s;
   -webkit-transform:scale(0);    width: 100%;
    height: 100%;
  }
  .previewbox img{width: 100%; top: 50%;      position: absolute;  transform: translateY(-50%);}
  .zoomIn .previewbox{
    -webkit-transform:scale(1);
  }
 .zoomOut .previewbox{
    -webkit-transform:scale(0);
  }
</style>
<div class='previewbg'>
    <div class=previewbox>
        <img src='images/1.png'>
    </div>
</div>
<script type="text/javascript">
$(function(){
    $('.timeline-body img').click(function(){
       var imgurl = $(this).attr('src');
       $('.previewbg').fadeIn();
          $('.previewbg .previewbox img').attr('src',imgurl);
         $('.previewbg').removeClass('zoomOut').addClass('zoomIn');
    });
    $('.previewbg').click(function(){
         $('.previewbg').removeClass('zoomIn').addClass('zoomOut');
         $('.previewbg').fadeOut();
    });
});
</script>