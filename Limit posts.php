<?php

//Hide the Publish Actions on the 'post-new.php?post_type=property', page, but not on edit pages

add_action('admin_head' , 'limit_posts');
function limit_posts(){
	$count_property = wp_count_posts('property')->publish;
	$max_properties = 10; //the number of max published posts
	if($count_property >= $max_properties){
		global $pagenow;
		if (! empty($pagenow) && ('post-new.php' === $pagenow && ( $_GET['post_type'] == 'property'))){
			?>
			<style>
				#publishing-action { display: none; }
			</style>
			<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery("#major-publishing-actions").html("You have reached the publication limit for this CPT."); // message is displayed instead of the publish button
			});
			</script>
				<?php
		}
	}
}

?>
