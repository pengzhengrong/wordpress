<?php
/**
 *	File: core.php
 *	Core functionality of the plugin Show Post Categories
**/

//	Security check
defined( 'ABSPATH' ) or die( 'DIRECT ACCESS BLOCKED!' );

/*
 *	It´s all about this part : )
 *	Grab provided attribute(s) and parse them so we can perform the requested action (== output data)
 */
function show_post_categories( $atts ){

	/*	
	 *	First we define variables & globals
	 *		global $post	- variable from outside the function
	 *		$spc_options	- array with options found in the WP database
	 *		$pull_atts		- get all provided attributes & define defaults in case some attribute is missing
	 *		$spc_id			- get post/page ID
	 *		$spc_output		- clearing the output; not needed but just in case we need to debug..
	 */
	global $post;
	$spc_options = get_option( 'spc_options' );
	$pull_atts = shortcode_atts( array(
						'show' => '',
						'id' => NULL,
						'parent' => 'yes',
                        'parentcategory' => NULL,
                        'separator' => $spc_options[ 'separator_1' ],
						'hyperlink' => 'no',
						'hyperlinktarget' => $spc_options['hyperlink_target_1'],
						'attribute' => Null,
						'taxonomy' => Null
					), $atts );
	$spc_id = $pull_atts[ 'id' ] == NULL ? $post->ID : $pull_atts[ 'id' ];
	$spc_output = NULL;	
	
	
	switch ( $pull_atts[ 'taxonomy' ] ){

				case NULL:
					$tax = get_post_taxonomies($spc_id);
					switch ( $pull_atts[ 'show' ] ){
						
							case "category":	//	User wants taxonomy category name
							$tax_type = $tax[0]; 
							
							break;// END OF CASE
							
							case "tag":	//	User wants taxonomy tag name
							$tax_type = $tax[1]; 
							
							break;// END OF CASE
							
							default:
							//Do Nothing
							break;//	END OF CASE
					}
				break;//	END OF CASE
				
				default:
					$tax_type = $pull_atts[ 'taxonomy' ];
				break;//	END OF CASE
					
	}
	/*
	 *	Check if given ID contains only digits;
	 *		if so : True
	 *		if not : False
	 */
	if(!function_exists('is_digit')){ 
		function is_digit($digit) {
			if(is_int($digit)) {
				return true;
			} elseif(is_string($digit)) {
				return ctype_digit($digit);
			} else {
				// booleans, floats and others
				return false;
			}
		}
	}

	/*	
	 *	Get ID of category based on category name (not SLUG!)
	 *	Accepts custom taxonomy by changing $tax_type
	 *		=> get_category_id(‘WordPress’, ‘categoria’);
	 */
	if(!function_exists('get_category_id')){
		function get_category_id($cat_name, $tax_type){
			$term = get_term_by('name', $cat_name, $tax_type);
			return $term->term_id;
		}
	}
	
	/*
	 *	User entered text title for the post/page ID: convert to real ID
	 *		=> could cause strange behaviour if user has number for title..
	 */
	If(is_digit($spc_id) != True ){
		$spc_page = get_page_by_title( $spc_id );
		$spc_id = $spc_page->ID;
	}
			
	 /*
	  *	To find out what user wants to see we use a switch statement,
	  * loop over the provided attributes to find the corresponding "show" attribute & run some code
	  */
	 switch ( $pull_atts['show'] ) {

		case "category":	//	User wants CATEGORY information
			
			if ($tax_type != "category"){ 	// check if custom taxonomy
				$categories = get_the_terms( $spc_id, $tax_type );
			}else{
				$categories = get_the_category($spc_id);	// get all categories		
			}
			
			/*
			 *	Check if user wants to show only categories from certain parent category
			 */
			switch ( $pull_atts['parentcategory'] ){

				case NULL:	//	User didn´t define anything, so list them all!

					if ( ! empty( $categories ) ) {						// If categories are empty we obviously don´t  do a thing
						foreach( $categories as $category ) {			//	If multiple categories: loop through them all
							if ($pull_atts[ 'hyperlink' ] == 'no'){		//	User doesn´t want a hyperlink
								if ($pull_atts[ 'parent' ] == 'no'){	//	User doesn´t want parents to show
									if($category->parent != 0){
										$spc_output .= esc_html( $category->name ) . $pull_atts['separator'];
									}
								}else{									// User wants to show all - including parents
									$spc_output .= esc_html( $category->name ) . $pull_atts['separator'];
								}
							}else{										//	User wants hyperlinks activated
								if ($pull_atts[ 'parent' ] == 'no'){	//	User does not want parents to show
									if($category->parent != 0){
										$spc_output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr( sprintf( __( $spc_options[ 'hyperlink_text_1' ], 'Show-Post-Categories' ), $category->name ) ) . '" target="'.$pull_atts[ 'hyperlinktarget' ].'">' . esc_html( $category->name ) . '</a>' . $pull_atts['separator'];
									}
								}else{									// User wants to show all - including parents
									$spc_output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr( sprintf( __( $spc_options[ 'hyperlink_text_1' ], 'Show-Post-Categories' ), $category->name ) ) . '" target="'.$pull_atts[ 'hyperlinktarget' ].'">' . esc_html( $category->name ) . '</a>' . $pull_atts['separator'];
								}
							}
						}
						return trim( $spc_output, $pull_atts['separator'] );	//	Create output with custom separator if needed..
					}
				break;//	END OF CASE
				
				default:	//	User defined a Parent Category so we´ll filter on this category

					if ( ! empty( $categories ) ) {				// If categories are empty we obviously don´t  do a thing
						foreach( $categories as $category ) {	//	If multiple categories: loop through them all
							
							$parentcat = get_category_id($pull_atts['parentcategory'], $tax_type);	//	Get ID of parent category

							if(cat_is_ancestor_of($parentcat, $category) || $category->name == $pull_atts['parentcategory']){
								if ($pull_atts[ 'hyperlink' ] == 'no'){		//	User doesn´t want a hyperlink
									if ($pull_atts[ 'parent' ] == 'no'){	//	User doesn´t want parents to show
										if($category->parent != 0){
											$spc_output .= esc_html( $category->name ) . $pull_atts['separator'];
										}
									}else{									// User wants to show all - including parents
										$spc_output .= esc_html( $category->name ) . $pull_atts['separator'];
									}
								}else{										//	User wants hyperlinks activated
									if ($pull_atts[ 'parent' ] == 'no'){	//	User doesn´t want parents to show
										if($category->parent != 0){
											$spc_output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr( sprintf( __( $spc_options[ 'hyperlink_text_1' ], 'Show-Post-Categories' ), $category->name ) ) . '" target="'.$pull_atts[ 'hyperlinktarget' ].'">' . esc_html( $category->name ) . '</a>' . $pull_atts['separator'];
										}
									}else{									// User wants to show all - including parents
										$spc_output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr( sprintf( __( $spc_options[ 'hyperlink_text_1' ], 'Show-Post-Categories' ), $category->name ) ) . '" target="'.$pull_atts[ 'hyperlinktarget' ].'">' . esc_html( $category->name ) . '</a>' . $pull_atts['separator'];
									}
								}
							}
						}
						return trim( $spc_output, $pull_atts['separator'] );//	Create output with custom separator if needed..
					}
				break;//	END OF CASE
			}
			
		break;//	END OF CASE
		
		case "title":	//	User wants TITLE information
		
			$spc_title= get_the_title($spc_id);	//	Get title
		
			switch($pull_atts[ 'hyperlink' ]){	//	See if user needs a hyperlink
			
				case "yes":						// Create hyperlink with Title
					$spc_output = '<a href="' . esc_url( get_permalink($spc_id) ) . '"title="' . esc_attr( sprintf( __( $spc_options[ 'hyperlink_text_2' ], 'Show-Post-Categories' ), $spc_title ) ) . '" target="'.$pull_atts[ 'hyperlinktarget' ].'" >' . esc_html( $spc_title ) . '</a>';
					return trim( $spc_output );	//	Create output
				break;//	END OF CASE
				
				default:						// By default we will not create a hyperlink
					$spc_output = $spc_title;
					return trim( $spc_output );	//	Create output
					
				break;//	END OF CASE
			}

			break;// END OF CASE

		case "id":	// User wants ID number

			switch($pull_atts[ 'hyperlink' ]){
			
				case "yes":	// Create hyperlink
					$spc_output = '<a href="' . esc_url( get_permalink($spc_id) ) . '" title="' . esc_attr( sprintf( __( $spc_options[ 'hyperlink_text_3' ], 'Show-Post-Categories' ), $spc_id ) ) . '"  target="'.$pull_atts[ 'hyperlinktarget' ].'">' . esc_html( $spc_id ) . '</a>';
					return trim( $spc_output );
					
				break;// END OF CASE
				
				default:	// Return plain ID
					$spc_output = $spc_id;
					return trim( $spc_output );
					
				break;// END OF CASE
			}

		break;// END OF CASE
			
		case "author":	// User wants AUTHOR data
			
			
			$post_author_id = get_post_field( 'post_author', $spc_id );

			switch($pull_atts[ 'attribute']){
			
				case "email":	//	User wants email from author
				//$spc_output = the_author_meta( 'user_email' ,$spc_id); 
				$spc_output = get_the_author_meta( 'user_email', $post_author_id); 
				return trim( $spc_output );
				
				break;// END OF CASE
				
				case "url":	//	User wants url from author
				$spc_output = get_the_author_meta( 'user_url' ,$post_author_id); 
				return trim( $spc_output );
				
				break;// END OF CASE
				
				case "nicename":	//	User wants nicename from author
				$spc_output = get_the_author_meta( 'user_nicename' ,$post_author_id); 
				return trim( $spc_output );
				
				break;// END OF CASE
				
				case "nickname":	//	User wants nickname from author
				$spc_output = get_the_author_meta( 'nickname' ,$post_author_id); 
				return trim( $spc_output );
				
				break;// END OF CASE
				
				case "firstname":	//	User wants first_name from author
				$spc_output = get_the_author_meta( 'first_name' ,$post_author_id); 
				return trim( $spc_output );
				
				break;// END OF CASE
				
				case "lastname":	//	User wants last_name from author
				$spc_output = get_the_author_meta( 'last_name' ,$post_author_id); 
				return trim( $spc_output );
				
				break;// END OF CASE
				
				case "id":	//	User wants id from author
				$spc_output = get_the_author_meta( 'id' ,$post_author_id); 
				return trim( $spc_output );
				
				break;// END OF CASE
				
				default:	//	By default user just wants a display name
				$spc_output = get_the_author_meta( 'display_name' ,$post_author_id); 
				return trim( $spc_output );
				
				break;// END OF CASE
			}
		break;// END OF CASE
			
		
		case "tag": // User wants TAG 

		if ($tax_type != "category"){
				$spc_posttags = get_the_terms( $spc_id, $tax_type );
			}else{
				$spc_posttags = get_the_tags($spc_id);	// get all tags		
			}
			
		
			//$spc_posttags = get_the_tags($spc_id);	//	Get all tags first

			if (!empty ($spc_posttags)) {			// 	If there are tags, loop through them
					foreach($spc_posttags as $spc_tag) {	//	For every tag, do:
						
						switch($pull_atts[ 'hyperlink' ]){	//	User wants hyperlink?
				
							case "yes":	// Create hyperlink
								$spc_output .= '<a href="' . esc_url( get_tag_link($spc_tag->term_id) ) . '" title="' . esc_attr( sprintf( __( $spc_options[ 'hyperlink_text_4' ], 'Show-Post-Categories' ), $spc_tag->name ) ) . '"  target="'.$pull_atts[ 'hyperlinktarget' ].'">' . esc_html( $spc_tag->name ) . '</a>' . $pull_atts['separator'];
								
							break;// END OF CASE
							
							default:	// Return plain Tag
								$spc_output .=$spc_tag->name . $pull_atts['separator'];
								
							break;// END OF CASE
						}
					}
				return trim( $spc_output, $pull_atts['separator'] );
			}

		break;// END OF CASE
		
		case "taxonomy":	// User looks for taxonomy in post
			$tax = get_post_taxonomies($spc_id);
			switch($pull_atts[ 'attribute']){
			
				case "category":	//	User wants taxonomy category name
				$spc_output = $tax[0]; 
				return trim( $spc_output );
				
				break;// END OF CASE
				
				case "tag":	//	User wants taxonomy tag name
				$spc_output = $tax[1]; 
				return trim( $spc_output );
				
				break;// END OF CASE
				
				default:	// Return taxonomy tag name & taxonomy category name
				$spc_output = "Custom Taxonomy name for Category: <b>". $tax[0] . "</b> & Custom Taxonomy name for Tag: <b>".$tax[1]."</b>"; 
				return trim( $spc_output );
								
				break;// END OF CASE
			}
		break;// END OF CSE
		//VERDER DOEN LINK : toevoegen in options page
		/* POTENTIAL NEW FEATURES
		 *		Tag DESCRIPTION using Attribute='description'
		 *			-> w Hyperlink
		 *		Category DESCRIPTION using Attribute='description'
		 *			-> w Hyperlink
		 *		Show EXCERPT
		 *			-> w Hyperlink
		 *		Show Featured IMAGE
		 *			-> w Hyperlink
		 *		Change ID to: attribute=id or title or tag or category, instead of the following ideas;
		 *		ID from title
		 *			-> user wants to enter title text and get ID from it. show='title' Attribute='id'
		 *		ID from tag
		 *			-> user wants to enter tag text and get ID from it. show='tag' Attribute='id'
		 *		ID from Category
		 *			-> user wants to enter category text and get ID from it. show='category' Attribute='id'
		 *
		 *	POTENTIAL TWEAKS
		 *		Make hyperlinktarget an array (_1, _2..) so default target could be different per requested action
		 *			-> update url tags with $pull_atts='hyperlinktarget'->1 ...
		 *		'parent' => 'yes' => 'parent'=> Null 
		 *			-> rewrite needed switches first
		 *		Multiple settings for separator in options page(allow per show action another setting..?)
		 *		Hyperlink='no' rewriteite to Null
		 * 			-> Rewrite to Null after proper implementation of switch at show'category'
		 *
		 */

		// User forgot to specify his needs..
		default:
			return "<b>Show-Post-Categories : You forgot to set an attribute for the required action (=show)! </b><br> Need help? Check plugin homepage: <a href='https://willemso.com/'>Willemso.Com</a>!";

		break;// END OF CASE
	}
}
 
add_shortcode('show_post_categories', 'show_post_categories');  

?>