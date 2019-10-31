<div class="wrap-sidebar-content">
    <div id="skin-select">
        <a id="toggle">
            <span class="fa icon-menu"></span>
        </a>

        <div class="skin-part">
            <div id="tree-wrap">
                <div id="menuwrapper" class="side-bar">
                    <ul id="menu-showhide" class="topnav">
                        <?php
                        $role_id = $this->session->userdata('role_id');
                        $queryMenu = "SELECT `cms_user_menu`.`id`, `menu`
                                      FROM `cms_user_menu` JOIN `cms_user_access_menu`
                                      ON `cms_user_menu`.`id` = `cms_user_access_menu`.`menu_id`
                                      WHERE `cms_user_access_menu`.`role_id` = $role_id
                                      ORDER BY `cms_user_access_menu`.`menu_id` ASC";

                        $menu = $this->db->query($queryMenu)->result_array();
                        ?>

                        <?php foreach ($menu as $m) : ?>
                            <li class="devider-title">
                                <h3>
                                    <span><?= $m['menu']; ?></span>
                                </h3>
                            </li>

                            <?php
                                $menuId =  $m['id'];
                                $querySubMenu = "SELECT * FROM `cms_user_sub_menu`
                                             JOIN `cms_user_menu` 
                                             ON `cms_user_sub_menu`.`menu_id` = `cms_user_menu`.`id`
                                             WHERE `cms_user_sub_menu`.`menu_id` = $menuId
                                             AND `cms_user_sub_menu`.`is_active` = '1' ";

                                $subMenu = $this->db->query($querySubMenu)->result_array();
                                ?>
                            <?php foreach ($subMenu as $sm) : ?>
                                <li>
                                    <a class="tooltip-tip" href="<?= base_url($sm['url']); ?>" title="Dashboard">
                                        <i class="<?= $sm['icon']; ?>"></i>
                                        <span><?= $sm['title']; ?></span>

                                    </a>
                                </li>
                            <? endforeach; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- #/skin-select -->
    <!-- END OF SIDE MENU -->