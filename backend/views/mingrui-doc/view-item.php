<div class="row">
    <div class="col-md-12">
        <!-- Box Comment -->
        <div class="box box-widget">
            <div class="box-header with-border">
                <div class="user-block">
                    <img alt="User Image" class="img-circle" src="<?=$model->creator->avatar ?>" />
                        <span class="username">
                            <a href="#">
                                <?=$model->creator->nickname ?>
                            </a>
                        </span>
                        <span class="description">
                            <?=date('Y-m-d',$model->createtime)?>
                        </span>
                    
                </div>
                <!-- /.user-block -->
                <div class="box-tools ">
                    <button class="btn btn-box-tool" data-widget="collapse" type="button">
                        <i class="fa fa-minus">
                        </i>
                    </button>
                    <button class="btn btn-box-tool" data-widget="remove" type="button">
                        <i class="fa fa-times">
                        </i>
                    </button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <h2 style="font-family: 'Microsoft Yahei';">
                    <?=$model->title?>
                </h2>
                <?=$model->description?>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>