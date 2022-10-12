<?php
$user_details = $this->user_model->get_user($this->session->userdata('user_id'))->row_array();
?>
<section class="menu-area bg-white" dir="ltr">
    <div class="container-xl">
        <nav class="navbar navbar-expand-lg navbar-light">

            <ul class="mobile-header-buttons">
                <li><a class="mobile-nav-trigger" href="#mobile-primary-nav">Menu<span></span></a></li>
                <li><a class="mobile-search-trigger" href="#mobile-search">Search<span></span></a></li>
            </ul>

            <a href="<?php echo site_url(''); ?>" class="navbar-brand" href="#">
                <img src="<?php echo base_url('uploads/system/' . get_frontend_settings('dark_logo')); ?>" alt="" height="35">
            </a>
            
            <?php include 'menu.php'; ?>

            <form class="inline-form me-2" dir="ltr" action="<?php echo site_url('home/search'); ?>" method="get" style="width: 100%;">
                <div class="input-group search-box mobile-search">
                    <input type="text" name='query' class="form-control" placeholder="<?php echo site_phrase('search_for_courses'); ?>">
                    <div class="input-group-append">
                        <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>

            <?php $custom_page_menus = $this->crud_model->get_custom_pages('', 'header'); ?>
            <?php foreach($custom_page_menus->result_array() as $custom_page_menu): ?>
                <a class="navbar-brand btn-hover-gray text-14px ms-2 me-0 <?php if(isset($page_url) && $custom_page_menu['page_url'] == $page_url) echo 'active'; ?>" style="border: 1px solid transparent; margin: 0px; padding: 0px 8px; width: max-content; border-radius: 5px; height: 40px; line-height: 40px;" href="<?php echo site_url('page/'.$custom_page_menu['page_url']); ?>"><?php echo $custom_page_menu['button_title']; ?></a></li>
            <?php endforeach; ?>

            <?php if (get_settings('allow_instructor') == 1) : ?>
                <div class="instructor-box menu-icon-box ms-md-3">
                    <div class="icon">
                        <a href="<?php echo site_url('user'); ?>" style="border: 1px solid transparent; margin: 0px; padding: 0px 10px; font-size: 14px; width: max-content; border-radius: 5px; height: 40px; line-height: 40px;"><?php echo site_phrase('instructor'); ?></a>
                    </div>
                </div>
            <?php endif; ?>

            <div class="instructor-box menu-icon-box">
                <div class="icon">
                    <a href="<?php echo site_url('home/my_courses'); ?>" style="border: 1px solid transparent; margin: 0px; padding: 0px 10px; font-size: 14px; width: max-content; border-radius: 5px; height: 40px; line-height: 40px;"><?php echo site_phrase('my_courses'); ?></a>
                </div>
            </div>

            <div class="wishlist-box menu-icon-box" id="wishlist_items">
                <?php include 'wishlist_items.php'; ?>
            </div>

            <div class="cart-box menu-icon-box" id="cart_items">
                <?php include 'cart_items.php'; ?>
            </div>



            <div class="user-box menu-icon-box">
                <div class="icon">
                    <a href="javascript:;">
                        <img src="<?php echo $this->user_model->get_user_image_url($this->session->userdata('user_id')); ?>" alt="" class="img-fluid">
                    </a>
                </div>
                <div class="dropdown user-dropdown corner-triangle top-right radius-10">
                    <ul class="user-dropdown-menu radius-10">

                        <li class="dropdown-user-info">
                            <a href="javascript:;" class="radius-top-10">
                                <div class="clearfix">
                                    <div class="user-image float-start">
                                        <img src="<?php echo $this->user_model->get_user_image_url($this->session->userdata('user_id')); ?>" alt="">
                                    </div>
                                    <div class="user-details">
                                        <div class="user-name">
                                            <span class="hi"><?php echo site_phrase('hi'); ?>,</span>
                                            <?php echo $user_details['first_name'] . ' ' . $user_details['last_name']; ?>
                                        </div>
                                        <div class="user-email">
                                            <span class="email"><?php echo $user_details['email']; ?></span>
                                            <span class="welcome"><?php echo site_phrase("welcome_back"); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <li class="user-dropdown-menu-item"><a href="<?php echo site_url('home/my_courses'); ?>"><i class="far fa-gem"></i><?php echo site_phrase('my_courses'); ?></a></li>
                        <li class="user-dropdown-menu-item"><a href="<?php echo site_url('home/my_wishlist'); ?>"><i class="far fa-heart"></i><?php echo site_phrase('my_wishlist'); ?></a></li>
                        <li class="user-dropdown-menu-item"><a href="<?php echo site_url('home/my_messages'); ?>"><i class="far fa-envelope"></i><?php echo site_phrase('my_messages'); ?></a></li>
                        <li class="user-dropdown-menu-item"><a href="<?php echo site_url('home/purchase_history'); ?>"><i class="fas fa-shopping-cart"></i><?php echo site_phrase('purchase_history'); ?></a></li>
                        <li class="user-dropdown-menu-item"><a href="<?php echo site_url('home/profile/user_profile'); ?>"><i class="fas fa-user"></i><?php echo site_phrase('user_profile'); ?></a></li>
                        <?php if (addon_status('customer_support')) : ?>
                            <li class="user-dropdown-menu-item"><a href="<?php echo site_url('addons/customer_support/user_tickets'); ?>"><i class="fas fa-life-ring"></i><?php echo site_phrase('support'); ?></a></li>
                        <?php endif; ?>

                        <li class="dropdown-user-logout user-dropdown-menu-item radius-bottom-10"><a class="radius-bottom-10 py-3" href="<?php echo site_url('login/logout'); ?>"><i class="fas fa-sign-out-alt"></i> <?php echo site_phrase('log_out'); ?></a></li>
                    </ul>
                </div>
            </div>



            <span class="signin-box-move-desktop-helper"></span>
            <div class="sign-in-box btn-group d-none">

                <button type="button" class="btn btn-sign-in" data-toggle="modal" data-target="#signInModal">Log In</button>

                <!-- <button type="button" class="btn btn-sign-up" data-toggle="modal" data-target="#signUpModal">Sign Up</button> -->

            </div> <!--  sign-in-box end -->


        </nav>
    </div>
</section>