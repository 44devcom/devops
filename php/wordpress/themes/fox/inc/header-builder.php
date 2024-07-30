<?php
add_action( 'customize_controls_print_footer_scripts', 'fox56_header_builder_init' );
function fox56_header_builder_init() {
    ?>
<div class="hb56 hb56--desktop">

    <div class="hb56__wrapper">
        <div class="hb56__topbar hb56__section">
            <span class="hb56__name" data-part="topbar">
                <i class="dashicons dashicons-edit hastip" title="Customize Topbar"></i>
                <span>Topbar</span>
            </span>
            <div class="row hb56__row">
                <div class="col col-1-2 col--left">
                <div class="hb56__part" data-part="topbar_left"></div>
                </div>
                <div class="col col-0-1 col--center">
                <div class="hb56__part" data-part="topbar_center"></div>
                </div>
                <div class="col col-1-2 col--right">
                <div class="hb56__part" data-part="topbar_right"></div>
                </div>
            </div>
        </div>
        <div class="hb56__main_header hb56__section">
            <span class="hb56__name" data-part="main_header">
                <i class="dashicons dashicons-edit hastip" title="Customize Main Header"></i>
                <span>Main Header</span>
            </span>
            <div class="row hb56__row">
                <div class="col col-0-1 col--left">
                    <div class="hb56__part" data-part="main_header_left"></div>
                </div>
                <div class="col col-1-1 col--center">
                    <div class="hb56__part" data-part="main_header_center"></div>
                </div>
                <div class="col col-0-1 col--right">
                    <div class="hb56__part" data-part="main_header_right"></div>
                </div>
            </div>
        </div>
        <div class="hb56__header_bottom hb56__section">
            <span class="hb56__name" data-part="header_bottom">
                <i class="dashicons dashicons-edit hastip" title="Customize Header Bottom"></i>
                <span>Header Bottom</span>
            </span>
            <div class="row hb56__row">
                <div class="col col-1-4 col--left">
                    <div class="hb56__part" data-part="header_bottom_left"></div>
                </div>
                <div class="col col-1-2 col--center">
                    <div class="hb56__part" data-part="header_bottom_center"></div>
                </div>
                <div class="col col-1-4 col--right">
                    <div class="hb56__part" data-part="header_bottom_right"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="hb56__elements">
        <span class="hb56__element" data-element="logo">
            <i class="dashicons dashicons-edit hastip" title="Customize this"></i>
            <span>Logo</span>
        </span>
        <span class="hb56__element" data-element="nav">
            <i class="dashicons dashicons-edit hastip" title="Customize this"></i>
            <span>Menu</span>
        </span>
        <span class="hb56__element" data-element="social">
            <i class="dashicons dashicons-edit hastip" title="Customize this"></i>
            <span>Social</span>
        </span>
        <span class="hb56__element" data-element="hamburger">
            <i class="dashicons dashicons-edit hastip" title="Customize this"></i>
            <span>Hamburger</span>
        </span>
        <span class="hb56__element" data-element="search">
            <i class="dashicons dashicons-edit hastip" title="Customize this"></i>
            <span>Search</span>
        </span>
        <span class="hb56__element" data-element="html1">
            <i class="dashicons dashicons-edit hastip" title="Customize this"></i>
            <span>HTML1</span>
        </span>
        <span class="hb56__element" data-element="html2">
            <i class="dashicons dashicons-edit hastip" title="Customize this"></i>
            <span>HTML2</span>
        </span>
        <span class="hb56__element" data-element="html3">
            <i class="dashicons dashicons-edit hastip" title="Customize this"></i>
            <span>HTML3</span>
        </span>
        <span class="hb56__element" data-element="cart">
            <i class="dashicons dashicons-edit hastip" title="Customize this"></i>
            <span>Cart</span>
        </span>
        <span class="hb56__element" data-element="darkmode">
            <i class="dashicons dashicons-edit hastip" title="Customize this"></i>
            <span>Darkmode Toggle</span>
        </span>
        <span class="hb56__element" data-element="button1">
            <i class="dashicons dashicons-edit hastip" title="Customize this"></i>
            <span>Button1</span>
        </span>
        <span class="hb56__element" data-element="button2">
            <i class="dashicons dashicons-edit hastip" title="Customize this"></i>
            <span>Button2</span>
        </span>
    </div>
</div><!-- .hb56--desktop -->

<div class="hb56 hb56--mobile">

    <div class="hb56__wrapper">
        <div class="hb56__header_mobile hb56__section">
            <span class="hb56__name" data-part="header_mobile">
                <i class="dashicons dashicons-edit hastip" title="Customize Main Header"></i>
                <span>Header Mobile</span>
            </span>
            <div class="row hb56__row">
                <div class="col col-0-1 col--left">
                    <div class="hb56__part" data-part="header_mobile_left"></div>
                </div>
                <div class="col col-1-1 col--center">
                    <div class="hb56__part" data-part="header_mobile_center"></div>
                </div>
                <div class="col col-0-1 col--right">
                    <div class="hb56__part" data-part="header_mobile_right"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="hb56__elements">
        <span class="hb56__element" data-element="logo">
            <i class="dashicons dashicons-edit hastip" title="Customize this"></i>
            <span>Logo</span>
        </span>
        <span class="hb56__element" data-element="nav">
            <i class="dashicons dashicons-edit hastip" title="Customize this"></i>
            <span>Menu</span>
        </span>
        <span class="hb56__element" data-element="social">
            <i class="dashicons dashicons-edit hastip" title="Customize this"></i>
            <span>Social</span>
        </span>
        <span class="hb56__element" data-element="hamburger">
            <i class="dashicons dashicons-edit hastip" title="Customize this"></i>
            <span>Hamburger</span>
        </span>
        <span class="hb56__element" data-element="search">
            <i class="dashicons dashicons-edit hastip" title="Customize this"></i>
            <span>Search</span>
        </span>
        <span class="hb56__element" data-element="html1">
            <i class="dashicons dashicons-edit hastip" title="Customize this"></i>
            <span>HTML1</span>
        </span>
        <span class="hb56__element" data-element="html2">
            <i class="dashicons dashicons-edit hastip" title="Customize this"></i>
            <span>HTML2</span>
        </span>
        <span class="hb56__element" data-element="html3">
            <i class="dashicons dashicons-edit hastip" title="Customize this"></i>
            <span>HTML3</span>
        </span>
        <span class="hb56__element" data-element="cart">
            <i class="dashicons dashicons-edit hastip" title="Customize this"></i>
            <span>Cart</span>
        </span>
        <span class="hb56__element" data-element="darkmode">
            <i class="dashicons dashicons-edit hastip" title="Customize this"></i>
            <span>Darkmode Toggle</span>
        </span>
        <span class="hb56__element" data-element="button1">
            <i class="dashicons dashicons-edit hastip" title="Customize this"></i>
            <span>Button1</span>
        </span>
        <span class="hb56__element" data-element="button2">
            <i class="dashicons dashicons-edit hastip" title="Customize this"></i>
            <span>Button2</span>
        </span>
    </div>
</div><!-- .hb56--mobile -->

    <?php
}