/**
 * @since 1.0
 * https://jscolor.com/docs/#doc-install-add-data-jscolor
 */
( function( $, api ) {

    /* HEADER BUILDER
    ================================================================================ */
    api.bind( 'ready', function() {

        var init_headerbuilder = function() {
            var parts_refresh = function( container ) {
                container.find( '.hb56__part' ).each(function() {
                    var part = $( this ),
                        currentElements = []
                    if ( undefined === part.data( 'elements' ) ) {
                        part.data( 'elements', [] )
                    }
                        
                    part.find( '.hb56__element' ).each(function(){
                        currentElements.push( $( this ).data('element') )
                    })

                    // trigger changes when it's being changed
                    if ( currentElements !== part.data('elements') ) {
                        part.data( 'elements', currentElements )
                        data_part = part.data( 'part' )
                        api( data_part + '_elements' ).set( currentElements ) // this trigger changes
                    }

                })
            }

            /* ------------------------     layout adjustments */
            var sections = [ 'topbar', 'main_header', 'header_bottom', 'header_mobile' ]
            for ( var section of sections ) {
                if ( 'header_mobile' == section ) {
                    container = $( '.hb56--mobile' )
                } else {
                    container = $( '.hb56--desktop' )
                }

                /**
                 * on init
                 */
                var newval = api( section + '_layout' )()

                /* ----------------------       set the col correctly */
                var cols = newval.split('-'),
                    cols_num = cols.length
                if ( 1 == cols_num ) {
                    cols = [ '01' ].concat( cols ).concat( ['01'] )
                } else if ( 2 == cols_num ) {
                    cols.splice(1,0, '01' )
                }
                $( '.hb56__' + section ).find( '.col' ).each(function(index) {
                    var col = cols[index],
                        col_cl = col.split('')
                    $( this ).removeClass( 'col-1-2 col-1-3 col-1-4 col-1-5 col-1-6 col-2-3 col-2-5 col-3-4 col-3-5 col-4-5 col-5-6 col-1-1 col-0-1' )
                    $( this ).addClass( 'col-' + col_cl[0] + '-' + col_cl[1] )

                    /* ----------------------       move elements when layout become zero */
                    if ( '0' == col_cl[0] ) {
                        $( this ).find( '.hb56__element' ).appendTo( container.find('.hb56__elements') )
                    }
                });

                /**
                 * when changed
                 */
                api( section + '_layout', function( value ) {
                    value.bind( function(newval) {

                        var section = value.id.replace( '_layout', '' ),
                            container = $( '.hb56__' + section ).closest( '.hb56' )

                        /* ----------------------       set the col correctly */
                        var cols = newval.split('-'),
                            cols_num = cols.length
                        if ( 1 == cols_num ) {
                            cols = [ '01' ].concat( cols ).concat( ['01'] )
                        } else if ( 2 == cols_num ) {
                            cols.splice(1,0, '01' )
                        }
                        $( '.hb56__' + section ).find( '.col' ).each(function(index) {
                            var col = cols[index],
                                col_cl = col.split('')
                            $( this ).removeClass( 'col-1-2 col-1-3 col-1-4 col-1-5 col-1-6 col-2-3 col-2-5 col-3-4 col-3-5 col-4-5 col-5-6 col-1-1 col-0-1' )
                            $( this ).addClass( 'col-' + col_cl[0] + '-' + col_cl[1] )

                            /* ----------------------       move elements when layout become zero */
                            if ( '0' == col_cl[0] ) {
                                $( this ).find( '.hb56__element' ).appendTo( container.find('.hb56__elements') )
                            }
                        })
                        
                    })
                })
            }

            /* ------------------------     edit section */
            $( '.hb56' ).on( 'click', '.hb56__name', function( e ) {
                e.preventDefault()
                var part = $( this ).data( 'part' )
                api.section( part ).focus()
            });

            /* ------------------------     edit element */
            $( '.hb56__element i' ).on( 'click', function( e ) {
                e.preventDefault()
                var ele = $( this ).parent(),
                    ele_name = ele.data( 'element' )
                var name_to_section_map = {
                    'hamburger' : 'header_hamburger',
                    'nav' : 'header_nav',
                    'logo' : 'title_tagline',
                    'social' : 'header_social',
                    'search' : 'header_search',
                    'cart' : 'header_cart',
                    'html1' : 'header_html',
                    'html2' : 'header_html',
                    'html3' : 'header_html',
                    'button1' : 'header_button1',
                    'button2' : 'header_button2',
                    'darkmode' : 'design_darkmode',
                }
                var section_name = name_to_section_map[ ele_name ]
                api.section( section_name ).focus()
            });

            /* ------------------------     init header parts */
            $( '.hb56__part' ).each(function() {
                var part = $( this ),
                    part_id = part.data( 'part' ),
                    elements_setting = api( part_id + '_elements' )
                    container = part.closest( '.hb56' )
                if ( ! elements_setting ) {
                    return;
                }
                elements = elements_setting()
                if ( typeof elements == 'string' ) {
                    elements = [ elements ]
                }
                if ( ! typeof elements == 'object' ) {
                    return
                }
                for ( var element of elements ) {
                    container.find( '.hb56__element[data-element="' + element + '"]' ).appendTo( part )
                }
            });

            var screens = [ 'desktop', 'mobile' ],
                funcs = {
                    desktop: function() { parts_refresh( $( '.hb56--desktop' ) ) },
                    mobile: function() { parts_refresh( $( '.hb56--mobile' ) ) },
                }
            for ( var screen of screens ) {

                var container = $( '.hb56--' + screen ),
                    container_selector = '.hb56--' + screen

                /* ------------------------     sortable */
                container.find( '.hb56__part, .hb56__elements' ).sortable({
                    items : '.hb56__element',
                    placeholder: "sortable-placeholder",
                    connectWith: container.find( '.hb56__part, .hb56__elements' ),
                    update: funcs[ screen ],
                });

            } // each screen
        } // init_headerbuilder() function

        /* ------------------------     activate header builder when panel section opened */
        window.header_builder_init = false
        api.panel( 'header' ).expanded.bind( function( isExpanding ) {
            if(isExpanding) {
                $( '.hb56' ).addClass( 'active' )
                if ( ! window.header_builder_init ) {
                    init_headerbuilder()
                    window.header_builder_init = true
                }
            } else {
                $( '.hb56' ).removeClass( 'active' )
            }
        });

        api.section( 'header_offcanvas' ).expanded.bind( function( isExpanding ) {
            if(isExpanding) {
                $( '.hb56' ).removeClass( 'active' )
            }
        });
        
	});

    /**
     * OFFCANVAS ACTIVE PANEL
     * HEADER MOBILE
     * SIDEDOCK
     * ====================================================================================
     */
    api.bind( 'ready', function() {

        api.previewer.bind( 'ready', function() {
            
            /* off canvas
            ------------------------------------------------------ */
            api.section( 'header_offcanvas' ).expanded.bind(function (isExpanded) {
                if( isExpanded ) {
                    api.previewer.send( 'show_offcanvas' );
                } else {
                    api.previewer.send( 'hide_offcanvas' );
                }
            });
            
            /* mobile header
            ------------------------------------------------------ */
            api.section( 'header_mobile' ).expanded.bind(function (isExpanded) {
                if( isExpanded ) {
                    wp.customize.previewedDevice.set( 'mobile' );
                } else {
                    wp.customize.previewedDevice.set( 'desktop' );
                }
            });

            /* side dock
            ------------------------------------------------------ */
            api.section( 'single_sidedock' ).expanded.bind(function (isExpanded) {
                if( isExpanded ) {
                    api.previewer.send( 'show_single_sidedock' );
                } else {
                    api.previewer.send( 'hide_single_sidedock' );
                }
            });
            
        });
    });
    
})( jQuery, wp.customize );