<?php get_template_part( 'parts/titlebar' ); ?>
<?php 
$builder = new Fox_Builder();
$builder->render( fox_builder_data() );