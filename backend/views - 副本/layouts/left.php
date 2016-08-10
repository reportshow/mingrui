<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?=$directoryAsset?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username; ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

 <?php

     
$menu   = [
        ['label' => '管理后台', 'options' => ['class' => 'header']],
        ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
        [
            'label' => '客户管理',
            'icon'  => 'fa fa-edit',
            'url'   => '#',
            'items' => [
                [
                    'label' => '医生',
                    'icon'  => 'fa fa-puzzle-piece',
                    'url'   => '#',
                    'items' => [
                        ['label' => '产品情况', 'icon' => 'fa fa-pie-chart', 'url' => ['/datas/products']],
                        ['label' => '业务布局', 'icon' => 'fa fa-pie-chart', 'url' => ['/datas/product-layout']],

                    ],
                ],
                

                [
                    'label' => '患者',
                    'icon'  => 'fa fa-puzzle-piece',
                    'url'   => '#',
                    'items' => [

                    ],
                ],
            ],
        ],
        [
            'label' => '报告管理',
            'icon'  => 'fa fa-edit',
            'url'   => '#',
            'items' => [
                [
                    'label' => '产业情况',
                    'icon'  => 'fa fa-puzzle-piece',
                    'url'   => '#',
                    'items' => [
                        ['label' => '产品情况', 'icon' => 'fa fa-pie-chart', 'url' => ['/datas/products']],
                        ['label' => '业务布局', 'icon' => 'fa fa-pie-chart', 'url' => ['/datas/product-layout']],

                    ],
                ],
                

                [
                    'label' => '财务数据',
                    'icon'  => 'fa fa-puzzle-piece',
                    'url'   => '#',
                    'items' => [

                    ],
                ],
            ],
        ],

        ['label' => '资料共享',
            'icon'   => 'fa fa-edit',
            'url'    => '#',
            'items'  => [],
        ],

        ['label' => '互动平台',
            'icon'   => 'fa fa-edit',
            'url'    => '#',
            'items'  => [
                [
                    'label' => '公司列表',
                    'icon'  => 'fa fa-pie-chart',
                    'url'   => ['/normaldata/company'],
                ],
                [
                    'label' => '并购基金',
                    'icon'  => 'fa fa-pie-chart',
                    'url'   => ['/datas/foundation'],
                ],
                [
                    'label' => '行业分类',
                    'icon'  => 'fa fa-pie-chart',
                    'url'   => ['/normaldata/industry'],
                ],
                [
                    'label' => '管理人员',
                    'icon'  => 'fa fa-pie-chart',
                    'url'   => ['/normaldata/contacts'],
                ], [
                    'label' => '特别股东',
                    'icon'  => 'fa fa-pie-chart',
                    'url'   => ['/normaldata/normalmaster'],
                ],
                [
                    'label' => '城市',
                    'icon'  => 'fa fa-pie-chart',
                    'url'   => ['/normaldata/city'],
                ],
                [
                    'label' => '院校',
                    'icon'  => 'fa fa-pie-chart',
                    'url'   => ['/normaldata/college'],
                ],

            ],
        ],

        

    ];

if(yii::$app->user->can('admin')){


 
 $menu[] = ['label' => '管理员', 'options' => ['class' => 'header']];

 $menu[] =    [
            'label' => '权限管理',
            'icon'  => 'fa fa-gears',
            'url'   => '#',
            'items' => [
                [
                    'label' => '角色',
                    'icon'  => 'fa fa-user',
                    'url'   => ['/admin/role'],
                ],
                [
                    'label' => '权限',
                    'icon'  => 'fa fa-balance-scale',
                    'url'   => ['/admin/permission'],
                ],
                [
                    'label' => '分配',
                    'icon'  => 'fa fa-circle-o',
                    'url'   => ['/admin/assignment'],
                ],
                [
                    'label' => '路由',
                    'icon'  => 'fa fa-car',
                    'url'   => ['/admin/route'],
                ],
                [
                    'label' => '菜单',
                    'icon'  => 'fa fa-list',
                    'url'   => ['/admin/menu'],
                ],
                 [
                    'label' => '用户',
                    'icon'  => 'fa fa-gears',
                    'url'   => ['/admin/user'],
                ],
            ] 
       ]         ;

        
        $menu[] = [
            'label' => '功能',
            'icon'  => 'fa fa-gears',
            'url'   => '#',
            'items' => [
                [
                    'label' => '开发',
                    'icon'  => 'fa fa-code',
                    'url'   => ['/'],
                ],
                [
                    'label' => '调试',
                    'icon'  => 'fa fa-bug',
                    'url'   => ['/'],
                ],
                [
                    'label' => ' ',
                    'icon'  => 'fa fa-circle-o',
                    'url'   => ['/'],
                ],
                [
                    'label' => ' ',
                    'icon'  => 'fa fa-circle-o',
                    'url'   => ['/'],
                ],
            ],
        ];

};

echo dmstr\widgets\Menu::widget([
    'options' => ['class' => 'sidebar-menu'],
    'items' => $menu,
    ]);

?>

    </section>

</aside>
