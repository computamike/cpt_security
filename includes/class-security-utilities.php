<?php
class security_utilities {

	/**
	 * Compile post type capabilities.
	 * @param  string $singular [description]
	 * @param  string $plural   [description]
	 * @return [type]           [description]
	 */
	public static function compile_post_type_capabilities($singular = 'post', $plural = 'posts') {
		return [
			'edit_post'      => "edit_$singular",
			'read_post'      => "read_$singular",
			'delete_post'        => "delete_$singular",
			'edit_posts'         => "edit_$plural",
			'edit_others_posts'  => "edit_others_$plural",
			'publish_posts'      => "publish_$plural",
			'read_private_posts'     => "read_private_$plural",
			'read'                   => "read",
			'delete_posts'           => "delete_$plural",
			'delete_private_posts'   => "delete_private_$plural",
			'delete_published_posts' => "delete_published_$plural",
			'delete_others_posts'    => "delete_others_$plural",
			'edit_private_posts'     => "edit_private_$plural",
			'edit_published_posts'   => "edit_published_$plural",
			'create_posts'           => "edit_$plural",
		];
	}


	public static function post_message($singular = 'Post', $plural = 'Posts'){
		$lower_case_singular = strtolower($singular);

		add_filter( 'post_updated_messages', function($messages) use ($singular, $plural,$lower_case_singular){
		    global $post, $post_ID;

		    $link = esc_url( get_permalink($post_ID) );
			$draft_preview_link = esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) );
			$scheduled_date = date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) );
			$revision = isset($_GET['revision']) ? wp_post_revision_title( (int) $_GET['revision'], false ):false;
		    $messages[$lower_case_singular] = array(
		        0 => '',
		        1 => sprintf( __("$singular updated. <a href=\"$link\">View $lower_case_singular</a>") ),
		        2 => __('Custom field updated.'),
		        3 => __('Custom field deleted.'),
		        4 => __("$singular updated."),
		        5 => isset($_GET['revision']) ? sprintf( __("$singular restored to revision from $revision")) : false,
		        6 => sprintf( __("$singular published. <a href=\"$link\">View study</a>") ),
		        7 => __("$singular saved."),
		        8 => sprintf( __("$singular submitted. <a target=\"_blank\" href=\"$draft_preview_link\">Preview $lower_case_singular</a>")),
		        9 => sprintf( __("$singular scheduled for: <strong>$scheduled_date</strong>. <a target=\"_blank\" href=\"$link\">Preview study</a>")),
		        10 => sprintf( __("$singular draft updated. <a target=\"_blank\" href=\"$draft_preview_link\">Preview study</a>")),
		    );
		    return $messages;
		});
	}

	public static function bulk_post_message($singular = 'Post', $plural = 'Posts'){
		$lower_case_singular = strtolower($singular);
		$lower_case_plural = strtolower($plural);

		add_filter( 'bulk_post_updated_messages', function( $bulk_messages, $bulk_counts ) use ($lower_case_singular, $lower_case_plural) {


			$bulk_messages[$lower_case_singular] = array(
				'updated'   => _n( "%s $lower_case_singular updated.", "%s $lower_case_plural updated.", $bulk_counts["updated"] ),
				'locked'    => _n( "%s $lower_case_singular not updated, somebody is editing it.", "%s $lower_case_plural not updated, somebody is editing them.", $bulk_counts["locked"] ),
				'deleted'   => _n( "%s $lower_case_singular permanently deleted.", "%s $lower_case_plural permanently deleted.", $bulk_counts["deleted"] ),
				'trashed'   => _n( "%s $lower_case_singular moved to the Trash.", "%s $lower_case_plural moved to the Trash.", $bulk_counts["trashed"] ),
				'untrashed' => _n( "%s $lower_case_singular restored from the Trash.", "%s $lower_case_plural restored from the Trash.", $bulk_counts["untrashed"] ),
			);
			return $bulk_messages;
		}, 10, 2 );
	}

	/**
	 * Compile labels for a 'thing'
	 * @param  string $singular [description]
	 * @param  string $plural   [description]
	 * @return [type]           [description]
	 */
	public static function xcompile_post_type_labels($singular = 'Post', $plural = 'Posts') {
		$p_lower = strtolower($plural);
		$s_lower = strtolower($singular);
		return [
			'name' => $plural,
			'singular_name' => $singular,
			'add_new_item' => "New $singular",
			'edit_item' => "Edit $singular",
			'view_item' => "View $singular",
			'view_items' => "View $plural",
			'search_items' => "Search $plural",
			'not_found' => "No $p_lower found",
			'not_found_in_trash' => "No $p_lower found in trash",
			'parent_item_colon' => "Parent $singular",
			'all_items' => "All $plural",
			'archives' => "$singular Archives",
			'attributes' => "$singular Attributes",
			'insert_into_item' => "Insert into $s_lower",
			'uploaded_to_this_item' => "Uploaded to this $s_lower",
		];
	}
}
