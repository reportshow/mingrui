<div class="row">
    <div class="col-md-12">
        <!-- Box Comment -->
        <div class="box box-widget">
            <div class="box-header with-border">
                
                     
                       <a href="#">
                          问题:     <?=$model->question?> 
                       </a>
                        
                        <span class="pull-right  ">
                            <?=date('Y-m-d',$model->createtime)?>
                        </span>
                   
                
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                 
                <?=$model->answer?>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>