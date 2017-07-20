<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="http://lorempixel.com/200/200/cats/" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p> <?=Yii::$app->user->identity->username?>  </p>

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
                    ['label' => 'Меню пользователя', 'options' => ['class' => 'header']],

                    ['label' => 'Все квартиры', 'icon' => 'file-code-o', 'url' => ['/rooms']],
                    ['label' => 'Новые за сегодня', 'icon' => 'file-code-o', 'url' => ['/roomstoday']],
                    ['label' => 'Мои сохраненные', 'icon' => 'file-code-o', 'url' => ['/ownsave']],
                    ['label' => 'Наши сохраненные', 'icon' => 'file-code-o', 'url' => ['/ownsave/oursave']],
                    ['label' => 'Мои добавленные', 'icon' => 'file-code-o', 'url' => ['/ownsave/ownadd']],
                    ['label' => 'Наши добавленные', 'icon' => 'file-code-o', 'url' => ['/ownsave/ouradd']],
                    ['label' => 'Сбросить кеш', 'icon' => 'file-code-o', 'url' => ['flush'],'option'=>['class' => 'btn btn-success ']],
//                    ['label' => 'Первоисточник(в разработке)', 'icon' => 'file-code-o', 'url' => ['#']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],

                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],







                    [
                        'label' => 'Администрирование',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Управление пользователями', 'icon' => 'file-code-o', 'url' => ['/user/admin'],],
                            ['label' => 'RBAC', 'icon' => 'file-code-o', 'url' => ['/user/rbac'],],
                            ['label' => 'PasswordReset', 'url' => ['/requestPasswordReset'], 'visible' => !Yii::$app->user->isGuest],

                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
