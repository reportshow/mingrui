<?php
$this->title = '';
$this->params['breadcrumbs']  = '' ;
 


?><div class="box box-solid fullhight"  height="100%">
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
                    <div alt="First slide " class=" slidepic fullhight" src="images/1.png" >
                        <div class="carousel-caption">
                            First Slide
                        </div>
                    </div>
                </div>
                <div class="item fullhight">
                    <div  alt="Second slide" class=" slidepic fullhight" src="images/2.png"  >
                        <div class="carousel-caption">
                            Second Slide
                        </div>
                    </div>
                </div>
                <div class="item fullhight">
                    <div alt="Third slide" class="slidepic fullhight" src="images/3.png">
                        <div class="carousel-caption">
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

<style type="text/css">
    .slidepic{background-size: cover}
</style>
<script type="text/javascript">
    $('.slidepic').each(function(){
        $(this).css('background-image', "url("+$(this).attr('src')+")");
    });
</script>