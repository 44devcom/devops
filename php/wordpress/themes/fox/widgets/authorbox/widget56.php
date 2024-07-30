<?php
if ( ! is_single() ) {
    return;
}

extract( $args );
extract( wp_parse_args( $instance, array(
    'title' => '',
    'layout' => 'stack',
    'align' => 'left',
) ) );
echo $before_widget;

$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
if ( !empty( $title ) ) {	
    echo $before_title . $title . $after_title;
}
$cl = [ 'authorboxes56', 'authorboxes56--widget' ]; // widget version
$cl[] = 'align-' . $align;
$cl[] = 'authorboxes56--' . $layout;
?>

<div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
    <?php echo fox56_authorbox_inner(); ?>
</div>

<?php echo $after_widget; ?>