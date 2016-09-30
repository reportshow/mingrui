<?php
if(empty($init)){  //不是初始化

?>
                <div class="direct-chat-text bg-aqua voiceplaybox" onclick="playvoice(this)" voiceid='<?=$voice->voiceid ?>' voiceurl='<?=$voice->url ?>' >

 		           <!--audio src=" " controls="controls" style='width:160px;margin:10px 0px 0px 10px'></audio-->

                    <div class='btn-social' style="height: 30px;line-height: 30px;">
                     <i class='icon fa  fa-play-circle-o' style="cursor:pointer;margin-left:-5px;margin-top:-2px;"></i> 
                       <?=$voice->text?>
                    </div>
                </div>   


<?php


}else{//----------------------
 
 

?>


<script type="text/javascript">
    var s0;
    var playRes = null;
    var isPlay = false;
    function playvoice(obj){
        
         stopvioce(); 
        
        s0 = new Audio($(obj).attr('voiceurl'));
        playRes = $(obj).attr('voiceid')  ;

        $(".voiceplaybox[voiceid='"+playRes+"'] .icon").removeClass('fa-play-circle-o').addClass('fa-volume-up');
        s0.play();
        isPlay = true;

        s0.onended = function(){  
            isPlay=false;
            $(".voiceplaybox[voiceid='"+playRes+"'] .icon").addClass('fa-play-circle-o').removeClass('fa-volume-up');
        };  
        
        s0.onerror =s0.onended;

    }

    function stopvioce(){
      if(isPlay){  
          s0.stop();
          isPlay = false;
          $(".voiceplaybox[voiceid='"+playRes+"'] .icon").addClass('fa-play-circle-o').removeClass('fa-volume-up');
       }
    }



</script>

<?php

}

?>