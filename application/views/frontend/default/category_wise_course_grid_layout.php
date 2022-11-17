<div class="row">
    <?php foreach ($courses as $course){
        $instructor_details = $this->user_model->get_all_user($course['user_id'])->row_array();
        $course_duration = $this->crud_model->get_total_duration_of_lesson_by_course_id($course['id']);
        // $lessons = $this->crud_model->get_lessons('course', $course['id']);
    ?>
        <div class="col-6 col-md-4 col-xl-3">
            <div class="course-box-wrap">
                <a onclick="$(location).attr('href', '<?php echo site_url('home/course/' . rawurlencode(slugify($course['title'])) . '/' . $course['id']); ?>');" href="javascript:;" class="has-popover">
                    <div class="course-box">
                        <div class="course-image">
                            <img src="<?php echo $this->crud_model->get_course_thumbnail_url($course['id']); ?>" alt="" class="img-fluid">
                        </div>
                        <div class="course-details">
                            <h5 class="title"><?php echo $course['title']; ?></h5>

                            <div class="rating">
                                <?php
                                $total_rating =  $this->crud_model->get_ratings('course', $course['id'], true)->row()->rating;
                                $number_of_ratings = $this->crud_model->get_ratings('course', $course['id'])->num_rows();
                                if ($number_of_ratings > 0) {
                                    $average_ceil_rating = ceil($total_rating / $number_of_ratings);
                                } else {
                                    $average_ceil_rating = 0;
                                }

                                for ($i = 1; $i < 6; $i++) : ?>
                                    <?php if ($i <= $average_ceil_rating) : ?>
                                        <i class="fas fa-star filled"></i>
                                    <?php else : ?>
                                        <i class="fas fa-star"></i>
                                    <?php endif; ?>
                                <?php endfor; ?>
                                <div class="d-inline-block">
                                    <span class="text-dark ms-1 text-15px">(<?php echo $average_ceil_rating; ?>)</span>
                                    <span class="text-dark text-12px text-muted ms-2">(<?php echo $number_of_ratings.' '.site_phrase('reviews'); ?>)</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </a>
                <div class="webui-popover-content">
                    <div class="course-popover-content">
                        <?php if ($course['last_modified'] == "") : ?>
                            <div class="last-updated fw-500"><?php echo site_phrase('last_updated') . ' ' . date('D, d-M-Y', $course['date_added']); ?></div>
                        <?php else : ?>
                            <div class="last-updated"><?php echo site_phrase('last_updated') . ' ' . date('D, d-M-Y', $course['last_modified']); ?></div>
                        <?php endif; ?>

                        <div class="course-title">
                            <a class="text-decoration-none text-15px" href="<?php echo site_url('home/course/' . rawurlencode(slugify($course['title'])) . '/' . $course['id']); ?>"><?php echo $course['title']; ?></a>
                        </div>
                        <div class="course-meta">
                            <?php if ($course['course_type'] == 'general') : ?>
                                <span class=""><i class="fa fa-book"></i>
                                    <?php echo $this->crud_model->get_lessons('course', $course['id'])->num_rows() . ' ' . site_phrase('lessons'); ?>
                                </span>
                                <span class=""><i class="far fa-clock"></i>
                                    <?php echo $course_duration; ?>
                                </span>
                            <?php elseif ($course['course_type'] == 'scorm') : ?>
                                <span class="badge bg-light"><?= site_phrase('scorm_course'); ?></span>
                            <?php endif; ?>
                            <span class=""><i class="fas fa-closed-captioning"></i><?php echo ucfirst($course['language']); ?></span>
                        </div>
                        <div class="course-subtitle"><?php echo $course['short_description']; ?></div>
                        <div class="what-will-learn">
                            <ul>
                                <?php
                                $outcomes = json_decode($course['outcomes']);
                                foreach ($outcomes as $outcome){ ?>
                                    <li><?php echo $outcome; ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="popover-btns">
                            <?php if (is_purchased($course['id'])) : ?>
                                <div class="purchased">
                                    <a href="<?php echo site_url('home/my_courses'); ?>"><?php echo site_phrase('already_purchased'); ?></a>
                                </div>
                            <?php else : ?>
                                <?php if ($course['is_free_course'] == 1) :
                                    // if ($this->session->userdata('user_login') != 1) {
                                    //     $url = "#";
                                    // } else {
                                    //     $url = site_url('home/get_enrolled_to_free_course/' . $course['id']);
                                    // }
                                ?>
                                    <!-- <a href="<?php //echo $url; ?>" class="btn green radius-10" onclick="handleEnrolledButton()"><?php //echo site_phrase('get_enrolled'); ?></a> -->
                                <?php else : ?>
                                    <button type="button" class="btn red d-none add-to-cart-btn <?php if (in_array($course['id'], $cart_items)) echo 'addedToCart'; ?> big-cart-button-<?php echo $course['id']; ?>" id="<?php echo $course['id']; ?>" onclick="handleCartItems(this)">
                                        <?php
                                        if (in_array($course['id'], $cart_items))
                                            echo site_phrase('added_to_cart');
                                        else
                                            echo site_phrase('add_to_cart');
                                        ?>
                                    </button>
                                    <button class="btn red add-to-cart-btn" type="button" id="course_<?php echo $course['id']; ?>" onclick="handleBuyNow(this)"><?php echo site_phrase('buy_now'); ?></button>
                                <?php endif; ?>
                                <button type="button" class="wishlist-btn <?php if ($this->crud_model->is_added_to_wishlist($course['id'])) echo 'active'; ?>" title="Add to wishlist" onclick="handleWishList(this)" id="<?php echo $course['id']; ?>"><i class="fas fa-heart"></i></button>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>