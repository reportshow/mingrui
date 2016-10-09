<style type="text/css">
   
      .weixin_bg {
      position: absolute;
      z-index: -1;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      opacity: 0.8;
      }
     .nav4 ul, ol, li, dl {
      list-style-type: none;
      }
     .nav4  .box {
      width: 100%;
      margin: 0px;
      padding: 0px;
      border-top: 1px solid #fff;
      display: -webkit-box;
      display: -moz-box;
      -webkit-box-orient: horizontal;
      -moz-box-orient: horizontal;
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      }
    .nav4   .box > * {
      -webkit-box-flex: 1;
      -moz-box-flex: 1;
      }
    .nav4 a:link, .nav4 a:visited {
      color: #575757;
      text-decoration: none;
      }
    .nav4   a {
      text-decoration: none;
      -webkit-tap-highlight-color: rgba(0, 0, 0, 0.35);
      }
    .nav4   a:link, .nav4  a:visited {
      color: #575757;
      text-decoration: none;
      }
     .nav4  a {
      text-decoration: none;
      -webkit-tap-highlight-color: rgba(0, 0, 0, 0.35);
      }

      .nav4{
        height:40px;
      }
      .nav4 ul{
        position:fixed;
        z-index:200;
        bottom:0;
        left:0;
        width:100%
      }
      .nav4 li{
        border:1px solid rgba(190,190,190,1);
        height:40px;
        border-bottom:0;
        border-right:0;
        position:relative;
        -webkit-box-shadow:inset 0 0 3px #fff;
      }
      .nav4 li:nth-of-type(1){border-left;0;}
      .nav4 li>a{
        font-size:15px;
        -webkit-box-sizing:border-box;
        box-sizing:border-box;
        /*border:1px solid #f9f8f9;*/
        -webkit-tap-highlight-color:rgba(0,0,0,0);
        border-bottom:0;
        display:block;
        line-height:40px;
        text-align:center;
        background:-webkit-gradient(linear, 0 0, 0 100%, from(#f1f1f1), to(#dcdcdc), color-stop(35% ,#ededed), color-stop(50%, #e3e3e3) );
      }
      .nav4 li>a:only-child span{
        background:none;
        padding-left:0;
      }
      .nav4 li>a.on + dl{
        display: block;
      }
      .nav4 li>a span{
        color: #4f4d4f;
        display: inline-block;
        padding-left: 15px; 
        -webkit-background-size: 9px auto;
        text-shadow:0px 1px 0px #ffffff;
      }
      /***********************/
      .nav4 dl{
        display:none;
        position:absolute;
        z-index:220;
        bottom:58px;
        left:50%;
        width:100px;
         margin: 0px;  
        margin-left:-50px;
        background:red;
        /*min-height:100px;*/
        background:#e4e3e2;
        /*border:1px solid #afaeaf;*/
        border-radius:5px;
        -webkit-box-shadow:inset 0 0 3px #ccc; 
        -webkit-background-size:100%;
        background-size:100%;

      }
      /*, .nav4 dl:after*/
      .nav4 dl:before{
        content:"";
        display:inline-block;
        position:absolute;
        z-index:240;
        bottom:-10px;
        left:50%;
        width: 0;
    height: 0;
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-top: 10px solid #e4e3e2;
        transform: translateX(-50%);
     -webkit-transform: translateX(-50%);
      }
      /*.nav4 dl:after{
        z-index:241;
        border-color:#e4e3e2 transparent transparent transparent;
        margin-bottom:-15px;
      }*/
      .nav4 dl dd{
        line-height:45px;
        text-align:center;
        background:-webkit-gradient(linear, 0 0, 100% 0, from(rgba(194,194,194,0.8)), to(rgba(194,194,194,0.8)), color-stop(50%, rgba(194,194,194,0.8)));
        background-size:80% 1px;
        background-repeat:no-repeat;
        background-position: center bottom;
        /*background: url(imgs/3.svg#4) no-repeat center bottom;
        -webkit-background-size:100px 1px;*/
      }
      .nav4 dl dd:last-of-type{
        background:none;
      }
      .nav4 dl dd a{
        font-size: 15px;
        display:block;
        color:#4f4d4f;
        text-shadow:0px 1px 0px #ffffff;
        white-space: pre;
        overflow: hidden;
        text-overflow: ellipsis;
      }
      .nav4 .masklayer_div{
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 180;
        background: rgba(0,0,0,0);
      }
      .nav4 .masklayer_div.on{display: block;}
</style>
<div class="weixin_bg">
     
</div>
<div class="nav4" data-role="widget" data-widget="nav4">
    <nav>
        <div class="nav_4" id="nav4_ul">
            <ul class="box">
            <?php
              foreach($menus as $key=>$menu){ 

              $bootmenuHref = !empty($menu['url']) ? $menu['url'] : 'javascript:;' ;
          ?>
          <li>
            <a class="" href="<?=$bootmenuHref ?>"><?=$menu['name']?></a>
            <?php
          if(!empty($menu['sub_button'])){
             echo "<dl>";
              foreach ($menu['sub_button'] as $key => $submenu) {
            
            ?>
               <dd><a href="<?=$submenu['url']?>"><?=$submenu['name']?></a></dd>
            <?php 
           
            }//for sub_button
            echo "</dl>"; 
        }// if sub_button
    echo "</li>";
 }//for
   ?>
                
            </ul>
        </div>
    </nav>
    <div class="masklayer_div on" id="nav4_masklayer">
    </div>
    <script type="text/javascript">
        var nav4 =(function(){
        bindClick = function(els, mask){
          if(!els || !els.length){return;}
          var isMobile = "ontouchstart" in window;
          for(var i=0,ci; ci = els[i]; i++){
            ci.addEventListener("click", evtFn, false);
          }

          function evtFn(evt, ci){
            ci =this;
            for(var j=0,cj; cj = els[j]; j++){
              if(cj != ci){
                console.log(cj);
                cj.classList.remove("on");
              }
            }
            if(ci == mask){mask.classList.remove("on");return;}
            switch(evt.type){
              case "click":
                var on = ci.classList.toggle("on");
                mask.classList[on?"add":"remove"]("on");
              break;
            }
          }
          mask.addEventListener(isMobile?"touchstart":"click", evtFn, false);
        }
        return {"bindClick":bindClick};
   })();

        nav4.bindClick(document.getElementById("nav4_ul").querySelectorAll("li>a"), document.getElementById("nav4_masklayer"));
    </script>
</div>
