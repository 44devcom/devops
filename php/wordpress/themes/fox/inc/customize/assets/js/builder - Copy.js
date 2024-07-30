/**
 TOC
 1. widgets 
 2. edit fields & update field options
 3. correlation with previewer frame
 */

"use strict";

( function( $, api ) {

    // this is common
    window.close_widget_editor = function() {
        $( '.widget56__editor' ).removeClass( 'showing' )
        $( '.widget56__editor__bar' ).removeClass( 'showing' )
        $( 'body' ).removeClass( 'openning-widget56' )
    }

    $( document ).on( 'click', '.widget56__editor__bar__close', function( e ) {
        e.preventDefault()
        close_widget_editor()
    })

    api.controlConstructor.fox56_builder = api.Control.extend({
		ready: function() {

            let randomid = function() {
                return generate_section_id()
                var uniqid = Date.now();
                return 'id-' + uniqid;
            }
            
            const control = this, container = this.container,
                builder_sections = $( container ).find( '.builder56__sections' ),
                widget_ele_sample = $( container ).find( '.widget56--placeholder' ),
                widgets_info = FOX_CUSTOMIZE_BUILDER.widgets_info,
                widget_arr = Object.keys( widgets_info ),
                values = control.settings,
                sectionlist = values.sectionlist(),
                widget_ids = values.h2_widget_ids(),
                preload_prefix = values.preload_prefix()

            let foo100 = []
            for ( var i = 1; i <= 100; i++ ) {
                foo100.push( preload_prefix + i )
            }

            const preload_sectionlist = foo100

            console.log( sectionlist )
            console.log( preload_prefix )

            sectionlist.forEach( function( section_id, index ) {
                let foo = api( section_id )()
                foo.blah = index
                api( section_id ).set( foo )
                console.log( api( section_id )() )
            })

            // to remove later
            api.section('h2').focus()
            $( '.widget56[data-widget="section"]:first-child > .widget56__bar .indicator' ).trigger( 'click' )
            
            /* get widget content, deep
            ================================================================================ */
            let get_widget_content = function( widget ) {
                var content = []
                widget.find(  '> .widget56__content > .widget56' ).each(function(){
                    var self = $( this )
                    var settings = self.data( 'settings' )
                    var new_settings = structuredClone( settings )
                    new_settings.content = get_widget_content( self )
                    // self.data( 'settings', new_settings )
                    content.push( new_settings )
                })
                return content
            }

            /* RETURN jQuery ele
            ================================================================================ */
            let widget_from_settings = function( widget_settings ) {
                var widget_type = widget_settings.type
                if ( ! widgets_info[ widget_type ] ) {
                    console.error( 'no valid type: ' + widget_type )
                    return
                }
                var widget_id = widget_settings.widget_id
                if ( ! widget_id ) {
                    widget_id = randomid()
                    widget_settings.widget_id = widget_id
                }

                var widget_content = widget_settings.content
                if ( ! widget_content ) {
                    widget_content = []
                    widget_settings.content = widget_content
                }

                var widget_ele = widget_ele_sample.clone()
                widget_ele.removeClass( 'widget56--placeholder' )
                widget_ele.attr( 'data-widget', widget_type )
                widget_ele.attr( 'data-id', widget_id )
                if ( widgets_info[ widget_type ].icon ) {
                    widget_ele.find( '.widget56__icon' ).html( '<i class="dashicons dashicons-' + widgets_info[ widget_type ].icon + '"></i>' )
                }
                var title = widget_settings.widget_title ? widget_settings.widget_title : widgets_info[ widget_type ].title
                widget_ele.find( '.widget56__title' ).text( title )

                // info
                var info = ''
                if ( 'column' == widget_type ) {
                    if ( widget_settings.size ) {
                        info = widgets_info.column.fields.size.options[ widget_settings.size ]
                    } else {
                        info = widgets_info.column.fields.size.std
                    }
                }
                if ( info ) {
                    widget_ele.find( '.widget56__info' ).text( info )
                }

                /**
                 * only row/column/section has content and has button
                 */
                if ( 'row' == widget_type || 'column' == widget_type || 'section' == widget_type ) {
                    
                    /* content
                    ----------------------------- */
                    var content = widget_settings.content
                    if ( Array.isArray( content ) ) {
                        for ( var content_ele of content ) {
                            if ( ! content_ele.type ) {
                                console.log( content_ele )
                                continue
                            }
                            widget_ele.find( ' > .widget56__content' ).append( widget_from_settings( content_ele ) )
                        }
                    }

                    /* btn
                    ----------------------------- */
                    var btn_text,
                        boardname,
                        widget_type_add
                    if ( 'row' == widget_type ) {
                        // boardname = 'list-2'
                        btn_text = 'Add Column'
                        widget_type_add = 'column'
                    } else if ( 'section' == widget_type ) {
                        boardname = 'list-1'
                        btn_text = 'Add Row/Element'
                    } else if ( 'column' == widget_type ) {
                        boardname = 'list-1'
                        btn_text = 'Add Element'
                    }
                    if ( 'column' == widget_type || 'section' == widget_type ) {
                        var btn = '<a href="#" class="widget56__btn widget56__add__tooltip" data-boardname="' + boardname + '"><i class="dashicons dashicons-plus-alt2"></i>' + btn_text + '</a>'
                    } else if ( 'row' == widget_type ) {
                        var btn = '<a href="#" class="widget56__btn widget56__add" data-widget_type="' + widget_type_add + '"><i class="dashicons dashicons-plus-alt2"></i>' + btn_text + '</a>'
                    } 
                    widget_ele.find( ' > .widget56__content' ).append( btn )

                /**
                 * for those don't have content, we don't need indicator
                 */
                } else {
                    widget_ele.find( ' > .widget56__bar > .indicator' ).addClass( 'invisible' )
                }

                // store the settings
                widget_ele.data( 'settings', widget_settings )
                return widget_ele
            }

            /**
             * element board
             * ================================================================================ */
            var widgetlist_1 = widget_arr.filter(item => item !== 'section' )
            widgetlist_1 = widgetlist_1.filter(item => item !== 'column' )
            var widgetlists = [ widgetlist_1 ],
                count = 0
            for ( var avail_widgets of widgetlists ) {
                var board = []
                count += 1
                for ( var w of avail_widgets ) {
                    var board_item = '<div class="board__item" data-widget="' + w + '">' + widgets_info[w].title + '<i class="dashicons dashicons-plus-alt2"></i></div>'
                    board.push( board_item )
                }
                board = board.join( "\n" )
                board = '<div class="board__container">' + board + '</div><div class="board__preview"></div>'
                board = '<div class="board__wrapper" data-list="list-' + count + '">' + board + '</div>'
                $( 'body' ).append( board )
            }

            /* GENERATE NEW ID
             * get it from preload_sectionlist
            ================================================================================ */
            var generate_section_id = function() {
                var new_section_id;
                var count = 1;
                while ( 1 ) {
                    count++;
                    if ( count > 30 ) { // logic back up
                        break;
                    }
                    if ( ! preload_sectionlist.length ) {
                        break
                    }
                    var new_section_id = preload_sectionlist.shift()
                    
                    if ( ! $(container).find( '.widget56[data-id="' + new_section_id + '"]' ).length ) {
                        break;
                    } else {
                        console.log( new_section_id )
                    }
                    
                }
                if ( ! new_section_id ) {
                    api.previewer.save()
                    window.shouldReload = true
                    return;
                }
                return new_section_id
            }

            /* Widget UI init
             * eg. tooltipster
            ================================================================================ */
            let widget_ui = function() {

                /* tooltipster for add button
                ------------------------------------------------------ */
                $( '.widget56__add__tooltip:not(.tooltipstered)' ).each(function() {
                    var a = $( this ),
                        section = a.closest( '.widget56[data-widget="section"]' ),
                        boardname = a.data( 'boardname' )
                    $( this ).tooltipster({
                        debug: false,
                        animation: 'fade',
                        animationDuration: 0,
                        delay: 0,
                        theme: 'tooltipster-shadow',
                        triggerClose: 'custom',
                        trigger: 'click',
                        contentAsHTML: true,
                        side: 'right',
                        interactive: true,
                        content: $( '.board__wrapper[data-list="' + boardname + '"]' ),
                        contentCloning: true,
                        functionReady : function( instance, helper ) {
                            /**
                             * when click board item
                             */
                            instance.content().on( 'click', '.board__item', function( e ) {
                                e.preventDefault()
                                var widget_type = $( this ).data( 'widget' ),
                                    widget_settings = {
                                        type: widget_type,
                                    },
                                    widget_ele = widget_from_settings( widget_settings )

                                a.before( widget_ele )
                                $( document ).trigger( 'widget_added', [widget_ele] )
                                $( document ).trigger( 'section_changed', [section] )

                                // remove this bind
                                instance.content().off( 'click' )
                                instance.close();
                            })

                            /**
                             * hover board item
                             */
                            instance.content().on( 'mouseenter', '.board__item', function() {
                                var widget_type = $( this ).data( 'widget' ),
                                    image_url = widgets_info[ widget_type ].image_url
                                if ( ! image_url ) {
                                    return
                                }
                                instance.content().find( '.board__preview' ).html( '<img src="' + image_url + '" />' )
                            })
                        }
                    })
                })

                /* tooltipster for hover
                ------------------------------------------------------ */
                $( '.widget56__action' ).tooltipster({
                    animation: 'fade',
                    animationDuration: 0,
                    delay: 0,
                    theme: 'tooltipster-borderless',
                    debug: false,
                })
            }

            $( document ).on( 'sections_init', widget_ui )
            $( document ).on( 'widget_added', widget_ui )

            /* SORTABLE
            ================================================================================ */
            let run_sortable = function() {

                $( container ).find( '.builder56__sections' ).sortable({
                    items : '> .widget56',
                    placeholder: "sortable-placeholder",
                    handle: ".widget56__bar",
                    update: function( event, ui ) {
                        $( document ).trigger( 'sectionlist_changed' ) // update sectionlist
                    }
                })

                /* sortable widgets
                --------------------------------- */
                $( container ).find( '.widget56[data-widget="section"]' ).each(function() {
                    var section = $( this )

                    section.find( '.widget56__content' ).each(function() {
                        $( this ).sortable({
                            items : '> .widget56',
                            placeholder: "sortable-placeholder",
                            handle: ".widget56__bar",
                            update: function( event, ui ) {
                                $( document ).trigger( 'section_changed', [section] )
                            }
                        })
                    })
                })
            }
            $( document ).on( 'sections_init', run_sortable )
            $( document ).on( 'widget_added', run_sortable )

            /* INDICATOR TOGGLE
            ================================================================================ */
            let open_widget = function( widget, indicator = null ) {
                if ( indicator === null ) {
                    indicator = widget.find( '> .widget56__bar .indicator' )
                }
                widget.find( '> .widget56__content' ).slideDown( 'fast', 'linear', function() {
                    indicator.removeClass( 'dashicons-arrow-right-alt2' )
                    indicator.addClass( 'dashicons-arrow-down-alt2' )
                })
            }
            // open all inner rows, cols
            let open_widget_deep = function( widget, indicator = null ) {
                open_widget( widget, indicator )
                var widget_settigs = widget.data( 'settings' ),
                    widget_type = widget_settigs.type
                if ( 'row' == widget_type || 'section' == widget_type ) {
                    widget.find( '.widget56[data-widget="row"], .widget56[data-widget="column"]' ).each(function(){
                        var self = $( this ) 
                        open_widget( self )
                    })
                }
            }
            let is_close = function( widget, indicator ) {
                return indicator.hasClass( 'dashicons-arrow-right-alt2' )
            }
            let is_open = function( widget, indicator ) {
                return indicator.hasClass( 'dashicons-arrow-down-alt2' )
            }
            let close_widget = function( widget, indicator = null ) {
                if ( indicator === null ) {
                    indicator = widget.find( '> .widget56__bar .indicator' )
                }
                widget.find( '> .widget56__content' ).slideUp( 'fast', 'linear', function() {
                    indicator.addClass( 'dashicons-arrow-right-alt2' )
                    indicator.removeClass( 'dashicons-arrow-down-alt2' )
                })
            }

            $( document ).on( 'click', '.widget56__bar .indicator', function( e ) {
                e.preventDefault()
                var widget = $( this ).closest( '.widget56' ),
                    widget_type = widget.data( 'widget' ),
                    indicator = $( this )

                if ( is_open( widget, indicator ) ) {
                    close_widget( widget, indicator )
                } else {
                    open_widget( widget, indicator )
                    if ( 'row' == widget_type || 'section' == widget_type ) {
                        widget.find( '.widget56[data-widget="row"], .widget56[data-widget="column"]' ).each(function(){
                            var self = $( this ) 
                            open_widget( self )
                        })
                    }
                }
            })

            // bind open when widget added
            $( document ).on( 'widget_added', function( e, widget_ele ) {
                var widget_settings = widget_ele.data( 'settings' )
                if ( ['row','column', 'section'].includes( widget_settings.type ) ) {
                    open_widget_deep( widget_ele )
                }
            })

            /* ADD
            ================================================================================ */
            /**
             * add section
             */
            $( document ).on( 'click', '.builder56__add-section', function(e) {
                e.preventDefault()

                var section_id = generate_section_id(),
                    widget_settings = {
                        type: 'section',
                        widget_id: section_id,
                        section_id: section_id,
                        section_name : 'Untitled',
                        widget_title : 'Untitled'
                    },
                    widget_ele = widget_from_settings( widget_settings )
                    widget_ele.attr( 'data-id', section_id )

                builder_sections.append( widget_ele )
                
                $( document ).trigger( 'widget_added', [ widget_ele] ) // rerun widget_ui, update widgetlist, collapse it
                $( document ).trigger( 'section_changed', [widget_ele] )
                $( document ).trigger( 'sectionlist_changed' ) // update sectionlist

            })

            /**
             * add widget without tooltip
             */
            $( document ).on( 'click', '.widget56__add', function(e) {
                e.preventDefault()

                var a = $( this ),
                    section = a.closest( '.widget56[data-widget="section"]' ),
                    widget_type = a.data( 'widget_type' ),
                    widget_settings = {
                        type: widget_type,
                    },
                    widget_ele = widget_from_settings( widget_settings )

                a.before( widget_ele )
                $( document ).trigger( 'widget_added', [widget_ele] )
                $( document ).trigger( 'section_changed', [section] )
            })

            /**
             * add widget with tooltip
             * scroll up a little bit
             */

            /* DUPLICATE WIDGET
            ================================================================================ */
            let generate_section_name = function( name, list = [] ) {

                // list = [ 'New section (1)', 'New section (3)', 'New section (4)', 'New section (5)', 'New section 10'];
                name = String(name);
                name = name.trim();
                if( !name ) name = 'New Section';
                if( !Array.isArray(list) ) return name;
        
                var pos = name.search(/\s\([\d]+\)$/);
                var sec_number = 1, name_1 = name, name_2;
                if( -1 !== pos){
                    name_1 = name.substring(0, pos);
                    sec_number = name.substring(pos+2, name.length-1);
                    sec_number = parseInt(sec_number) + 1;
                }
                
                // if( Number.isNaN(sec_number) ) sec_number = 1;
        
                name_2 = name_1 + " (" + sec_number + ")";
                var i=0, maxlength = list.length;
                while( i < maxlength ) {
                    
                    if( name_2 != list[i] ) {
                        i++; continue;
                    }
                    // If duplicate
                    i = 0; sec_number++;
                    name_2 = name_1 + " (" + sec_number + ")";
                    
                }
                return name_2;
            }

            let deep_clone = function( widget, h__css ) {
                var widget_new = widget.clone(),
                    widget_settings = widget.data( 'settings' ),
                    widget_id = widget_settings.widget_id,
                    widget_type = widget_settings.type,
                    content = widget_new.find( '> .widget56__content' ),
                    new_id = 'section' == widget_type ? generate_section_id() : randomid()
                content.find( '> .widget56' ).remove()
                widget.find( '> .widget56__content > .widget56' ).each(function(){
                    var sub_widget = $( this ),
                        sub_widget_clone = deep_clone( sub_widget, h__css )
                    content.append( sub_widget_clone )
                })
                widget_new.attr( 'data-id', new_id )
                let settings_new = structuredClone( widget.data( 'settings' ) )
                settings_new.content = get_widget_content( widget )
                settings_new.widget_id = new_id

                /**
                 * clone css
                 */
                if ( undefined !== h__css[ widget_id ] ) {
                    h__css[ new_id ] = h__css[ widget_id ]
                }
                
                /**
                 * section_name problem
                 */
                if ( 'section' == widget_type ) {
                    var sec_name = widget_settings.widget_title ? widget_settings.widget_title : 'Untitled'
                    var list_sec_name = [];
                    builder_sections.find( '>.widget56' ).each(function( index ) {
                        list_sec_name[index] = $( this ).data( 'settings' ).section_name
                    });
                    settings_new.section_name = generate_section_name( sec_name, list_sec_name );
                    settings_new.widget_title = settings_new.section_name
                    widget_new.find( '> .widget56__bar .widget56__title' ).text( settings_new.section_name )
                }

                widget_new.data( 'settings', settings_new )

                /**
                 * remove tooltipster
                 */
                widget_new.find( '.widget56__add__tooltip' ).removeClass( 'tooltipstered' )
                return widget_new
            }

            $( document ).on( 'click', '.widget56__action[data-action="duplicate"]', function( e ) {

                e.preventDefault()

                var widget = $( this ).closest( '.widget56' )
                // deep_synchronize( widget )
                var widget_settings = widget.data( 'settings' ),
                    widget_type = widget_settings.type,
                    h__css = structuredClone( api( control.id + '__css' )() )

                if ( 'section' == widget_type ) {
                    var section = widget
                    var widget_ele = deep_clone( section, h__css )
                    
                    // widget_ele.attr( 'data-id', generate_section_id() )
                    section.after( widget_ele )
                    $( document ).trigger( 'widget_added', [widget_ele] )
                    $( document ).trigger( 'sectionlist_changed' )
                    $( document ).trigger( 'section_changed', [widget_ele] )

                } else {

                    var section = widget.closest( '.widget56[data-widget="section"]' )
                    var widget_ele = deep_clone( widget, h__css ),
                        widget_new_id = randomid()
                    // widget_ele.attr( 'data-id', widget_new_id )
                    widget.after( widget_ele )
                    $( document ).trigger( 'widget_added', [widget_ele] )
                    $( document ).trigger( 'section_changed', [section] )

                }

                // update css
                api( control.id + '__css' ).set( h__css )
                
            })

            /* DELETE WIDGET
            ================================================================================ */
            $( document ).on( 'click', '.widget56__action[data-action="delete"]', function( e ) {
                e.preventDefault()
                var widget = $( this ).closest( '.widget56' ),
                    widget_settings = widget.data( 'settings' ),
                    widget_type = widget_settings.type

                if ( 'section' == widget_type ) {
                    widget.remove()
                    $( document ).trigger( 'sectionlist_changed' )
                } else {
                    var section = widget.closest( '.widget56[data-widget="section"]' )
                    widget.remove()
                    $( document ).trigger( 'section_changed', [section] )
                }
                /**
                 * update css builder
                 */
                $( document ).trigger( 'widget_deleted', widget_settings )
            })

            /* WIDGETLIST
             * here we collect them all from DOM to get 100% sure we have correct info
            {
                id4329782: {
                    type: row,
                    valign: middle
                },
                id39287432: {
                    type: post-grid,
                    column: { desktop : 3, tablet: 1, mobile: 1 }
                },

            }
            ================================================================================ */
            var update_widget_list = function() {
                var widgetlist = {}
                builder_sections.find( '.widget56' ).each( function() {
                    var widget_id = $( this ).data( 'id' )
                    widgetlist[ widget_id ] = $( this ).data( 'settings' )
                })
                api.previewer.send( 'widgetlist', widgetlist )
            }
            $( document ).on( 'widget_added', update_widget_list )
            api.previewer.bind( 'ready', function() {
                update_widget_list()
            })

            /* section is jQuery ele
                * this happens when we change widget settings, but only non-css fields
                * when we change add element/remove element/clone element --> change section content
                * when we re-order elements
            ================================================================================ */
            /**
             * widget is jQuery ele
             */
            var update_section = function( section ) {
                var section_id = section.data( 'id' ),
                    section_settings = section.data( 'settings' ), // yes, this is the latest
                    new_section_settings = structuredClone( section_settings ),
                    section_content = get_widget_content( section )

                new_section_settings.content = section_content
                api( section_id ).set( new_section_settings )
            }
            $( document ).on( 'section_changed', function( e, section ) {
                update_section( section )
                api.previewer.send( 'fox_section_update', { widget_id: section.data( 'id' )} )
            })

            /* update sectionlist, ie. h
                * this is being used for add new section, remove section, duplicate section, re-order section
            ================================================================================ */
            var update_sectionlist = function() {
                var current_sectionlist = []
                $( builder_sections ).find( '> .widget56' ).each(function() {
                    var section_id = $( this ).data( 'id' )
                    current_sectionlist.push( section_id )
                })
                control.settings.sectionlist.set( current_sectionlist )
            }
            $( document ).on( 'sectionlist_changed', update_sectionlist )

            /* INIT SECTIONS
            ================================================================================ */
            for ( var section_id of sectionlist ) {
                var section_value = api( section_id )()
                    // section_css_value = api( section_id + '__css' )(),
                    // section_settings = {...section_value, ...section_css_value }
                var section_settings = structuredClone( section_value )

                section_settings.widget_title = section_settings.section_name
                section_settings.type = 'section'
                section_settings.widget_id = section_id
                // backward compat
                if ( undefined === section_settings.content ) {
                    console.error( 'why???' )
                    continue
                }

                var widget_section = widget_from_settings( section_settings )
                builder_sections.append( widget_section )
                // $( document ).trigger( 'widget_added', [widget_section] )
            }
            $( document ).trigger( 'sections_init' )

            /* ------------------------------------------------------------------------------------------ */
            /* ------------------------------------------------------------------------------------------ */
            /* ------------------------------------------------------------------------------------------ */
            // PART 2
            /* ------------------------------------------------------------------------------------------ */
            /* ------------------------------------------------------------------------------------------ */
            /* ------------------------------------------------------------------------------------------ */

            /* BUILDER CSS
             @todo63, we'll need to initialize this h__css with ALL default settings
            ================================================================================ */
            var h__css = api( control.id + '__css' )()
            console.log( h__css )
            if ( ! h__css || Array.isArray( h__css ) ) {
                h__css = {}
            }

            /**
             * update h__css on widget_added
             */
            $( document ).on( 'widget_added', function( e, widget ) {
                let widget_settings = widget.data( 'settings' ),
                    widget_id = widget_settings.widget_id,
                    widget_type = widget_settings.type,
                    h__css = structuredClone( api( control.id + '__css' )() )
                if ( undefined === h__css[ widget_id ] ) {
                    h__css[ widget_id ] = {}
                    for ( var k in widgets_info[ widget_type ].fields ) {
                        let v = widgets_info[ widget_type ].fields[k]
                        if ( undefined === v.css || undefined === v.std ) {
                            continue
                        }
                        h__css[ widget_id ][ k ] = v.std
                    }
                    api( control.id + '__css' ).set( h__css )
                }
            })

            /**
             * update h__css on widget_deleted
             */
            $( document ).on( 'widget_deleted', function( e, widget_settings ) {
                let widget_id = widget_settings.widget_id,
                    h__css = structuredClone( api( control.id + '__css' )() )
                if ( undefined === h__css[ widget_id ] ) {
                    delete h__css[ widget_id ]
                }
                api( control.id + '__css' ).set( h__css )
            })
            
            /* initialize the editor
            ================================================================================ */
            if ( ! $( '.widget56__editor' ).length ) {
                console.error( 'widget editor is missing' )
                return
            }
            $( '.widget56__editor' ).appendTo( $( '.wp-full-overlay-sidebar-content' ) )
            $( '.widget56__editor__bar' ).appendTo( $( '.wp-full-overlay-sidebar-content' ) )

            /* OPEN EDITOR
            ================================================================================ */
            let open_widget_editor = function( widget_misc ) {
                var widget
                if ( typeof widget_misc === 'string' ) {
                    let widget_id = widget_misc
                    widget = builder_sections.find( '.widget56[data-id="' + widget_id + '"]' )
                } else {
                    widget = widget_misc
                }
                if ( ! widget.length ) {
                    console.error( 'cant find widget' )
                    return
                }
                populate_widget_fields( widget )
                $( '.widget56__editor' ).addClass( 'showing' )
                $( '.widget56__editor__bar' ).addClass( 'showing' )
                $( 'body' ).addClass( 'openning-widget56' )
            }

            /* open the editor by clicking to widget bar text */
            $( document ).on( 'click', '.widget56__bar__text', function( e ) {
                e.preventDefault();
                var widget = $( this ).closest( '.widget56' )
                open_widget_editor( widget )
            })

            /* POPULATE widget fields
             * widget is jQuery ele
            ================================================================================ */
            let populate_widget_fields = function( widget ) {

                let widget_editor = $( '.widget56__editor' ),
                    widget_settings = widget.data( 'settings' ),
                    widget_id = widget_settings.widget_id,
                    wtype = widget_settings.type,
                    css = api( control.id + '__css' )()
                
                if ( ! widgets_info[ wtype ] ) {
                    console.error( widget_settings )
                    return
                }
                
                let fields = widgets_info[ wtype ].fields,
                    field_name = widgets_info[ wtype ].title,
                    tabs = {}

                var tab,
                    tab_name,
                    section,
                    section_name

                /**
                 * set up fundamentally
                 */
                widget_editor.data( 'widget_id', widget_id )
                $( '.widget56__editor' ).html('') // clean the editor
                $( '.widget56__editor__bar__title' ).text( field_name )
                
                /**
                 * set up each field
                 */
                for ( var field_id in fields ) {

                    var field = fields[ field_id ],
                        field_title = field.name ? field.name : field.title,
                        field_type = field.type,
                        field_desc = field.desc,
                        field_placeholder = field.placeholder ? field.placeholder : '',
                        field_options = field.options,
                        field_std = undefined !== field.std ? field.std : '',
                        field_html = [],
                        field_tab = field.tab,
                        field_section = field.section

                    if ( field.css ) {
                        var value = css[ widget_settings.widget_id ] ? css[ widget_settings.widget_id ][ field_id ] : undefined
                    } else {
                        var value = widget_settings[ field_id ]
                    }

                    if ( undefined === value ) {
                        value = field_std
                    }
                    
                    if ( undefined !== field_tab ) {
                        tab = field_tab
                        tab_name = field.tab_name ? field.tab_name : tab
                    }
                    if ( undefined !== field_section ) {
                        section = field_section
                        section_name = field.section_name ? field.section_name : section
                    }
                    if ( undefined === tab ) {
                        tab = 'general'
                        tab_name = 'General'
                    }
                    if ( undefined === section ) {
                        section = 'general'
                        section_name = 'General'
                    }
                    if ( undefined == tabs[ tab ] ) {
                        tabs[ tab ] = {
                            'name' : tab_name,
                            'sections' : {},
                        }
                    }
                    if ( undefined == tabs[ tab ].sections[ section ] ) {
                        tabs[ tab ].sections[ section ] = {
                            'name' : section_name,
                            'fields' : []
                        }
                    }

                    if ( 'checkbox' != field_type && 'html' != field_type && 'heading' != field_type ) {
                        field_html.push( '<h3>' + field_title + '</h3>' )
                    }
                    if ( field_desc ) {
                        field_html.push( '<small>' + field_desc + '</small>' )
                    }

                    switch( field_type ) {
                        case 'heading' :
                            field_html.push( '<h2>' + field.heading + '</h2>' )
                        break;

                        case 'text' :
                            field_html.push( '<input type="text" class="widget56__field__input" name="' + field_id + '" placeholder="' + field_placeholder + '" value="' + value + '" />' )
                        break;

                        case 'number' :
                            field_html.push( '<input type="number" class="widget56__field__input" name="' + field_id + '" value="' + value + '" />' )
                        break;

                        case 'html' :
                            field_html.push( value )
                        break;

                        case 'textarea' :
                            field_html.push( '<textarea class="widget56__field__input" name="' + field_id + '" placeholder="' + field_placeholder + '">' + value + '</textarea>' )
                        break;

                        case 'checkbox' :
                            var checked = true === value ? ' checked' : ''
                            field_html.push( '<label>' )
                            field_html.push( '<input class="widget56__field__input" type="checkbox" value="true" data-field-id="' + field_id + '"' + checked + ' />' + field_title )
                            field_html.push( '</label>' )
                        break;

                        case 'image' :
                            let value_src = widget_settings[ field_id + '__src' ]
                            if ( ! value_src ) {
                                value_src = ''
                            }
                            field_html.push( '<div class="uploader56">' )
                            field_html.push( '<div class="uploader56__image">' )
                            field_html.push( '<a class="uploader56__image__remove" title="Remove Image">&times;</a>' )
                            field_html.push( '</div>' )
                            field_html.push( '<input type="hidden" class="uploader56__result widget56__field__input" data-field-id="' + field_id + '" value="' + value + '" />' )
                            field_html.push( '<input type="hidden" class="uploader56__src" data-field-id="' + field_id + '__src" value="' + value_src + '" />' )
                            field_html.push( '<input type="button" class="uploader56__button button button-primary" value="Upload Image" />' )
                            field_html.push( '</div><!-- .uploader56 -->' )
                        break;

                        case 'multicheckbox' :

                            if ( ! value ) {
                                value = []
                            }
                            if ( typeof value === 'string' ) {
                                value = value.split(',')
                            }

                            for ( var k in field.options ) {

                                var checked = value.includes( k ) ? ' checked' : ''
                                field_html.push( '<label>' )
                                field_html.push( '<input class="widget56__field__input" type="checkbox" value="' + k + '" data-field-id="' + field_id + '"' + checked + ' />' + field.options[k] )
                                field_html.push( '</label>' )
                    
                            }

                        break;

                        case 'sortable' :
                            field_html.push( '<div class="sortable56">' )
                            field_html.push( '<div class="sortable56__table"><span class="sortable56__label">In use</span></div>' )
                            field_html.push( '<div class="sortable56__elements">' )
                            field_html.push( '<span class="sortable56__label">Not in use</span>' )
                            for ( var k in field.options  ) {
                                var v = field.options[k],
                                    name,
                                    display
                                if ( v.name ) {
                                    name = v.name
                                    display = v.display
                                } else {
                                    name = v
                                    display = 'block'
                                }
                                field_html.push( '<div class="sortable56__element sortable56__element--' + display + '" data-element="' + k + '">' + name + ' <span class="x">&times;</span></div>' )
                            }
                            field_html.push( '</div>' ) // sortable56__elements
                            field_html.push( '</div>' ) // sortable56

                            // console.log( value )

                            field_html.push( '<input type="hidden" class="widget56__field__input" value="' + value.join(',') + '" data-field-id="' + field_id +'" />' )
                        break;

                        case 'radio' :
                            for ( var option_key in field_options ) {
                                var option_value = field_options[ option_key ],
                                    checked = option_key == value ? ' checked' : ''
                                field_html.push( '<label><input type="radio" class="widget56__field__input" name="' + field_id + '" value="' + option_key + '"' + checked + ' />' + option_value + '</label>' )
                            }
                        break;

                        case 'radio_image' :
                            for ( var option_key in field_options ) {
                                var option_value = field_options[ option_key ],
                                    checked = option_key == value ? ' checked' : ''
                                field_html.push( '<label><input type="radio" class="widget56__field__input" name="' + field_id + '" value="' + option_key + '"' + checked + ' />' + '<img src="' + option_value + '" /></label>' )
                            }
                        break;

                        case 'select' :
                            var select = []
                            if ( field.multiple ) {
                                if ( ! Array.isArray( value ) ) {
                                    value = value.split( ',' )
                                }
                            } else {
                                value = [ value ]
                            }
                            for ( var option_key in field_options ) {
                                var option_value = field_options[ option_key ]
                                var selected = value.includes( option_key ) ? ' selected' : ''
                                select.push( '<option value="' + option_key + '"' + selected + '>' + option_value + '</option>' )
                            }
                            select = select.join( "\n" )
                            var multiple = field.multiple ? ' multiple' : ''
                            select = '<select class="widget56__field__input" name="' + field_id + '"' + multiple + '>' + select + '</select>'
                            field_html.push( select )
                        break;

                        case 'color' :
                            var colorpicker = []
                            colorpicker.push( '<div class="colorpicker56">' )
                            colorpicker.push( '<input type="hidden" class="widget56__field__input" value="' + value + '" name="' + field_id + '" />' )
                            colorpicker.push( '<span class="colorpicker56__button"></span>' )
                            colorpicker.push( '</div>' )
                            colorpicker = colorpicker.join( "\n" )
                            field_html.push( colorpicker )
                        break;

                        case 'group' :
                            var field_fields = field.fields,
                                group_html = []
                            for ( var field_field_id in field_fields ) {
                                var field_field = field_fields[ field_field_id ],
                                    field_field_col = field_field.col ? field_field.col : '1-1',
                                    field_field_placeholder = field_field.placeholder ? field_field.placeholder : '',
                                    field_field_value = value && value[ field_field_id ] ? value[ field_field_id ] : ''
                                group_html.push( '<div class="col col-' + field_field_col + ' col-' + field_field.type + '" data-subfield-id="' + field_field_id + '">' )
                                group_html.push( '<small>' + field_field.name + '</small>' )

                                switch( field_field.type ) {
                                    case 'text' :
                                        group_html.push( '<input type="text" class="widget56__field__input" placeholder="' + field_field_placeholder + '" value="' + field_field_value + '" data-group-id="' + field_field_id + '" />' )
                                    break
                                    case 'number' :
                                        group_html.push( '<input type="number" class="widget56__field__input" value="' + field_field_value + '" data-group-id="' + field_field_id + '" />' )
                                    break
                                    case 'color' :
                                        group_html.push( '<div class="colorpicker56">' )
                                        group_html.push( '<input type="hidden" class="widget56__field__input" value="' + field_field_value + '" data-group-id="' + field_field_id + '" />' )
                                        group_html.push( '<span class="colorpicker56__button"></span>' )
                                        group_html.push( '</div>' )
                                    break
                                    case 'select' :
                                        group_html.push( '<select class="widget56__field__input" data-group-id="' + field_field_id + '">' )
                                        for( var k in field_field.options ) {
                                            var selected = k == field_field_value ? ' selected' : ''
                                            group_html.push( '<option value="' + k + '"' + selected + '>' + field_field.options[k] + '</option>' )
                                        }
                                        group_html.push( '</select>' )
                                    break
                                }

                                group_html.push( '</div><!-- .col -->' )
                            }
                            group_html = group_html.join( "\n" )
                            group_html = '<div class="row">' + group_html + '</div>'
                            field_html.push( group_html )
                        break;

                    }

                    field_html = field_html.join( "\n" )
                    let cl = [ 'widget56__field', 'widget56__field--' + field_type ]
                    cl = cl.join( ' ' )
                    field_html = '<div class="' + cl + '" data-field="' + field_type + '" data-field-id="' + field_id + '">' + field_html + '</div>'

                    tabs[ tab ].sections[ section ].fields.push( field_html )

                }

                // now after collecting tabs + sections, we append
                var tabnav = []
                var tab_content = []
                var tab_active
                var active_cl = ''
                for ( var tab in tabs ) {
                    if ( undefined === tab_active ) {
                        tab_active = true
                    } else {
                        tab_active = false
                    }
                    if ( tab_active ) {
                        active_cl = ' active'
                    } else {
                        active_cl = ''
                    }
                    tabnav.push( '<span data-tab="' + tab + '" class="' + active_cl + '">' + tabs[tab].name + '</span>' )
                    var tab_sections = []
                    var section_active = null
                    var section_active_cl = ''
                    for ( var section in tabs[ tab].sections ) {
                        if ( null === section_active ) {
                            section_active = true
                        } else {
                            section_active = false
                        }
                        if ( section_active ) {
                            section_active_cl = ' active'
                        } else {
                            section_active_cl = ''
                        }
                        var section_fields = tabs[ tab].sections[ section ].fields,
                            section_content = section_fields.join( "\n" ),
                            section_name = tabs[ tab].sections[ section ].name
                        
                        var section_html = []
                        section_html.push( '<h2 class="widget56__section__heading"><i class="dashicons dashicons-arrow-right"></i><i class="dashicons dashicons-arrow-down"></i>' + section_name + '</h2>' )
                        section_html.push( '<div class="widget56__section__content">' + section_content + '</div>' )
                        section_html = section_html.join( "\n" )
                        section_html = '<div class="widget56__section' + section_active_cl + '">' + section_html + '</div>'

                        tab_sections.push( section_html )
                        
                    }
                    tab_sections = tab_sections.join( "\n" )
                    tab_sections = '<div class="tab-content' + active_cl + '" data-tab="' + tab + '">' + tab_sections + '</div>'
                    tab_content.push( tab_sections )
                }
                tab_content = tab_content.join( "\n" )
                tabnav = tabnav.join( "\n" )
                tabnav = '<div class="tabnav">' + tabnav + '</div>'

                widget_editor.append( tabnav + tab_content )

                $( document ).trigger( 'widget_editor_init' )

            } // end function populate fields

            /* tab
            ================================================================================ */
            $( document ).on(  'click', '.tabnav span', function( e ) {
                e.preventDefault()
                $( '.tabnav span' ).removeClass( 'active' )
                $( '.tab-content' ).removeClass( 'active' )
                var tab = $( this ).data( 'tab' )
                $( this ).addClass( 'active' )
                $( '.tab-content[data-tab="' + tab + '"]' ).addClass( 'active' )
            })

            /* toggle sections
            ================================================================================ */
            var inthemiddle = false
            $( document ).on(  'click', '.widget56__section__heading', function( e ) {
                e.preventDefault()
                if ( inthemiddle ) {
                    return
                }
                inthemiddle = true
                var section = $( this ).closest( '.widget56__section' ),
                    tab = section.closest( '.tab-content' )
                if ( section.hasClass( 'active' ) ) {
                    section.find('.widget56__section__content').slideUp( 'fast', 'swing', function() {
                        section.removeClass( 'active' )
                        inthemiddle = false
                    })
                } else {
                    var active_section = tab.find( '.widget56__section.active' )
                    active_section.find('.widget56__section__content').slideUp('fast','swing', function(){
                        active_section.removeClass( 'active' )
                        inthemiddle = false
                    })
                    section.find('.widget56__section__content').slideDown( 'fast', 'swing', function() {
                        section.addClass( 'active' )
                        inthemiddle = false
                    })
                }
            })

            /* UI
            ================================================================================ */
            let widget_editor_ui_reinit = function() {
                let widget_editor = $( '.widget56__editor' )

                /* field elements
                ------------------------------------------------------------------------ */
                widget_editor.find( '.widget56__field--color, .col-color' ).each(function(){
                    fox_colorpicker( $( this ) )
                });
                widget_editor.find( '.widget56__field--sortable' ).each( function() {
                    fox_sortable( $( this ) )
                })
                widget_editor.find( '.widget56__field--image' ).each(function(){
                    fox_image_upload( $( this ) )
                })

                widget_editor.find( '[data-group-id="face"]' ).each(function() {
                    font_ui( $( this ), '' )
                })
            }

            $( document ).on( 'widget_editor_init', widget_editor_ui_reinit )

            /* INPUT CHANGE
            ================================================================================ */
            var get_val = function( field ) {
                var field_type = field.data( 'field' ),
                    input = field.find( '.widget56__field__input' ),
                    val = null

                switch( field_type ) {
                    case 'text' :
                    case 'textarea' :
                    case 'number' :
                    case 'color' :
                    case 'image' :
                    case 'hidden' :
                        val = input.val()
                    break

                    case 'select' :
                        if ( field.find( 'select').attr( 'multiple' ) ) {
                            var collect = []
                            input.find( 'option' ).each(function() {
                                if ( $( this ).prop( 'selected') ) {
                                    collect.push( $( this ).val() )
                                }
                            })
                            val = collect
                        } else {
                            val = input.val()
                        }
                    break

                    case 'radio' :
                    case 'radio_image' :
                        var checked = field.find( '.widget56__field__input:checked' )
                        if ( checked.length ) {
                            val = checked.val()
                        }
                    break

                    case 'checkbox' :
                        val = input.prop( 'checked' )
                    break

                    case 'multicheckbox' :
                        var collect = []
                        input.each(function() {
                            if ( $( this ).prop( 'checked') ) {
                                collect.push( $( this ).val() )
                            }
                        })
                        val = collect
                    break

                    case 'group' :
                        var collect = {}
                        field.find( '.col' ).each(function() {
                            var subfield_input = $( this ).find( '.widget56__field__input' ),
                                sub_key = $( this ).data( 'subfield-id' ),
                                sub_value = subfield_input.val()
                            collect[ sub_key ] = sub_value    
                        })
                        val = collect
                    break

                    case 'sortable' :
                        val = input.val()
                        if ( ! val ) {
                            val = []
                        } else {
                            val = val.split(',')
                        }
                    break

                }

                return val

            }

            var get_val_src = function( field ) {
                var input = field.find( '.uploader56__src' ),
                    val = input.val()
                return val
            }

            $( document ).on( 'change', '.widget56__field__input', function() {
                let input = $( this ),
                    widget_editor = $( '.widget56__editor' ),
                    widget_id = widget_editor.data( 'widget_id' )
                if ( ! widget_id ) {
                    return
                }
                let widget = $( '.widget56[data-id="' + widget_id + '"]' )
                if ( ! widget.length ) {
                    return
                }

                let widget_settings = widget.data( 'settings' ),
                    widget_type = widget_settings.type,
                    field = input.closest( '.widget56__field' ),
                    field_id = field.data( 'field-id' )

                if ( ! widgets_info[ widget_type ] || ! widgets_info[ widget_type ].fields || ! widgets_info[ widget_type ].fields[ field_id ] ) {
                    console.error( 'why' )
                    return
                }

                let new_val = get_val( field )

                /**
                 * if this is css property, update builder css
                 */
                if ( widgets_info[ widget_settings.type ].fields[ field_id ].css ) {
                    var h__css = structuredClone( api( control.id + '__css' )() )
                    console.log( h__css )
                    // this is the 1st time we initialize this value
                    // we must set all DEFAULT values for it
                    if ( undefined === h__css[ widget_id ] ) {
                        h__css[ widget_id ] = {}
                        for ( var k in widgets_info[ widget_type ].fields ) {
                            let v = widgets_info[ widget_type ].fields[k]
                            if ( undefined === v.css || undefined === v.std ) {
                                continue
                            }
                            h__css[ widget_id ][ k ] = v.std
                        }
                    }
                    h__css[ widget_id ][ field_id ] = new_val
                    api( control.id + '__css' ).set( h__css )

                /**
                 * otherwise update the section
                 */
                } else {

                    let widget_settings_new = structuredClone( widget_settings )
                    widget_settings_new[ field_id ] = new_val
                    if ( 'image' == field.data( 'field' ) ) {
                        widget_settings_new[ field_id + '__src' ] = get_val_src( field )
                    }
                    widget.data( 'settings', widget_settings_new )

                    let section = widget.closest( '.widget56[data-widget="section"]' )
                    if ( ! section.length ) {
                        console.error( 'why' )
                        return
                    }
                    $( document ).trigger( 'section_changed', [ section ] )

                }

                /**
                 * affect the admin label
                 */
                if ( 'section' == widget_type && 'section_name' == field_id ) {
                    widget.find( '> .widget56__bar .widget56__title' ).text( new_val )
                }
                if ( 'column' == widget_type && 'size' == field_id ) {
                    let info = widgets_info.column.fields.size.options[ new_val ]
                    widget.find( '> .widget56__bar .widget56__info' ).text( info )
                }
                if ( 'heading' == widget_type && 'heading' == field_id ) {
                    widget.find( '> .widget56__bar .widget56__info' ).text( new_val )
                }
                
            })

            /* -------------------------------------------------------------------------------------------------- */
            /* -------------------------------------------------------------------------------------------------- */
            /* -------------------------------------------------------------------------------------------------- */

            // relationship with the preview screen

            /* -------------------------------------------------------------------------------------------------- */
            /* -------------------------------------------------------------------------------------------------- */
            /* -------------------------------------------------------------------------------------------------- */
            /* -------------------------------------------------------------------------------------------------- */
            /* click scroll to in previewer
             * there must be a correlation between those two
             * we find order in correlation with the section
            --------------------------------- */
            $( document ).on( 'click', '.widget56__bar', function( e ) {
                e.preventDefault()
                if ( $( e.target ).is( '.indicator' ) || $( e.target ).is( '.widget56__menu' ) || $( e.target ).closest( '.widget56__menu' ).length ) {
                    return
                }
                $( '.widget56__bar' ).removeClass( 'active' )
                $( this ).addClass( 'active' )
                // now scroll to
                var widget = $( this ).parent(),
                    widget_id = widget.data( 'id' )

                api.previewer.send( 'scroll', {
                    widget_id: widget_id,
                })
            })

            // edit button from frontend
            api.previewer.bind( 'edit_widget', function( widget_id ) {
                api.section( 'h2' ).focus()
                open_widget_editor( widget_id )
            })
            
            /* -------------------------------------------------------------------------------------------------- */
            /* -------------------------------------------------------------------------------------------------- */
            /* -------------------------------------------------------------------------------------------------- */
            /* -------------------------------------------------------------------------------------------------- */

            // export / import
            $( container ).on( 'click', '.widget56__dropdown span[data-action="export"]', function( e ) {

                if ( ! $('#downloadAnchorElem').length ) {
                    $( 'body' ).append( '<a id="downloadAnchorElem" style="display:none"></a>' )
                }

                var storageObj = {}

                var section = $( this ).closest( '.widget56[data-widget="section"]' ),
                    section_id = section.data( 'id' ),
                    section_css_id = section_id + '__css',
                    values = {
                        'refresh' : api( section_id )(),
                        'css': api( section_css_id )()
                    };
                    storageObj = values

                var name = values.css.section_name
                if ( ! name ) {
                    name = 'section'
                }

                var dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(storageObj));
                var dlAnchorElem = document.getElementById('downloadAnchorElem');
                dlAnchorElem.setAttribute("href",     dataStr     );
                dlAnchorElem.setAttribute( "download", name + ".json" );
                dlAnchorElem.click();

            })

            /* import json
            --------------------------------- */
            $( document ).on( 'click', '.builder56__toggle-import', function(e){
                e.preventDefault();
                $( '.builder56__import' ).toggle()
            })

            function onReaderLoad(event) {
                console.log(event.target.result);
                var json_values = JSON.parse(event.target.result);
                
                var new_section_id = generate_section_id()
                if ( ! new_section_id ) {
                    return;
                }
                run_new_section( new_section_id, {
                    values: json_values
                })
                update_sectionlist();
            }

            $( document ).on( 'change', '#builder56__import__file', function(e) {
                var reader = new FileReader();
                reader.onload = onReaderLoad;
                reader.readAsText(e.target.files[0]);
            })

		}

	});

    /**
     * documents about api
     * https://wordpress.stackexchange.com/questions/280561/customizer-instantiating-settings-and-controls-via-javascript
     * https://gist.github.com/westonruter/0e98d8e507ddb18c0371935f2c6929c1
     * 
     * lots of examples here: https://gist.github.com/westonruter
     */
    api.bind( 'ready', function() {

        /**
         * this is reload action when we add new section
         */
        api.bind( 'saved', function() {
            if ( window.shouldReload ) {
                location.reload()
            }
        });

        /**
         * section_css_id => CSS array
         */
        window.css = {}
        window.css_builder_structure = {}
        window.update_css = function() {
            
            /**
             * we have 2 sources for CSS: builder.fields and css from a normal element
             */
            _.each( api.settings.controls, function( option ) {
                
                if ( 'fox56_builder' == option.type ) {

                } else if ( option.css ) {
                    /**
                     * we need to send value as well
                     */
                    window.css[ option.settings.default ] = option.css
                } else {
                    return;
                }
            });

            api.previewer.bind( 'ready', function() {
                api.previewer.send( 'window_css', window.css )
            });

        }

        // onload
        update_css()

    });
    
})( jQuery, wp.customize );