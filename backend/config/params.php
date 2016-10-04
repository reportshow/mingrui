<?php
return [
    'adminEmail'        => 'admin@example.com',
    'videoserver'       => 'http://42.96.138.136:2020',
    'erp_url'           => 'http://shanghaijinzhun.com/',
    'wechat_sick'       => require 'wechat.sick.php',
    'wechat_doctor'     => require 'wechat.doctor.php',

    //管理员的手机
    'master_vcf_mobile' => '13910136035',
    'master_vcf_voice'  => 'Untitled1.wav',

    //测试时，把所有的短信都发到这里
    'allsms2mobile'     => false, //'13910136035', //false

    'mobile_aliases'    => [ //测试帐号 代理 xx号码
        '13910136035' => '13911689892', //'doctor 13911689892', user 15347067230
        '13581901791' => '18612701977',

        '13910510371' =>'15103236666',
        '13611262703' =>'13701223188',

        '15001087980'=> '18612800215'//王志农
    ],
];
