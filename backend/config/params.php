<?php
return [
    'adminEmail'        => 'admin@example.com',
    'videoserver'       => 'http://42.96.138.136:2020',
    'erp_url'           => 'http://shanghaijinzhun.com/',
    'wechat_sick'       => require 'wechat.sick.php',
    'wechat_doctor'     => require 'wechat.doctor.php',
    'master_vcf_mobile' => '13910136035',
    'master_vcf_voice'  => 'Untitled1.wav',

    'allsms2mobile'     => '13910136035', //false

    'mobile_aliases'    => [  //测试帐号 代理 xx号码
        '13910136035' => '13911689892',
        ''            => '',
    ],
];
