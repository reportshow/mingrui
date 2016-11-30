<?php
return [
    'adminEmail'        => 'admin@example.com',
    'videoserver'       => 'http://112.126.88.56:3000',
    'vcfservice'        => 'http://112.126.88.56:2000',
    'erp_url'           => 'http://shanghaijinzhun.com/',
    'wechat_sick'       => require 'wechat.sick.php',
    'wechat_doctor'     => require 'wechat.doctor.php',

    //管理员的手机
    'master_vcf_mobile' => ['13611262703', '15001087980', '13910136035', '15910956004'],
    'master_vcf_voice'  => 'Untitled1.wav',

    //测试时，把所有的短信都发到这里
    'allsms2mobile'     => false, //'13910136035', //false

    'mobile_aliases'    => [ //测试帐号 代理 xx号码
        '13910136035' => '15347067230', //'doctor 13911689892', user 15347067230
        '13581901791' => '1509799869',

/*        '13910510371' => '15103236666',
       // '13611262703' => '13701223188', //安

          '15001087980' => '18612800215', //王志农

      '15201677766' => '15811206831', //黄爱宇 15201677766 赵建波
        '18504600670' => '13911689892', //刘玥   杨艳玲
        '18810892696' => '18600521897', //张岩  18810892696 袁云
        '18172837071' => '13548966986', //占玮珉 18172837071 彭镜
        '15624962562' => '18811182130', //沈鑫曌 15624962562 笪宇威
        '18511971751' => '13699149612', //李骅璋 18511971751 矫黎冬
        '13366645747' => '13910838816', //操振华 13366645747 张在强
        '13426052642' => '13911100127', //孙继国 13426052642 卢岩
        '17766549990' => '15869056872', //xx =>徐明霞
        '18210855120' => '15811206831',   //=>赵建波
*/
//
'15933955311'=>'18612800215',//李争运->顾卫红
'13811537219'=>'18612800215',//郝营->顾卫红
'15011263508'=>'18612800215',//丁铭->顾卫红

'18896740771' =>'13611262703', //安
'13834586183' =>'15502114385',

'13910807028' =>'15502114385', //王总
'15001087980' =>'15502114385', //王志农
'18810546254' =>'15502114385', //沈星星
'18500141112' =>'15502114385', //于雪楠
'18610923015' =>'15502114385', //翟福鹏
'13767213322' =>'15502114385', //占凌涛
'15502114385' =>'15502114385', //操振华
'15030365920' =>'15502114385', //黄宝祯
'13691303608' =>'15502114385', //姚燕生
'18610923089' =>'15502114385', //宋雨晨
'18610923061' =>'15502114385', //王莉
'18810892696' =>'15502114385', //张岩
'17310925095' =>'15502114385', //詹文魁
'13394499811' =>'15502114385', //冯奇
'13983358862' =>'15502114385', //刘涛
'13756121605' =>'15502114385', //王泺璎
'18640439694' =>'15502114385', //陆爽
'18641198883' =>'15502114385', //彭勋
'15001302373' =>'15502114385', //陈伟民
'15044061211' =>'15502114385', //高欣
'15808858682' =>'15502114385', //张艳萍
'18600955924' =>'15502114385', //靳文昶
'18607131854' =>'15502114385', //刘力
'15866752367' =>'15502114385', //王启艳
'18511971761' =>'15502114385', //张路
'13355651853' =>'15502114385', //高晓楠
'18273110798' =>'15502114385', //占华宇
'13879998732' =>'15502114385', //刘道锋
'18762558746' =>'15502114385', //张欣
'18360729296' =>'15502114385', //黄海霞
'15824496363' =>'15502114385', //任彦奇
'18172837071' =>'15502114385', //占玮珉
'15019451260' =>'15502114385', //刘江涛
// '18600297428' =>'15502114385', //易凤娟
//'18210855120' =>'15502114385', //史秀明
'18910052532' =>'15502114385', //张浩
'18745795228' =>'15502114385', //范长新
'18210855120' =>'15800390000', //史秀明
'15208216544' =>'18980601687', //李楠楠
'18602818357' =>'18980601687', //王玲

    ],
];
