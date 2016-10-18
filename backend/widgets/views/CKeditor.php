<div class="box box-info">
    <div class="box-header" >
        <h3 class="box-title" style="font-weight: bold;">
           <?=$model->title ?>  
        </h3>
        <!-- tools box -->
        <div class="pull-right box-tools" style="display: none">
            <button class="btn btn-info btn-sm" 
            data-toggle="tooltip" data-widget="collapse" title="Collapse" type="button">
                <i class="fa fa-minus">
                </i>
            </button>
            <button class="btn btn-info btn-sm" data-toggle="tooltip" data-widget="remove" title="Remove" type="button">
                <i class="fa fa-times">
                </i>
            </button>
        </div>
        <!-- /. tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body pad">
      
            <textarea cols="80" id="editor1" name="<?=$model->name ?>" rows="10">
                <?=$model->placehoder ?>
            </textarea>
        
    </div>
</div>
<!-- /.box -->


<script src="js/ckeditor/ckeditor.js">
</script>
<script>
    $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1');
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();
  });
</script>