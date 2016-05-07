<?php
if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;
/**
 * Class to create a custom post type control
 */
class Teo_Featured_Song_Custom_Control extends WP_Customize_Control
{
    public $type = 'select';
    /**
    * Render the content on the theme customizer page
    */
    public function render_content()
    {
        $genres = get_terms('genre');
        $genres_ids = array();
        if ( ! empty( $genres ) && ! is_wp_error( $genres ) ) {
            foreach($genres as $genre) {
                $genres_ids[] = $genre->term_id;
            }
        }
        $ids = array();
        $products = get_posts('post_type=product&posts_per_page=-1');
        foreach($products as $song) {
            if(teo_is_song($song->ID) ) {
                $ids[$song->ID] = $song->post_title;
            }
        }
        ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <select <?php $this->link();?> name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>">
                <?php
                    foreach ( $ids as $k => $title )
                    {
                        printf('<option value="%s" %s>%s</option>', $k, selected($this->value(), $k, false), $title);
                    }
                ?>
                </select>
            </label>
            <script type="text/javascript">
            jQuery(window).ready( function() {
                jQuery('#<?php echo $this->id;?>').on('change', function() {
                    window.wp.customize.Messenger().trigger('change');
                });
            });
            </script>
        <?php
    }
}
?>