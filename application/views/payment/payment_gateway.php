<style>
body {
	padding-top: 50px;
	padding-bottom: 50px;
}

.payment-header-text {
	font-size: 23px;

}

.close-btn-light {
	padding-left: 10px;
	padding-right: 10px;
	height: 35px;
	line-height: 35px;
	text-align: center;
	font-size: 25px;
	background-color: #F1EAE9;
	color: #a45e72;
	border-radius: 5px;
}

.close-btn-light:hover {
	padding-left: 10px;
	padding-right: 10px;
	height: 35px;
	line-height: 35px;
	text-align: center;
	font-size: 25px;
	background-color: #a45e72;
	color: #FFFFFF;
	border-radius: 5px;
}

.payment-header {
	font-size: 14px;
}

.item {
	width: 100%;
	height: 50px;
	display: block;
}

.count-item {
	padding-left: 13px;
	padding-right: 13px;
	padding-top: 5px;
	padding-bottom: 5px;

	margin-bottom: 100%;
	margin-right: 18px;
	margin-top: 8px;

	color: #00B491;
	background-color: #DEF6F3;
	border-radius: 5px;
	float: left;
}

.item-title {
	font-weight: bold;
	font-size: 13.5px;
	display: block;
	margin-top: 6px;
}

.item-price {
	float: right;
	color: #00B491;
}

.by-owner {
	font-size: 11px;
	color: #76767E;
	display: block;
	margin-top: -3px;
}

.total {
	border-radius: 8px 0px 0px 8px;
	background-color: #DBF3F0;
	padding: 10px;
	padding-left: 30px;
	padding-right: 30px;
	font-size: 18px;
}

.total-price {
	border-radius: 0px 8px 8px 0px;
	background-color: #CCD4DD;
	padding: 10px;
	padding-left: 25px;
	padding-right: 25px;
	font-size: 18px;
}

.indicated-price {
	padding-bottom: 20px;
	margin-bottom: 0px;
}

.payment-button {
	background-color: #1DBDA0;
	border-radius: 8px;
	padding: 10px;
	padding-left: 30px;
	padding-right: 30px;
	color: #fff;
	border: none;
	font-size: 18px;
}

.payment-gateway {
	border: 2px solid #D3DCDD;
	border-radius: 5px;
	padding-top: 15px;
	padding-bottom: 15px;
	margin-bottom: 15px;
	cursor: pointer;
}

.payment-gateway:hover {
	border: 2px solid #00D04F;
	border-radius: 5px;
	padding-top: 15px;
	padding-bottom: 15px;
	margin-bottom: 15px;
	cursor: pointer;
}

.payment-gateway-icon {
	width: 80%;
	float: right;
}

.tick-icon {
	margin: 0px;
	padding: 0px;
	width: 15%;
	float: left;
	display: none;
}

.aman-form, .paymob-form, .paypal-form, .stripe-form, .razorpay-form {
	display: none;
}

@media only screen and (max-width: 600px) {

	.paymob, .aman, .paypal, .stripe, .paytm, .paystack, .payumoney, .razorpay {
		margin-left: 5px;
		width: 70%;
	}
}

