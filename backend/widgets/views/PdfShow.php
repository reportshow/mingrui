<?php
use yii\helpers\Html;

?>
<div class="rest-report-view">
<?=Html::jsFile('@web/js/pdfobject.min.js')?>

<div id="example1"></div> 
<script>
var options = {
  pdfOpenParams: {
    navpanes: 0,
    toolbar: 0,
    statusbar: 0,
    pagemode: "none", //[thumbs|bookmarks|outline|none]
    view: "FitV",
    'locale':'zh-CN'
  },
  forcePDFJS: true,
  PDFJS_URL: "../../common/components/pdfjs/web/showpdf.php",
   fallbackLink: "<p>This is a <a href='[url]'>fallback link</a></p>"
};

if( /android|webos|iphone|ipad|ipod|blackberry|iemobile|opera/i.test(navigator.userAgent.toLowerCase()) ) {
  options.pdfOpenParams.pagemode = 'none';
  options.forcePDFJS=true;
}else{
 // options.pdfOpenParams.pagemode = 'outline';
  options.forcePDFJS=true;
}


PDFObject.embed("<?=$pdfurl ?>", "#example1", options);
/*PDFObject.embed("upload/NG16010024.pdf", "#example1");*/
/*var el = document.querySelector("#results");
el.setAttribute("class", (myPDF) ? "success" : "fail");
el.innerHTML = (myPDF) ? "PDFObject was successful!" : "Uh-oh, the embed didn't work.";
*/
</script>
<style>
.pdfobject-container { height: 600px;}
.pdfobject { border: 1px solid #666; }
</style>
</div>
<script type="text/javascript">
 var resizeTimer =  setInterval(function(){
   var h =  $("iframe").contents().find("#viewer").height();
   if(h > 1000){
      $(".pdfobject-container").height(h+50);
      $("iframe").height(h+50);
      clearInterval(resizeTimer);
      
      closePrograss();
       
   }

  },2000);
</script>