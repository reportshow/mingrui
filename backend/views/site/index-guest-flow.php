<?php
$this->title = '';
$this->params['breadcrumbs']  = '' ;
 


?>
<style type="text/css">
    .slidepic{background-size: cover;background-position: center;}

</style>
<div class="box box-solid fullhight" id='sliderbox' height="100%">
    <!-- /.box-header -->
    <div class="box-body fullhight"  style="padding:0px;">
        <div class="carousel slide fullhight" data-ride="carousel" id="carousel-example-generic">
            <ol class="carousel-indicators">
                <li class="active" data-slide-to="0" data-target="#carousel-example-generic">
                </li>
                <li class="" data-slide-to="1" data-target="#carousel-example-generic">
                </li>
                <li class="" data-slide-to="2" data-target="#carousel-example-generic">
                </li>
            </ol>
            <div class="carousel-inner fullhight">
                <div class="item active fullhight">
                    <div alt="First slide " class=" slidepic fullhight" src="images/1.jpg" >
                        <div class="carousel-caption hide">
                            First Slide
                        </div>
                    </div>
                </div>
                <div class="item fullhight">
                    <div  alt="Second slide" class=" slidepic fullhight" src="images/2.jpg"  >
                        <div class="carousel-caption hide">
                            Second Slide
                        </div>
                    </div>
                </div>
                <div class="item fullhight">
                    <div alt="Third slide" class="slidepic fullhight" src="images/3.jpg">
                        <div class="carousel-caption hide">
                            Third Slide
                        </div>
                    </div>
                </div>
            </div>
            <a class="left carousel-control" data-slide="prev" href="#carousel-example-generic">
                <span class="fa fa-angle-left">
                </span>
            </a>
            <a class="right carousel-control" data-slide="next" href="#carousel-example-generic">
                <span class="fa fa-angle-right">
                </span>
            </a>
        </div>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->


<script type="text/javascript">
    $('.slidepic').each(function(){
        $(this).css('background-image', "url("+$(this).attr('src')+")");
    });
</script>