#loading {
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  position: fixed;
  display: block;
  opacity: 0.7;
  background-color: rgb(26, 26, 27);
  z-index: 9999;
  text-align: center;
}
.lds-ring {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
  top: 48%;
}
.lds-ring div:nth-child(1) {
  animation-delay: -0.45s;
}
.lds-ring div {
  box-sizing: border-box;
  display: block;
  position: absolute;
  width: 64px;
  height: 64px;
  margin: 8px;
  border: 2px solid #fff;
    border-top-color: rgb(255, 255, 255);
    border-right-color: rgb(255, 255, 255);
    border-bottom-color: rgb(255, 255, 255);
    border-left-color: rgb(255, 255, 255);
  border-radius: 50%;
  animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
    animation-delay: 0s;
  border-color: #fff transparent transparent transparent;
}
@keyframes lds-ring {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
</style>

<?php
$paypal   = json_decode(get_settings('paypal'));
$paymob   = json_decode(get_settings('paymob'));
$aman     = json_decode(get_settings('aman'));
$stripe   = json_decode(get_settings('stripe_keys'));
$razorpay = json_decode(get_settings('razorpay_keys'));
$total_price_of_checking_out = $this->session->userdata('total_price_of_checking_out');
?>
<div id="loading" style="display:none">
    <div class="lds-ring">
        <div></div>
    </div>
</div>
<div class="container" style="margin-top: 45px;">
	<div class="row justify-content-center mb-5">
		<div class="col-md-8">
			<div class="row">
				<div class="col-md-12">
					<span class="payment-header-text" style="margin: 0px auto; display: block; width: fit-content;"><b><?php echo get_phrase('make_payment'); ?></b></span>
					<a href="<?php echo site_url('home/shopping_cart'); ?>" style="display:none" class="close-btn-light float-end"><i class="fa fa-times"></i></a>
				</div>
			</div>
		</div>
	</div>

	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="row">
				<div class="col-md-3">
					<p class="pb-2 payment-header"><?php echo get_phrase('select_payment_gateway'); ?></p>

					<?php if ($paymob[0]->active != 0) : ?>
						<div class="row payment-gateway paymob" onclick="selectedPaymentGateway('paymob')">
							<div class="col-12">
								<img class="tick-icon paymob-icon" src="<?php echo base_url('assets/payment/tick.png'); ?>">
								<img class="payment-gateway-icon" src="<?php echo base_url('assets/payment/paymob.png'); ?>">
							</div>
						</div>
					<?php endif;

					if ($aman[0]->active != 0) : ?>
						<div class="row payment-gateway aman" onclick="selectedPaymentGateway('aman')">
							<div class="col-12">
								<img class="tick-icon aman-icon" src="<?php echo base_url('assets/payment/tick.png'); ?>">
								<img class="payment-gateway-icon" src="<?php echo base_url('assets/payment/aman.png'); ?>">
							</div>
						</div>
					<?php endif; ?>

				<!--paystack payment gateway addon-->
				<?php
				if (addon_status('paystack') == 1) :
					include "paystack_payment_gateway.php";
				endif;
				?>

				<!--payumoney payment gateway addon-->
				<?php
				if (addon_status('payumoney') == 1) :
					include "payumoney_payment_gateway.php";
				endif;
				?>
				<!--instamojo payment gateway addon-->
				<?php
				if (addon_status('instamojo') == 1) :
					include "instamojo/instamojo_payment_gateway.php";
				endif;
				?>
				<!--pagseguro payment gateway addon-->
				<?php
				if (addon_status('pagseguro') == 1) :
					include "pagseguro/pagseguro_payment_gateway.php";
				endif;
				?>
				<!--mercadopago payment gateway addon-->
				<?php
				if (addon_status('mercadopago') == 1) :
					include "mercadopago/mercadopago_payment_gateway.php";
				endif;
				?>
				<!--ccavenue payment gateway addon-->
				<?php
				if (addon_status('ccavenue') == 1) :
					include "ccavenue/ccavenue_payment_gateway.php";
				endif;
				?>
				<!--flutterwave payment gateway addon-->
				<?php
				if (addon_status('flutterwave') == 1) :
					include "flutterwave/flutterwave_payment_gateway.php";
				endif;
				?>
				<!--paytm payment gateway addon-->
				<?php
				if (addon_status('paytm') == 1) :
					include "paytm_payment_gateway.php";
				endif;
				?>

				<!--offline payment gateway addon-->
				<?php
				if (addon_status('offline_payment') == 1) :
					include "offline_payment_gateway.php";
				endif;
				?>
			</div>

			<div class="col-md-1"></div>

			<div class="col-md-8">
				<div class="w-100 d-grid">
					<p class="pb-2 payment-header"><?php echo get_phrase('order'); ?> <?php echo get_phrase('summary'); ?></p>
					<?php $counter = 0 ?>
					<?php foreach ($this->session->userdata('cart_items') as $cart_item) :
						$counter++;
						$course_details = $this->crud_model->get_course_by_id($cart_item)->row_array();
						$instructor_details = $this->user_model->get_all_user($course_details['user_id'])->row_array(); ?>

						<p class="item float-start">
							
							<span class="count-item" style="float: none;"><?php echo $counter; ?></span>
							<span style="float: left;margin-top: -17px;">
    							<span class="item-title" style="clear: both;">
        						    <span class="item-price"><?php echo $course_details['title'] . " "; ?></span>
        							<span style="margin-right: 6px;">
        							    
        								<?php if ($course_details['discount_flag'] == 1) :
        									echo currency($course_details['discounted_price']);
        									else :
        										echo " " . currency($course_details['price']) . " " ;
        									endif; 
        								?>
    								</span>
    								
    							</span>
    							<span class="by-owner" style="clear: both;">
    								<?php echo get_phrase('by'); ?>
    								<?php echo $instructor_details['first_name'] . ' ' . $instructor_details['last_name']; ?>
    							</span>
							</span>
						</p>
						<?php endforeach; ?>
					</div>
					<div class="w-100 float-start mt-4 indicated-price">
						<div class="float-end total-price"><?php echo get_phrase('total'); ?></div>
						<div class="float-end total"><?php echo currency($total_price_of_checking_out); ?></div>
					</div>
					<div class="w-100 float-start">
						<form action="<?php echo site_url('home/paypal_checkout'); ?>" method="post" class="paypal-form form">
							<hr class="border mb-4">
							<input type="hidden" name="total_price_of_checking_out" value="<?php echo $total_price_of_checking_out; ?>">
							<button type="submit" class="payment-button float-end"><?php echo get_phrase('pay_by_paypal'); ?></button>
						</form>
						
						<form action="<?php echo site_url('home/paymob_checkout'); ?>" method="post" class="paymob-form form">
							<hr class="border mb-4">
							<input type="hidden" name="total_price_of_checking_out" value="<?php echo $total_price_of_checking_out; ?>">
							<button type="submit" class="payment-button float-end"><?php echo get_phrase('pay_by_paymob'); ?></button>
						</form>
						
						<form action="<?php echo site_url('home/aman_checkout'); ?>" method="post" class="aman-form form">
							<hr class="border mb-4">
							<input type="hidden" name="total_price_of_checking_out" value="<?php echo $total_price_of_checking_out; ?>">
							<button type="submit" class="payment-button float-end"><?php echo get_phrase('pay_by_aman'); ?></button>
						</form>

						<div class="stripe-form form">
							<hr class="border mb-4">
							<?php include "stripe/stripe_payment_gateway_form.php"; ?>
						</div>

						<form action="<?php echo site_url('home/razorpay_checkout'); ?>" method="post" class="razorpay-form form">
							<hr class="border mb-4">
							<input type="hidden" name="total_price_of_checking_out" value="<?php echo $total_price_of_checking_out; ?>">
							<button type="submit" class="payment-button float-end"><?php echo get_phrase('pay_by_razorpay'); ?></button>
						</form>

						<!--Paystack payment gateway addon-->
						<?php
						if (addon_status('paystack') == 1) :
							include "paystack_payment_gateway_form.php";
						endif;
						?>

						<!--payumoney payment gateway addon-->
						<?php
						if (addon_status('payumoney') == 1) :
							include "payumoney_payment_gateway_form.php";
						endif;
						?>
						<!--instamojo payment gateway addon-->
						<?php
						if (addon_status('instamojo') == 1) :
							include "instamojo_payment_gateway_form.php";
						endif;
						?>

						<!--pagseguro payment gateway addon-->
						<?php
						if (addon_status('pagseguro') == 1) :
							include "pagseguro_payment_gateway_form.php";
						endif;
						?>

						<!--mercadopago payment gateway addon-->
						<?php
						if (addon_status('mercadopago') == 1) :
							include "mercadopago_payment_gateway_form.php";
						endif;
						?>

						<!--ccavenue payment gateway addon-->
						<?php
						if (addon_status('ccavenue') == 1) :
							include "ccavenue/ccavenue_payment_gateway_form.php";
						endif;
						?>

						<!--flutterwave payment gateway addon-->
						<?php
						if (addon_status('flutterwave') == 1) :
							include "flutterwave_payment_gateway_form.php";
						endif;
						?>

						<!--paytm payment gateway addon-->
						<?php
						if (addon_status('paytm') == 1) :
							include "paytm_payment_gateway_form.php";
						endif;
						?>

						<!--offline payment gateway addon-->
						<?php
						if (addon_status('offline_payment') == 1) :
							include "offline_payment_gateway_form.php";
						endif;
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
function selectedPaymentGateway(gateway) {
	if (gateway == 'aman') {

		$(".payment-gateway").css("border", "2px solid #D3DCDD");
		$('.tick-icon').hide();
		$('.form').hide();

		$(".aman").css("border", "2px solid #00D04F");
		$('.aman-icon').show();
		$('.aman-form').show();
		
		$('.aman-form').submit(function(){
		    $("#loading").css("display", "block");
		});
		
	}else if (gateway == 'paymob') {

		$(".payment-gateway").css("border", "2px solid #D3DCDD");
		$('.tick-icon').hide();
		$('.form').hide();

		$(".paymob").css("border", "2px solid #00D04F");
		$('.paymob-icon').show();
		$('.paymob-form').show();
		
		$('.paymob-form').submit(function(){
		    $("#loading").css("display", "block");
		});
		
		
	}else if (gateway == 'paypal') {

		$(".payment-gateway").css("border", "2px solid #D3DCDD");
		$('.tick-icon').hide();
		$('.form').hide();

		$(".paypal").css("border", "2px solid #00D04F");
		$('.paypal-icon').show();
		$('.paypal-form').show();
	} else if (gateway == 'stripe') {

		$(".payment-gateway").css("border", "2px solid #D3DCDD");
		$('.tick-icon').hide();
		$('.form').hide();

		$(".stripe").css("border", "2px solid #00D04F");
		$('.stripe-icon').show();
		$('.stripe-form').show();
	} else if (gateway == 'razorpay') {

		$(".payment-gateway").css("border", "2px solid #D3DCDD");
		$('.tick-icon').hide();
		$('.form').hide();

		$(".razorpay").css("border", "2px solid #00D04F");
		$('.razorpay-icon').show();
		$('.razorpay-form').show();
	}
}
</script>