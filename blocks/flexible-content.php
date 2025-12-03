<?php 
global $block_count; 
$block_count = 1;

if(have_rows('flexible_content_blocks')) {  
	while(have_rows('flexible_content_blocks')) {
		the_row();
    if(get_row_layout() == 'form_block' ) {
    	get_template_part( 'blocks/form-block' );
		} elseif(get_row_layout() == 'image_and_content_block' ) {
      get_template_part( 'blocks/image-and-content' );
		} elseif(get_row_layout() == 'banner_divider_block' ) {
      get_template_part( 'blocks/banner-divider-block' );
		} elseif(get_row_layout() == 'full-width_text_block' ) {
      get_template_part( 'blocks/full-width-text' );
		} elseif(get_row_layout() == 'half-width_block' ) {
      get_template_part( 'blocks/half-width' );
		} elseif(get_row_layout() == '3_column_icons_&_content_block' ) {
      get_template_part( 'blocks/icons-and-content' );
		} elseif(get_row_layout() == 'accordions_block' ) {
      get_template_part( 'blocks/accordions-block' );
		} elseif(get_row_layout() == 'comparison_table_with_content_block' ) {
      get_template_part( 'blocks/comparison-table-block' );
		} elseif(get_row_layout() == 'stacked_icons_block' ) {
      get_template_part( 'blocks/stacked-icons-block' );
		} elseif(get_row_layout() == 'carousel_block' ) {
      get_template_part( 'blocks/carousel-block' );
		} elseif(get_row_layout() == 'footer_banner' ) {
      get_template_part( 'blocks/footer-banner' );	
		} elseif(get_row_layout() == 'warehouse_finder' ) {
      get_template_part( 'blocks/warehouse-finder' );	
		} 
		$block_count++;
	}
} ?>

<div class="clear"></div>