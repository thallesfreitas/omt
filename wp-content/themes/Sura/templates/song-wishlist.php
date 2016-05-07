<?php
global $post;
$class = '';
if(isset($_SESSION['teo_wishlist']) && in_array($post->ID, $_SESSION['teo_wishlist']) ) {
	$class = ' added';
}
?>
<button class="add-to-wishlist-button <?php echo $class;?>" data-id="<?php echo $post->ID;?>">
	<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="40px"
		height="40px" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve">
		<g id="top">
			<path fill="none" stroke="#000000" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M32.584,20.462
				c1.396-1.46,2.161-3.374,2.161-5.39c0-4.288-3.476-7.777-7.744-7.777c-2.44,0-4.681,1.143-6.126,3.018h-0.007
				c-1.444-1.875-3.683-3.018-6.124-3.018C10.476,7.295,7,10.784,7,15.072c0,2.016,0.765,3.93,2.161,5.39l5.058,4.882">
									
				<animate class="animate-first" attributeName="d" 
					from="M32.584,20.462
						c1.396-1.46,2.161-3.374,2.161-5.39c0-4.288-3.476-7.777-7.744-7.777c-2.44,0-4.681,1.143-6.126,3.018h-0.007
						c-1.444-1.875-3.683-3.018-6.124-3.018C10.476,7.295,7,10.784,7,15.072c0,2.016,0.765,3.93,2.161,5.39l5.058,4.882" 
					to="
						M30.883,20.732c1.396-1.459,2.161-3.375,2.161-5.39c0-4.288-3.476-7.777-7.744-7.777c-2.44,0-4.68,1.143-6.126,3.018h-0.007
						c-1.444-1.875-3.683-3.018-6.124-3.018c-4.268,0-7.744,3.489-7.744,7.777c0,2.016,0.766,3.93,2.161,5.39l5.058,4.883" 
					begin="indefinite" 
					dur="0.1s" 
					fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />
				<animate class="added-animate-first" attributeName="d" 
					from="
						M30.883,20.732c1.396-1.459,2.161-3.375,2.161-5.39c0-4.288-3.476-7.777-7.744-7.777c-2.44,0-4.68,1.143-6.126,3.018h-0.007
						c-1.444-1.875-3.683-3.018-6.124-3.018c-4.268,0-7.744,3.489-7.744,7.777c0,2.016,0.766,3.93,2.161,5.39l5.058,4.883" 
					to="M32.584,20.462
						c1.396-1.46,2.161-3.374,2.161-5.39c0-4.288-3.476-7.777-7.744-7.777c-2.44,0-4.681,1.143-6.126,3.018h-0.007
						c-1.444-1.875-3.683-3.018-6.124-3.018C10.476,7.295,7,10.784,7,15.072c0,2.016,0.765,3.93,2.161,5.39l5.058,4.882" 
					begin="indefinite" 
					dur="0.1s" 
					fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />
			</path>
		</g>
		<g id="base">
			<path fill="none" stroke="#000000" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M32.639,20.403
				L20.902,31.941l0,0l-6.774-6.69">			
				<animate class="animate-first" attributeName="d" 
					from="M32.639,
						20.403
						L20.902,
						31.941l0,
						0l-6.774-6.69" 
					to="M27.451,
						24.119l-8.25,
						8.094l0,
						0l-3.337-3.285" 
					begin="indefinite" 
					dur="0.1s" 
					fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />
				<animate class="animate-second smooth" attributeName="d" 
					from="M27.451,
						24.119l-8.25,
						8.094l0,
						0l-3.337-3.285" 
					to="M24.473,
						27.098l-5.271,
						5.115l0,
						0" 
					begin="indefinite" 
					dur="1s" 
					fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />	
									
				<animate class="added-animate-first" attributeName="d" 
					from="M24.473,27.098l-5.271,5.115l0,0" 
					to="M32.639,20.403
						L20.902,31.941l0,0l-6.774-6.69" 
					begin="indefinite" 
					dur="1s" 
					fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />
			</path>
			<path fill="none" stroke="#000000" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M32.639,20.403
				L20.902,31.941l0,0l-6.774-6.69">			
				<animate class="animate-first" attributeName="d" 
					from="
						M32.639,20.403
						L20.902,31.941l0,0l-6.774-6.69" 
					to="M27.451,24.119l-8.25,8.094l0,0l-3.337-3.285" 
					begin="indefinite" 
					dur="0.1s" 
					fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />
				<animate class="animate-second" attributeName="d" 
					from="M27.451,24.119l-8.25,8.094l0,0l-3.337-3.285" 
					to="M19.201,27.098l5.271,5.115l0,0" 
					begin="indefinite" 
					dur="1s" 
					fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />						
				<animate class="added-animate-first" attributeName="d" 
					from="M19.201,27.098l5.271,5.115l0,0" 
					to="M32.639,20.403
					L20.902,31.941l0,0l-6.774-6.69" 
					begin="indefinite" 
					dur="1s" 
					fill="freeze" calcMode="spline" keySplines="0.5 0 0.5 0" />	
			</path>
		</g> 
	</svg>
</button>