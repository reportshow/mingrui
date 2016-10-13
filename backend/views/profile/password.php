<?php
use backend\components\Functions;

?>
<style type="text/css">
  .errorinfo{color:red;margin-left:30px;}
</style>
<div class='col-md-6'>
<!-- Horizontal Form -->
          <div class="box box-info setpasswordBox">
            <div class="box-header with-border">
              <h3 class="box-title">修改密码</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal " action="">
              <div class="box-body">
                <br><br>
                <div class="form-group hide">
                  <label for="inputPassword1" class="col-sm-3 control-label">旧密码</label>

                  <div class="col-sm-8">
                    <input type="password" name='oldpassword' class="form-control" id="inputPassword1" placeholder="无需旧密码" value='000000'>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword2" class="col-sm-3 control-label">新密码</label>

                  <div class="col-sm-8">
                    <input type="password"  name='newpassword'  class="form-control" id="inputPassword2" placeholder="新密码">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">重复新密码</label>

                  <div class="col-sm-8">
                    <input type="password"  name='newpassword2'  class="form-control" id="inputPassword3" placeholder="重复新密码">
                  </div>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <span class='errorinfo'></span>
                <button type="button" id='setpassword' class="btn btn-info pull-right"> 确 定 </button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
</div>
<script type="text/javascript">
  $('#setpassword').click(function(){
     if($("#inputPassword1").val().length < 3
      || $("#inputPassword2").val().length < 3
      || $("#inputPassword3").val().length < 3){
         $('.errorinfo').html('密码过短');
        return;
     }
     if($("#inputPassword2").val()!=$("#inputPassword3").val()){
         $('.errorinfo').html('2次输入的新密码不一致');
         return;
     }

    $('.errorinfo').html('');
       $setpasswordUrl = '<?=Functions::url('profile/setpassword')?>';
       $.ajax({
         type: "POST",
         url: $setpasswordUrl,
         data:  $(".setpasswordBox form").serializeArray(),
         dataType: "json",
         success: function(rlt){
            $('.errorinfo').html(rlt.msg);
            /*if(rlt.code==1){

            }*/
         }
     });

  });
</script>