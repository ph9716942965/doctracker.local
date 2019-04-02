<aside class="main-sidebar">

    <section class="sidebar">
        <div class="user-panel ">
            <p style="color:#fff" class="text-success">
                <i class="fa fa-circle text-success"></i>
                <?php
                $session = Yii::$app->session;
                if (!$session->isActive) {
                    $session->open();
                }
                echo strtoupper($session['login_info']->username);
                ?>
            </p> 
        </div>

        <?=
        dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                    'items' => [
                        [
                            'label' => 'Masters',
                            'icon' => 'gears',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Country', 'icon' => 'circle-o', 'url' => ['/country/index'],],
                                ['label' => 'State', 'icon' => 'circle-o', 'url' => ['/state/index'],],
                                ['label' => 'District', 'icon' => 'circle-o', 'url' => ['/district/index'],],
                                ['label' => 'Asset Category', 'icon' => 'circle-o', 'url' => ['/asset-category/index'],],
                                ['label' => 'Cost Centre', 'icon' => 'circle-o', 'url' => ['/cost-centre/index'],],
                                ['label' => 'Cost Centre Sub', 'icon' => 'circle-o', 'url' => ['/cost-centre-sub/index'],],
                                ['label' => 'Funding Agency', 'icon' => 'circle-o', 'url' => ['/funding-agency/index'],],
                                ['label' => 'Program', 'icon' => 'circle-o', 'url' => ['/program/index'],],
                                ['label' => 'Project', 'icon' => 'circle-o', 'url' => ['/project/index'],],
                                ['label' => 'Project Budget Line', 'icon' => 'circle-o', 'url' => ['/project-budget-line/index'],],
                                ['label' => 'Location Description', 'icon' => 'circle-o', 'url' => ['/locationdescription/index'],],
                            ],
                        ],
                        [
                            'label' => 'RO',
                            'icon' => 'book',
                            'url' => '#',
                            'items' => [
                                ['label' => 'RO', 'icon' => 'circle-o', 'url' => ['/ro/index'],],
                                ['label' => 'Employee', 'icon' => 'circle-o', 'url' => ['/employee/index'],],
                                ['label' => 'Asset Purchase', 'icon' => 'circle-o', 'url' => ['/asset-purchase/index'],],
                                ['label' => 'Vendor', 'icon' => 'circle-o', 'url' => ['/vendor/index'],],
                            ],
                        ],
                        [
                            'label' => 'User',
                            'icon' => 'users',
                            'url' => '#',
                            'items' => [
                                ['label' => 'User Level', 'icon' => 'circle-o', 'url' => ['/user-levels/index'],],
                                ['label' => 'User', 'icon' => 'circle-o', 'url' => ['/user/index'],],
                            ],
                        ],
                        [
                            'label' => 'Claim Request',
                            'icon' => 'file-text',
                            'url' => '#',
                            'items' => [
                                ['label' => 'All List', 'icon' => 'circle-o', 'url' => ['/claim-request'],],
                               /* ['label' => 'Local Convence', 'icon' => 'circle-o', 'url' => ['/claim-request/create'],],
                                ['label' => 'Travel Convence', 'icon' => 'circle-o', 'url' => ['/claim-request/createtravel'],],
                                ['label' => 'Other Convence', 'icon' => 'circle-o', 'url' => ['/claim-request/createother'],],
                            */],
                        ],
                        [
                            'label' => 'Vendor Payment',
                            'icon' => 'file-text',
                            'url' => '#',
                            'items' => [
                                ['label' => 'All List', 'icon' => 'circle-o', 'url' => ['/vendorpayment'],],
                               /* ['label' => 'Local Convence', 'icon' => 'circle-o', 'url' => ['/claim-request/create'],],
                                ['label' => 'Travel Convence', 'icon' => 'circle-o', 'url' => ['/claim-request/createtravel'],],
                                ['label' => 'Other Convence', 'icon' => 'circle-o', 'url' => ['/claim-request/createother'],],
                            */],
                        ],
                    ],
                ]
        )
        ?>

    </section>

</aside>
