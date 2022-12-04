<?php 
Class Latest_Services_Cat_List_Widget extends WP_Widget{

	public function __construct(){
		parent::__construct('tp-services-cats-list', 'Kidba Services Category List', array(
			'description'	=> esc_html__('TP Toolkit Services List', 'tp-toolkit')
		));
	}


	public function widget($args, $instance){

		extract($args);
	 	echo $before_widget; 
	 	if($instance['title']):
     	echo $before_title; ?> 
     	<?php echo apply_filters( 'widget_title', $instance['title'] ); ?>
     	<?php echo $after_title; ?>
     	<?php endif; ?>
		 <div class="blog-sidebar-box-body p-30 px-30">
			<ul>
				<?php 
					$categories = get_terms( array(
						'taxonomy' => 'category',
						'hide_empty' => true,
					) );
				?>
				<?php if ( !empty($categories) ) : ?>
					<?php foreach ( $categories as $category ) : ?>
						<li><a href="<?php echo esc_url( get_category_link( $category->term_id)); ?>" class="blog-sidebar-link d-flex justify-content-between align-items-center mb-20"><span><span class="fz-14 lh-0"><i class="icofont-simple-right"></i></span> <?php echo esc_html($category->name); ?></span><span><?php echo esc_html($category->count); ?></span></a></li>
					<?php endforeach; ?>
				<?php endif; ?>
			</ul>
		</div>
        	<div class="services__widget-content d-none">
	        	<div class="services__link">
	                <ul>
					    <?php 
						    $categories = get_terms( array(
							    'taxonomy' => 'category',
							    'hide_empty' => true,
							) );
							?>
							<?php if ( !empty($categories) ) : ?>
							<?php foreach ( $categories as $category ) : ?>
				            <li>
				                <a href="<?php echo esc_url( get_category_link( $category->term_id)); ?>">
			                        <?php echo esc_html($category->name); ?>
				                </a>
				            </li>
				            <?php endforeach; ?>
				        	<?php endif; ?>
							<?php 
						?> 
			        </ul>
			    </div>
		    </div>

		<?php echo $after_widget; ?>

		<?php
	}



	public function form($instance){
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$count = ! empty( $instance['count'] ) ? $instance['count'] : esc_html__( '3', 'tp-toolkits' );
		$posts_order = ! empty( $instance['posts_order'] ) ? $instance['posts_order'] : esc_html__( 'DESC', 'tp-toolkits' );
	?>	
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php echo esc_html__('Title', 'tp-toolkit'); ?></label>
			<input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('count'); ?>"><?php echo esc_html__('How many posts you want to show ?', 'tp-toolkit'); ?></label>
			<input type="number" name="<?php echo $this->get_field_name('count'); ?>" id="<?php echo $this->get_field_id('count'); ?>" value="<?php echo esc_attr( $count ); ?>" class="widefat">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('posts_order'); ?>"><?php echo esc_html__('Posts Order','tp-toolkit'); ?></label>
			<select name="<?php echo $this->get_field_name('posts_order'); ?>" id="<?php echo $this->get_field_id('posts_order'); ?>" class="widefat">
				<option value="" disabled="disabled"><?php echo esc_html__('Select Post Order','tp-toolkit'); ?></option>
				<option value="<?php echo esc_attr__('ASC', 'tp-toolkit') ?>" <?php if($posts_order === 'ASC'){ echo 'selected="selected"'; } ?>><?php echo esc_html__('ASC','tp-toolkit'); ?></option>
				<option value="<?php echo esc_attr__('DESC', 'tp-toolkit') ?>" <?php if($posts_order === 'DESC'){ echo 'selected="selected"'; } ?>><?php echo esc_html__('DESC','tp-toolkit'); ?></option>
			</select>
		</p>

	<?php }


}




add_action('widgets_init', function(){
	register_widget('Latest_Services_Cat_List_Widget');
});