( function( $ ) {
    
    var api = wp.customize

    /**
     * css, style, builder..
     */
    api.bind( 'preview-ready', function() {

        window.css = {}
        window.all_ids = []

        /* SET UP STYLE
        ================================================================================ */
        var style = $( '#css-preview' );
        if ( ! style.length ) {
            style = $( '<style id="css-preview" />' );
            $( 'head' ).append( style );
        }

        /* PENCIL
        ================================================================================ */
        let pencil = function() {

            /**
             * edit pencil problem
             */
            window.all_ids.forEach( function( widget_id ) {
                let widget = $( '.' + widget_id )
                if ( ! widget.length ) {
                    return
                }
                if ( 'sectionlist' == widget_id ) {
                    return
                }
                let settings = api( widget_id )(),
                    widget_type = settings.type,
                    widget_name = FOX_CUSTOMIZE_BUILDER.widgets_info[ widget_type ].title
                widget.addClass( 'widget56' )
                widget.attr( 'data-widget', settings.type )
                widget.attr( 'title', '' ) // remove the "Shift Click to edit"

                if ( widget.find( '> .widget56__edit' ).length ) {
                    return
                }
                widget.append( '<span class="widget56__edit" data-id="' + widget_id + '">' + widget_name + ' <i class="dashicons dashicons-edit"></i></span>' )
            })
            $( '.widget56__edit' ).on( 'click', function( e ) {
                e.preventDefault()
                var widget_id = $( this ).data( 'id' )
                api.preview.send( 'edit_widget', widget_id )
            })

        }

        /* PARTIAL REFRESH
        ================================================================================ */
        api.selectiveRefresh.bind( 'partial-content-rendered', function( placement ) {
            pencil()
            $( document ).trigger( 'partial-refresh', [ placement.partial.id, placement.partial.params.selector ])
        });

        /* WIDGETLIST --> PENCIL
        ================================================================================ */
        api.preview.bind( 'all_ids', function( data ) {
            window.all_ids = data
            pencil()
        })

        /* CSS FUNCTIONS
        ================================================================================ */
        let sumup = function() {
            style.html( collect_normal_pieces() + collect_builder_pieces() )
        }

        /**
         * get CSS structure for builder
         */
        /*
        {
            section: {
                background: [
                    { selector: , property: , value_pattern: , unit: },
                    { selector: , property: , value_pattern: , unit: },
                ],
                color: [
                    { selector: , property: , value_pattern: , unit: },
                    { selector: , property: , value_pattern: , unit: },
                ],
            },
            post-grid: {
                title_color: [
                    { selector: , property: , value_pattern: , unit: },
                ],
                title_typography: [
                    { selector: '{{wrapper}} .title56', property: 'font-family', use: 'face', unit: },
                    { selector: '{{wrapper}} .title56', property: 'font-weight', use: 'weight', unit: },
                ],
            }
        }
        */
        const css_structure = {},
            widgets_info = FOX_CUSTOMIZE_BUILDER.widgets_info
        for ( let widget_type in widgets_info ) {
            let fields = widgets_info[ widget_type ].fields,
                css_fields = {}
            for ( var field_id in fields ) {
                var field = fields[ field_id ]
                if ( ! field.css ) {
                    continue
                }
                if ( ! Array.isArray( field.css ) ) {
                    // console.log( widget_type )
                    // console.log( field_id )
                }
                css_fields[ field_id ] = structuredClone( field.css )
            }
            css_structure[ widget_type ] = css_fields
        }
        
        let collect_normal_pieces = function() {
            let pieces = []
            for ( var setting_name in window.css ) {
                var css_piecce = window.css[ setting_name ]
                for ( var single_piece of css_piecce ) {
                    
                    // get the latest value here
                    if ( single_piece.id ) {
                        var value = api( single_piece.id )()
                        if ( single_piece.field ) {
                            if ( undefined !== value[ single_piece.field ] ) {
                                value = value[ single_piece.field ]
                            } else {
                                continue
                            }
                        }
                        if ( single_piece.use ) {
                            if ( undefined !== value[ single_piece.use ] ) {
                                value = value[ single_piece.use ]
                            } else {
                                continue
                            }
                        }
                        var final_value = value
                    } else {
                        var final_value = single_piece.value 
                    }

                    if ( '' === final_value ) {
                        continue
                    }
                    if ( undefined === final_value ) {
                        continue
                    }

                    // unit
                    if ( single_piece.unit && ! isNaN( final_value ) ) {
                        final_value += single_piece.unit
                    }
                    // css pattern
                    if ( single_piece.value_pattern ) {
                        final_value = single_piece.value_pattern.replaceAll( '$', final_value )
                    }

                    if ( single_piece.media_query ) {
                        var piece = single_piece.media_query + '{' + single_piece.selector + '{' + single_piece.property + ':' + final_value + '}' + '}'
                    } else {
                        var piece = single_piece.selector + '{' + single_piece.property + ':' + final_value + '}'
                    }
                    pieces.push( piece )
                }
            }
            pieces = pieces.join( '' )
            return pieces
        }

        let collect_builder_pieces = function() {
            let pieces = []
            /*
            h__css = {
                id_124: {
                    background_color: #123,
                    title_typo: {
                        weight: 400,
                        size: 12,
                        size_tablet: 11
                    }
                }
            } 
             */
            let h__css = api( 'h2[css]' )()

            for ( let widget_id in h__css ) {

                if ( ! api( widget_id ) ) {
                    continue
                }

                /**
                 * this is common, sometimes the widget_id has been deleted
                 * but we still have it in h__css, just skip it
                 */
                let settings = api( widget_id )(),
                    widget_type = settings.type,
                    /**
                     * css_dict = { background: #123, title_typography: { weight: 400, size: 12 } }
                     */
                    css_dict = h__css[ widget_id ]

                if ( undefined === widget_type ) {
                    continue
                }

                for ( let field_id in css_dict ) {
                    /**
                     * css_arr = [{ selector: '{{wrapper}} .title56', property: .. }]
                     */
                    let css_arr = css_structure[ widget_type ][ field_id ],
                        value = css_dict[ field_id ]
                    if ( ! Array.isArray( css_arr ) ) {
                        continue
                    }
                    for ( let single_piece of css_arr ) {
                        let final_value = value,
                            piece = null

                        if ( single_piece.use && typeof value === 'object' && value !== null ) {
                            final_value = value[ single_piece.use ]
                        } else {
                            final_value = value
                        }
                        if ( undefined === final_value ) {
                            continue
                        }
                        /**
                         * selector
                         */
                        let selector = single_piece.selector.replaceAll( '{{wrapper}}', '.' + widget_id )

                        // unit
                        if ( single_piece.unit && ! isNaN( final_value ) ) {
                            final_value += single_piece.unit
                        }
                        // css pattern
                        if ( single_piece.value_pattern ) {
                            final_value = single_piece.value_pattern.replaceAll( '$', final_value )
                        }
                        if ( single_piece.media_query ) {
                            piece = single_piece.media_query + '{' + selector + '{' + single_piece.property + ':' + final_value + '}' + '}'
                        } else {
                            piece = selector + '{' + single_piece.property + ':' + final_value + '}'
                        }
                        pieces.push( piece )
                    }

                }
            }

            pieces = pieces.join( '' )
            return pieces
        }

        /* CSS FUNCTIONS
        ================================================================================ */
        api.preview.bind( 'window_css', function( data ) {
            window.css = data
            for ( var setting_name in window.css ) {
                api( setting_name, function( value ) {
                    value.setting_name = setting_name
                    value.bind( function(newval) {
                        sumup()
                    })
                })
            }

            api( 'h2[css]', function( value ) {
                value.setting_name = 'h2[css]'
                value.bind( function(newval) {
                    sumup()
                })
            })

        })

        /*
        api.preview.bind( 'fox_section_update', function( data ) {
            console.log( data )
            let selector = $( '.' + data.widget_id )
            if ( ! selector.length ) {
                return
            }
            $( document ).trigger( 'fox_section_update', [ selector ])
        })
        */

        /*
        api.preview.bind( 'window_builder_css', function( data ) {
            
            // watch the changes
            for ( var setting_name in data ) {
                window.builder_css_setting_name = setting_name
                window.css_builder_structure = data[ setting_name ]
                api( setting_name, function( value ) {
                    value.setting_name = setting_name
                    value.bind( function(newval) {
                        sumup()
                    })
                })
            }
        })
        */

        /* SCROLL when click to widget56__bar
        ================================================================================ */
        api.preview.bind( 'scroll', function( data ) {
            let widget_id = data.widget_id
            if ( ! $( '.' + widget_id ).length ) {
                return
            }
            let ele = $( '.' + widget_id )
            window.scrollTo( 0, ele.offset().top - 60 )
            $( '.focused' ).removeClass( 'focused' )
            ele.addClass( 'focused' )
        })

        /* load-font
        @todo57: we will load google fonts array to put fallback fonts correctly
        ================================================================================ */
        api.preview.bind( 'load-font', function( face ) {
            var face_plus_version = face.replaceAll( ' ', '+' )
            $( 'head' ).append( '<link href="https://fonts.googleapis.com/css?family=' + face_plus_version + ':100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic" rel="stylesheet" />' )
        })

	});

    /* FONTS LOAD
    @todo57: we will load google fonts array to put fallback fonts correctly
    ============================================================================= */
    api( 'body_font', function( value ) {
        value.bind( function( newval ) {
            var root = ':root{--font-body:' + newval + '}'
            root = '<style>' + root + '</style>'
            jQuery( 'head' ).append( root )
        } );
    });

    api( 'heading_font', function( value ) {
        value.bind( function( newval ) {
            var root = ':root{--font-heading:' + newval + '}'
            root = '<style>' + root + '</style>'
            jQuery( 'head' ).append( root )
        } );
    });

    api( 'nav_font', function( value ) {
        value.bind( function( newval ) {
            var root = ':root{--font-nav:' + newval + '}'
            root = '<style>' + root + '</style>'
            jQuery( 'head' ).append( root )
        } );
    });

    api( 'custom_1_font', function( value ) {
        value.bind( function( newval ) {
            var root = ':root{--font-custom-1:' + newval + '}'
            root = '<style>' + root + '</style>'
            jQuery( 'head' ).append( root )
        } );
    });

    api( 'custom_2_font', function( value ) {
        value.bind( function( newval ) {
            var root = ':root{--font-custom-2:' + newval + '}'
            root = '<style>' + root + '</style>'
            jQuery( 'head' ).append( root )
        } );
    });

    api( 'accent_color', function( value ) {
        value.bind( function( newval ) {
            var root = ':root{--accent-color:' + newval + '}'
            root = '<style>' + root + '</style>'
            jQuery( 'head' ).append( root )
        } );
    });

    /* LAYOUT
    ============================================================================= */
    api( 'layout_boxed', function( value ) {
        value.bind( function( newval ) {
            if ( newval ) {
                jQuery( 'body' ).addClass( 'layout-boxed' )
            } else {
                jQuery( 'body' ).removeClass( 'layout-boxed' )
            }
        } );
    });

    /* TOPBAR
    ============================================================================= */
    var sections = [ 'topbar', 'main_header', 'header_bottom' ]
    for ( var section of sections ) {
        // stretch
        api( section + '_stretch', function( value ) {
            value.bind(function(newval){
                var section = value.id.replace( '_stretch', '' )
                var selector = '.' + section + '56__container'
                $( selector ).removeClass( 'stretch--full stretch--content' )
                $( selector ).addClass( 'stretch--' + newval )
            })
        })
        // text skin
        api( section + '_text_skin', function( value ) {
            value.bind(function(newval){
                var section = value.id.replace( '_text_skin', '' )
                var selector = '.' + section + '56__container'
                $( selector ).removeClass( 'textskin--light textskin--dark' )
                $( selector ).addClass( 'textskin--' + newval )
            })
        })
    }

    /* SINGLE HEADER ALIGN
    ============================================================================= */
    api( 'single_header_align', function( value ) {
        value.bind( function( newval ) {
            jQuery( '.single56__header' ).removeClass( 'align-left align-center align-right' ).addClass( 'align-' + newval )
        } );
    });

    /* off-canvas showing up when we customizing it
    ============================================================================= */
    wp.customize.bind( 'preview-ready', function() {
        wp.customize.preview.bind( 'show_offcanvas', function() {
            $( 'html' ).addClass( 'in-offcanvas-permanent' )
        });

        wp.customize.preview.bind( 'hide_offcanvas', function() {
            $( 'html' ).removeClass( 'in-offcanvas-permanent' )
        });
    });

    /* single side dock
    ============================================================================= */
    api.bind( 'preview-ready', function() {
        wp.customize.preview.bind( 'show_single_sidedock', function() {
            $( 'html' ).addClass( 'in-single-sidedock-permanent' )
        });

        wp.customize.preview.bind( 'hide_single_sidedock', function() {
            $( 'html' ).removeClass( 'in-single-sidedock-permanent' )
        });
    });
    
})( jQuery );