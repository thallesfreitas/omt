<?php
/** A simple text block **/
class AQ_Instagram_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Instagram block',
			'size' => 'span6',
		);
		
		//create the block
		parent::__construct('aq_instagram_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'userID' 			=> '',
			'accessToken'			=> '',
		);

		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		?>

		<p>Generate your Instagram userID and access token on: <a target="_blank" href="http://www.pinceladasdaweb.com.br/instagram/access-token/">Instagram access token generator</a> website</p>

		<div class="description">
			<label for="<?php echo $this->get_field_id('userID') ?>">
				User ID
				<?php echo aq_field_input('userID', $block_id, $userID, $size = 'full') ?>
			</label>
		</div>

		<div class="description">
			<label for="<?php echo $this->get_field_id('accessToken') ?>">
				Access Token
				<?php echo aq_field_input('accessToken', $block_id, $accessToken, $size = 'full') ?>
			</label>
		</div>
		
		<?php
	}
	
	function block($instance) {
		extract($instance);

		echo '
		<div class="instagram-container">
			<div class="col-sm-3">
				<img alt="" src="' . get_template_directory_uri() . '/img/instagram-text.png">
			</div>
			<div class="col-sm-9">
				<div class="instagram-list">
                  	<div class="row">';
        $data = get_transient('ig_data' . $userID);
	    if(!$data) {

	        $url = 'https://api.instagram.com/v1/users/' . $userID . '/media/recent/?access_token=' . $accessToken . '&count=4';
	        $ch = curl_init();
	        curl_setopt($ch, CURLOPT_URL, $url);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
	        $result = curl_exec($ch);
	        curl_close($ch); 

	        set_transient( 'ig_data' . $userID , $result , 60 * 60);

	        $data = $result;

	    }

	    $data = json_decode($data)->data;

	    if(!empty($data)) {
	        foreach ($data as $post){
	        	$caption = isset($post->caption->text) ? $post->caption->text : '';
	        	echo '
	        	<div class="col-sm-3">
	        		<a rel="nofollow" target="_blank" href="' . esc_url($post->link) . '">
                        <figure>
                        	<img alt="' . esc_attr($caption) . '" src="' . esc_url($post->images->standard_resolution->url) . '">
                        </figure>
                    </a>
                </div>';
	        }
	    }

	    echo '		</div>
	    		</div>
	    	</div>
	    </div>';
	}

	function update($new_instance, $old_instance) {
		return $new_instance;
	}
	
}