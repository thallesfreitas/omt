<?php
/**
 * Variable product add to cart
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product, $post;
?>
<a href="<?php the_permalink();?>" class="single_add_to_cart_button add-to-cart-button button alt <?php if($cart_item_id) echo 'added';?>" data-id="<?php echo esc_attr( $product->id ); ?>">
	 		<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px"
				height="20px" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve">
				<g class="base">
					<polygon fill="transparent" stroke="#231F20" stroke-width="2" stroke-miterlimit="10" points="35.818,37 14,37 15.091,16 35,16 	">
						<animate attributeType="XML" class="animate-first added-animate-first" attributeName="points" from="35.818,37 14,37 15.091,16 35,16 	" to="34.818,36 15,36 16.091,15 34,15" begin="indefinite" dur="0.1s" fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />
						<animate attributeType="XML" class="animate-second added-animate-second" attributeName="points" from="34.818,36 15,36 16.091,15 34,15" to="35.818,37 14,37 15.091,16 35,16 	" begin="indefinite" dur="0.1s" fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />
					</polygon>
					<rect x="17" y="13" fill="transparent" stroke="#231F20" stroke-width="2" stroke-miterlimit="10" width="16" height="3">
						<animate attributeType="XML" class="animate-first added-animate-first" attributeName="x" from="17" to="18" begin="indefinite" dur="0.1s" fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />
						<animate attributeType="XML" class="animate-second added-animate-second" attributeName="x" from="18" to="17" begin="indefinite" dur="0.1s" fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />

						<animate attributeType="XML" class="animate-first added-animate-first" attributeName="y" from="13" to="11" begin="indefinite" dur="0.1s" fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />
						<animate attributeType="XML" class="animate-second added-animate-second" attributeName="y" from="11" to="13" begin="indefinite" dur="0.1s" fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />

						<animate attributeType="XML" class="animate-first added-animate-first" attributeName="width" from="16" to="14" begin="indefinite" dur="0.1s" fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />
						<animate attributeType="XML" class="animate-second added-animate-second" attributeName="width" from="14" to="16" begin="indefinite" dur="0.1s" fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />

						<animate attributeType="XML" class="animate-first added-animate-first" attributeName="height" from="3" to="4" begin="indefinite" dur="0.1s" fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />
						<animate attributeType="XML" class="animate-second added-animate-second" attributeName="height" from="4" to="3" begin="indefinite" dur="0.1s" fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />
					</rect>
				</g>
				<g class="plus">
					<line class="first" fill="white" stroke="#231F20" stroke-width="2" stroke-miterlimit="10" x1="25" y1="22" x2="25" y2="30">
						<animate class="animate-second" attributeName="x1" from="25" to="20" begin="indefinite" dur="0.2s" fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />
						<animate class="animate-second" attributeName="y1" from="22" to="26" begin="indefinite" dur="0.2s" fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />
						<animate class="animate-second" attributeName="x2" from="25" to="23.828" begin="indefinite" dur="0.2s" fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />
						<animate class="animate-second" attributeName="y2" from="30" to="29.828" begin="indefinite" dur="0.2s" fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />

						<animate class="animate-third" attributeName="x1" from="20" to="22.5" begin="indefinite" dur="0.2s" fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />
						<animate class="animate-third" attributeName="y1" from="26" to="24" begin="indefinite" dur="0.2s" fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />
						<animate class="animate-third" attributeName="x2" from="23.828" to="28.5" begin="indefinite" dur="0.2s" fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />
						<animate class="animate-third" attributeName="y2" from="29.828" to="30" begin="indefinite" dur="0.2s" fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />

						<animate class="added-animate-first" attributeName="x1" from="22.5" to="25" begin="indefinite" dur="0.2s" fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />
						<animate class="added-animate-first" attributeName="y1" from="24" to="22" begin="indefinite" dur="0.2s" fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />
						<animate class="added-animate-first" attributeName="x2" from="28.5" to="25" begin="indefinite" dur="0.2s" fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />
						<animate class="added-animate-first" attributeName="y2" from="30" to="30" begin="indefinite" dur="0.2s" fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />
					</line>
					<line class="second" fill="white" stroke="#231F20" stroke-width="2" stroke-miterlimit="10" x1="21" y1="26" x2="29" y2="26">
						<animate class="animate-first" attributeName="x2" from="29" to="31" begin="indefinite" dur="0.1s" fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />

						<animate class="animate-second" attributeName="x1" from="21" to="23.465" begin="indefinite" dur="0.2s" fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />
						<animate class="animate-second" attributeName="y1" from="26" to="29.535" begin="indefinite" dur="0.2s" fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />
						<animate class="animate-second" attributeName="x2" from="31" to="31" begin="indefinite" dur="0.2s" fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />
						<animate class="animate-second" attributeName="y2" from="26" to="23" begin="indefinite" dur="0.2s" fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />

						<animate class="animate-third" attributeName="x1" from="23.465" to="22.5" begin="indefinite" dur="0.2s" fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />
						<animate class="animate-third" attributeName="y1" from="29.535" to="30" begin="indefinite" dur="0.2s" fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />
						<animate class="animate-third" attributeName="x2" from="31" to="28.5" begin="indefinite" dur="0.2s" fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />
						<animate class="animate-third" attributeName="y2" from="23" to="24" begin="indefinite" dur="0.2s" fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />

						<animate class="added-animate-first" attributeName="x1" from="22.5" to="21" begin="indefinite" dur="0.2s" fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />
						<animate class="added-animate-first" attributeName="y1" from="30" to="26" begin="indefinite" dur="0.2s" fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />
						<animate class="added-animate-first" attributeName="x2" from="28.5" to="29" begin="indefinite" dur="0.2s" fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />
						<animate class="added-animate-first" attributeName="y2" from="24" to="26" begin="indefinite" dur="0.2s" fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />
					</line>
				</g>
			</svg>
		</a>