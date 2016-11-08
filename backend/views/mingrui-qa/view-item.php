<div class="row">
    <div class="col-md-12">
        <!-- Box Comment -->
        <div class="box box-widget">
            <div class="box-header with-border">
                
                     
                       <a href="#">
                       <span style=' '>Q:</span>  <?=$model->question?> 
                       </a>
                        
                        <span class="pull-right  hide">
                            <?=date('Y-m-d',$model->createtime)?>
                        </span>
                   
                
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                 
              <span style=' '>A:</span> <?=$model->answer?>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>