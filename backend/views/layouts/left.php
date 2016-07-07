<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

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

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'LKPRO ADMIN MENU', 'options' => ['class' => 'header']],
                    ['label' => 'Проверки', 'url' => ['/database_types']],
                    ['label' => 'Список всех проверок', 'url' => ['/buttons']],
                    ['label' => 'Заказы', 'url' => ['/order']],
                    ['label' => 'Поля заказов', 'url' => ['/field']],
                    ['label' => 'Новости в шапке', 'url' => ['/header/update?id=1']],
                    [
                        'label' => 'Страница ПОМОЩЬ',
                        'icon' => '',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Категории', 'icon' => '', 'url' => ['/help-category'],],
                            ['label' => 'Записи', 'icon' => '', 'url' => ['/help'],],
                        ]
                    ],
                    ['label' => 'Статистика', 'url' => ['/site/statistics']],
                    ['label' => 'Варианты оплаты', 'url' => ['/cash-type']],
                    ['label' => 'Операции с балансом', 'url' => ['/site/balance-operations']],
                    /*
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Same tools',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'fa fa-circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'fa fa-circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],*/
                ],
            ]
        ) ?>

    </section>

</aside>
