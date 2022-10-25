<?php
$total_price = 0;
$course_details = $this->crud_model->get_course_by_id($cart_item)->row_array();
$instructor_details = $this->user_model->get_all_user($course_details['user_id'])->row_array();
$this_mobile_view = 'false';
?>
<div class="row px-1 mb-5">
	<div class="col-12">
		<img src="<?php echo $this->crud_model->get_course_thumbnail_url($cart_item); ?>" alt="" class="img-fluid" style="width:fit-content;display:block;margin:28px auto;">
	</div>
	<div class="col-12">
		<div class="details">
			<a href="javascript:void(0)">
				<h4><?php echo $course_details['title']; ?></h4>
			</a>
			<div class="row mt-1">
				<div class="col-4 text-secondary">
					<?php echo get_phrase('by'); ?>
					<span class="instructor-name"><?php echo $instructor_details['first_name'] . ' ' . $instructor_details['last_name']; ?></span>
				</div>
				<div class="col-8 cart-course-wrapper p-0">
					<?php if ($course_details['is_free_course'] == 1) : ?>
						<?php $total_price = 0; ?>
						<?php $this->session->set_userdata('total_price_of_checking_out', $total_price); ?>
						<div class="current-price" style="margin-right: 65%; font-size: 30px; color: #ec5252;"> <b><i><?php echo get_phrase('free'); ?></i></b></div>
					<?php else : ?>
						<?php if ($course_details['discount_flag'] == 1) : ?>
							<?php $total_price = $course_details['discounted_price']; ?>
							<?php $this->session->set_userdata('total_price_of_checking_out', $total_price); ?>
							<div class="float-right text-right" style="margin-right: 65%;">
								<div class="price">
									<div class="current-price" style="font-size: 30px;"> <?php echo currency($course_details['discounted_price']); ?> </div>
								</div>
								<div class="price">
									<div class="original-price" style="font-size: 15px;"> <?php echo currency($course_details['price']); ?> </div>
								</div>
							</div>
						<?php elseif ($course_details['discount_flag'] != 1) : ?>
							<?php $total_price = $course_details['price']; ?>
							<?php $this->session->set_userdata('total_price_of_checking_out', $total_price); ?>
							<div class="current-price" style="margin-right: 65%; font-size: 30px;"> <?php echo currency($course_details['price']); ?> </div>
						<?php endif; ?>
					<?php endif; ?>
				</div>

				<div class="col-12 mt-3">
                        <?php if ($enroll_type == 'pending') : ?>
                            <div class="alert alert-warning" role="alert">
                                <i class="dripicons-checkmark mr-2"></i><?php echo get_phrase('your_payment_will_be_reviewed_admin'); ?>.
                            </div>
                        <?php elseif ($enroll_type == 'error') : ?>
                            <div class="alert alert-danger" role="alert">
                                <i class="dripicons-checkmark mr-2"></i><?php echo get_phrase('an_error_occurred'); ?>.
                            </div>
                        <?php elseif ($enroll_type == 'aman') : ?>
                            <div class="alert alert-success" role="alert">
                                <i class="dripicons-checkmark mr-2"></i> <?php echo get_phrase('من فضلك قم بالدفع علي هذا الرقم المرجعي من اي منفذ امان'); ?><strong><?php echo " " . $this->session->userdata('ref') ?></strong>.
                            </div>
                        <?php else : ?>
                            <a href="<?php echo site_url('home/payment_gateway_mobile/' . $cart_item . '/' . $user_id); ?>" class="btn btn-lg w-100 float-right" style="height: 60px;"><?php echo get_phrase('checkout'); ?><?php echo ' / ' . currency($total_price); ?></a>
                        <?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>