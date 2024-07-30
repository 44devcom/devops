/**
 * @since 1.0
 * https://jscolor.com/docs/#doc-install-add-data-jscolor
 */
( function( $, api ) {

    var css = {};

    // this is common
    window.close_widget_editor = function() {
        if ( undefined === window.widget_editor ) {
            window.widget_editor = $( '.widget56__editor' )
        }
        if ( undefined === window.widget_editor_bar ) {
            window.widget_editor_bar = $( '.widget56__editor__bar' )
        }
        window.widget_editor.removeClass( 'showing' )
        window.widget_editor_bar.removeClass( 'showing' )
        $( 'body' ).removeClass( 'openning-widget56' )
    }

    /**
     * select: jQuery('select')
     * set up font array for it when we select it
     * ========================================================================================
     */
    window.font_ui = function( select, std ) {

        if ( std.indexOf( '"' ) >= 0 ) {
            std = std.replaceAll( '"', '' )
        } else if ( std.indexOf( "'" ) >= 0 ) {
            std = std.replaceAll( "'", '' )
        }

        var selected_option = select.find( 'option[value="' + std + '"]' );
        if ( selected_option.length ) {
            selected_option.prop( 'selected', true )
        } else {
            select.append( '<option value="' + std + '" selected>' + std + '</option>' )
        }

        select.on( 'click', function() {
            if ( select.data( 'google_fonts_init' ) ) {
                return;
            }
            var data = []
            select.find( 'option' ).each(function() {
                data.push({
                    id: $( this ).val(),
                    text: $( this ).text()
                })
            })
            if ( ! window.google_fonts ) {
                window.google_fonts = []
                $.getJSON( FOX_CUSTOMIZE.google_fonts_json_url, function(jd) {
                    for ( var item of jd.items ) {
                        window.google_fonts.push( item.family )
                        if ( std != item.family ) {
                            data.push({
                                id: item.family,
                                text: item.family,
                            })
                        }
                    }
                    select.data( 'google_fonts_init', true )
                    select.select2({
                        data: data
                    }).select2('open');
                });
            } else {
                for ( var face of window.google_fonts ) {
                    if ( std != face ) {
                        data.push({
                            id: face,
                            text: face,
                        })
                    }
                }
                select.data( 'google_fonts_init', true )
                select.select2({
                    data: data
                }).select2('open');
            }

        })

        // if this change, it must be clicked before, ie. the google fonts must be loaded before
        // api.previewer.bind( 'ready',function(){

            /**
             * ON CHANGE LOAD FONTS
             */
            select.on( 'change', function() {

                var face = select.val()
                if ( ! window.google_fonts.includes( face ) ) {
                    return;
                }
                api.previewer.send( 'load-font', face )

            })

        // });

    }

    /**
     * COLOR PICKER
     * container is selector
     * ========================================================================================
     */
    window.fox_colorpicker = function( container ) {
        var div = container.find( '.colorpicker56' ),
            input = div.find( 'input[type="hidden"]' ),
            btn = div.find( '.colorpicker56__button' )

        btn.css('background',input.val())

        var pickr = new Pickr({
            default: input.val() ? input.val() : '#42445a',
            el: btn.get(0),
            theme: 'nano',
            swatches: [
                '#D0021B',
                '#F5A623',
                '#f8e61b',
                '#8B572A',
                '#7ED321',
                '#417505',
                '#BD10E0',
                '#9013FE',
                '#4A90E2',
                '#50E3C2',
                '#B8E986',
                '#000000',
                '#4A4A4A',
                '#9B9B9B'
            ],
            components: {
        
                // Main components
                palette: true,
                preview: true,
                opacity: true,
                hue: true,
        
                // Input / output Options
                interaction: {
                    input: true,
                    clear: true,
                }
            },
            useAsButton: true,
        });
        pickr.on( 'change', function( color, source, instance ) {
            var hex_color = color.toHEXA().toString()
            input.val( hex_color )
            btn.css('background', hex_color )    
            input.trigger('change')
        });
        pickr.on( 'clear', function( color, source, instance ) {
            input.val('')
            btn.css('background', '' )    
            input.trigger('change')
        });
    }

    /**
     * IMAGE
     * ========================================================================================
     */
    window.fox_image_upload = function( container ) {

        // on init
        var input_src = container.find( '.uploader56__src' ),
            holder = container.find( '.uploader56__image' )
        if ( ! holder.find( 'img' ).length && input_src.length ) {
            var src = input_src.val()
            if ( src ) {
                holder.prepend( '<img src="' + src + '" />' )
            }
        }

        container.on( 'click', '.uploader56__button', function( e ) {
            e.preventDefault()
            var button = $( this ),
                wrapper = button.closest( '.uploader56' ),
                holder = wrapper.find( '.uploader56__image' ),
                input = wrapper.find( '.uploader56__result' ) // this holds the key
                input_src = wrapper.find( '.uploader56__src' ) // this is image src, we'll use for many purposes

            // Extend the wp.media object
            var mediaUploader = wp.media.frames.file_frame = wp.media({
                title: 'Choose Image',
                button: {
                    text: 'Choose Image',
                }, 
                multiple: false,
                library : {
                    type : 'image',
                },
            });
            if ( ! mediaUploader ) {
                console.error( 'cant load the media uploader' )
                return
            }

            // When a file is selected, grab the URL and set it as the text field's value
            mediaUploader.on('select', function() {
                
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                if ( ! attachment.type == 'image' ) {
                    return;
                }
                input.val( attachment.id )
                holder.find('img').remove();
                if ( attachment.sizes.medium ) {
                    holder.prepend( '<img src="' + attachment.sizes.medium.url + '" />' );
                } else {
                    holder.prepend( '<img src="' + attachment.url + '" />' );
                }
                if ( input_src.length ) {
                    input_src.val( attachment.url )
                }

                // we must trigger change AFTER input_src has been set
                input.trigger('change')
                    
                if ( button.is( 'button' ) ) {
                    button.text( 'Change Image' );
                } else {
                    button.val( 'Change Image' );
                }
            });
            
            // Open the uploader dialog
            mediaUploader.open();
        
        });

        // REMOVE THE IMAGE
        container.on( 'click', '.uploader56__image__remove', function( e ) {
            e.preventDefault()
            var wrapper = $( this ).closest( '.uploader56' ),
                holder = wrapper.find( '.uploader56__image' ),
                input = wrapper.find( 'input[type="hidden"]' ) // this holds the key
            if ( holder.find( 'img' ).length ) {
                holder.find( 'img' ).remove()
            }
            input.val( '' ).trigger( 'change' )
        })

    }

    /**
     * SORTABLE
     * ========================================================================================
     */
    window.fox_sortable = function( container ) {

        var table = container.find( '.sortable56__table' ),
            input = container.find( 'input[type="hidden"]' ),
            value = input.val()
        if ( typeof value === 'string' ) {
            value = value.split(',')
        }

        var update_result = function() {
            let result = []
            container.find( '.sortable56__table .sortable56__element' ).each(function(){
                result.push( $( this ).data('element'))
            })
            // set value via input
            input.val( result.join( ',' ) ).trigger( 'change' )
        }    

        /** ---      sortable */
        container.find( '.sortable56__table, .sortable56__elements' ).sortable({
            items : '.sortable56__element',
            placeholder: "sortable-placeholder",
            connectWith: container.find( '.sortable56__table, .sortable56__elements' ),
            update: function( event, ui ) {
                // thank to https://stackoverflow.com/questions/3492828/jquery-sortable-connectwith-calls-the-update-method-twice
                if (this === ui.item.parent()[0]) {
                    update_result();
                }
            },
        });

        /* --- when remove by close button */
        container.on( 'click', '.sortable56__element .x', function( e ) {
            e.preventDefault()
            $( this ).parent().appendTo( container.find( '.sortable56__elements' ) );
            update_result();
        });

        /** ---      init */
        if ( typeof value !== 'object' ) {
            value = []
        }
        for ( var ele of value ) {
            var get_ele = container.find( '.sortable56__element[data-element="' + ele + '"]' )
            if ( ! get_ele.length ) {
                continue
            }
            get_ele.appendTo( table )
        }

    }

    /**
     * FONTS
     * ====================================================================================
     */
    api.controlConstructor.fox56_fonts = api.Control.extend({
        ready: function() {
            var control = this,
                container = this.container,
                setting_name = control.id,
                value = control.setting()

            $( container ).on( 'fox_init', function() {
                font_ui( $( container ).find( 'select' ), value )
            });
            
        }
    })

    /**
     * MULTICHECKBOX
     * ====================================================================================
     */
    api.controlConstructor.fox56_multicheckbox = api.Control.extend({
        ready: function() {
            var control = this,
                container = this.container,
                setting_name = control.id,
                value = control.setting()

            if ( typeof value !== 'object' ) {
                value = []
            }
            // init
            for ( var k of value ) {
                $( container ).find( 'input[type="checkbox"][value="' + k + '"]' ).prop( 'checked', true )
            }

            // on change
            $( container ).on( 'change', 'input[type="checkbox"]', function() {
                var result = []
                $( container ).find( 'input[type="checkbox"]:checked' ).each(function(){
                    result.push( $( this ).val() )
                })
                control.setting.set( result )
            })
        }
    })

    /**
     * SORTABLE
     * ====================================================================================
     */
    api.controlConstructor.sortable = api.Control.extend({
        ready: function() {
            var control = this,
                container = this.container,
                value = control.setting(),
                table = $( container ).find( '.sortable56__table' )

            var update_result = function() {
                result = []
                $( container ).find( '.sortable56__table .sortable56__element' ).each(function(){
                    result.push( $( this ).data('element'))
                })
                control.setting.set( result )
            }    

            $( container ).on( 'fox_init', function() {

                /** ----------------------------      sortable */
                $( container ).find( '.sortable56__table, .sortable56__elements' ).sortable({
                    items : '.sortable56__element',
                    placeholder: "sortable-placeholder",
                    connectWith: $( container ).find( '.sortable56__table, .sortable56__elements' ),
                    update: function( event, ui ) {
                        update_result();
                    },
                });

                /* --- when remove by close button */
                container.on( 'click', '.sortable56__element .x', function( e ) {
                    e.preventDefault()
                    $( this ).parent().appendTo( container.find( '.sortable56__elements' ) )
                    update_result();
                });

                /** ----------------------------      init */
                if ( typeof value !== 'object' ) {
                    value = []
                }

                if( Array.isArray(value) ) {
                    for ( var ele of value ) {
                        var get_ele = $( container ).find( '.sortable56__element[data-element="' + ele + '"]' )
                        if ( ! get_ele.length ) {
                            continue
                        }
                        get_ele.appendTo( table )
                    }
                }
            })
            
        }
    })

    /**
     * RADIO IMAGE
     * ====================================================================================
     */
    api.controlConstructor.fox56_radio_image = api.Control.extend({
        ready: function() {
            var control = this,
                container = this.container,
                setting_name = control.id,
                value = control.setting()

            $( container ).on( 'fox_init', function() {
                // just set value on init
                var should_checked = $( container ).find( 'input[type="radio"][value="' + value + '"]' )
                if ( should_checked.length ) {
                    should_checked.prop('checked', true)
                }
            });

        },
    });

    /**
     * IMAGE
     * ====================================================================================
     */
    api.controlConstructor.fox56_image = api.Control.extend({
        ready: function() {
            var control = this,
                container = this.container,
                setting_name = control.id,
                value = control.setting()

            $( container ).on( 'fox_init', function() {    
                fox_image_upload( $( container ) )    
            });
        }
    })

    /**
     * COLOR
     * ====================================================================================
     */
    api.controlConstructor.fox56_color = api.Control.extend({
        ready: function() {
            var control = this,
                container = this.container,
                setting_name = control.id,
                value = control.setting()
        
            $( container ).on( 'fox_init', function() {    
                fox_colorpicker( $( container ) )
            });
        },
    });

    /**
     * GROUP
     * ====================================================================================
     */
    api.controlConstructor.group = api.Control.extend({
        ready: function() {
            var control = this,
                container = this.container,
                setting_name = control.id,
                value = control.setting()

            /**
             * -------------------------    UPDATE INPUT CORRECTLY WHEN SETTING BEING CHANGED
             */    
            control.setting.bind( function( newval ) {
                $( container ).find( '[data-group-id]' ).each(function(){
                    var key = $( this ).data( 'group-id' )
                    if ( undefined === newval[key] ) {
                        newval[key] = ''
                    }
                    $( this ).val( newval[key] )
                });
            })

            $( container ).on( 'fox_init', function() {    
                /**
                 * -------------------------    POPULATE DATA CORRECTLY
                 */
                $( container ).find( '[data-group-id]' ).each(function(){
                    var key = $( this ).data( 'group-id' )
                    if ( undefined === value[key] ) {
                        value[key] = ''
                    }
                    $( this ).val( value[key] )
                });
                
                /**
                 * FONT FACE PROBLEM 
                 */
                $( container ).find( '[data-group-id="face"]' ).each(function() {
                    var select = $( this )
                    font_ui( select, value.face )
                });

                /**
                 * -------------------------    COLOR PICKER
                 */
                $( container ).find( '.group56__item--color' ).each(function() {
                    fox_colorpicker( $( this ) )
                });

                /**
                 * -------------------------    IMAGE UPLOADER
                 */
                $( container ).find( '.group56__item--image' ).each(function() {
                    fox_image_upload( $( this ) )
                });

                /**
                 * -------------------------    UPDATE VALUE ON INPUT CHANGE
                 */
                var sum = function() {
                    var data = {}
                    $( container ).find( '[data-group-id]' ).each(function(){
                        var key = $( this ).data( 'group-id' )
                        data[key] = $( this ).val()
                    })
                    api( setting_name ).set( data )
                }
                $( container ).on( 'change', '[data-group-id]', function() {
                    sum()
                });

            });

        }

    })

    /**
     * CONDITIONAL
     * ====================================================================================
     */
    api.bind( 'ready', function() {

        var reverse_conditional = {}
        for ( var setting_name in FOX_CUSTOMIZE.conditional ) {
            var condition = FOX_CUSTOMIZE.conditional[ setting_name ]
            for ( var source_setting in condition ) {
                if ( undefined === reverse_conditional[ source_setting ] ) {
                    reverse_conditional[ source_setting ] = []
                }
            }
            reverse_conditional[ source_setting ].push( setting_name )
        }
        
        // check all of its conditions
        var set_visibility = function( setting_name ) {
            var condition = FOX_CUSTOMIZE.conditional[ setting_name ]
            if ( ! condition ) {
                return;
            }
            // only show if all conditionns held
            var hold = true
            for ( var source_setting in condition ) {
                var expected_value = condition[ source_setting ],
                    value = api( source_setting )()
                if ( typeof expected_value == 'object' ) {
                    if ( ! expected_value.includes( value ) ) {
                        hold = false
                        break; // 1 is enough
                    }
                } else {
                    if ( expected_value !== value ) {
                        hold = false
                        break; // 1 is enough
                    }
                }
            }
            if ( hold ) {
                if ( ! api.control( setting_name ) ) {
                    console.log( setting_name )
                }
                api.control( setting_name ).container.removeClass( 'hide--condition' )
            } else {
                api.control( setting_name ).container.addClass( 'hide--condition' )
            }
        }

        /**
         * set it in 1st place
         */
        for ( var setting_name in FOX_CUSTOMIZE.conditional ) {
            set_visibility( setting_name )
        }

        /**
         * bind changes
         */
        for ( var setting_name in reverse_conditional ) {
            api( setting_name, function( value ) {
                value.bind( function( newval ) {
                    for ( var affected_id of reverse_conditional[ value.id ] ) {
                        set_visibility( affected_id )
                    }
                })
            })
        }

	});

    /**
     * STD AFFECTS
     * ====================================================================================
     */
    api.bind( 'ready', function() {

        // setting_name = layout
        // std_affects_arr = grid: { column: .. , post_style: .., postbox: }, list: { column, post_style }
        // newval: grid, list
        for ( var setting_name in FOX_CUSTOMIZE.std_affects ) {
            api( setting_name, function( value ) {
                value.bind( function( newval ) {
                    var std_affects_arr = FOX_CUSTOMIZE.std_affects[ value.id ];
                    if ( undefined === std_affects_arr ) {
                        return;
                    }
                    for ( var k in std_affects_arr ) {
                        var v = std_affects_arr[ k ]
                        if ( undefined === v[ newval ] ) {
                            continue
                        }
                        api( k ).set( v[ newval ] )
                    }
                })
            })
        }

	});

    /**
     * TABS
     * ====================================================================================
     */
    api.bind( 'ready', function() {

        var tabs_update = function( tabs, tab ) {
            var affected_settings = []
            for ( var tabkey in FOX_CUSTOMIZE.tabs[ tabs ] ) {
                if ( undefined === FOX_CUSTOMIZE.tabs[tabs][ tabkey ] ) {
                    FOX_CUSTOMIZE.tabs[tabs][ tabkey ] = []
                }
                affected_settings = affected_settings.concat( FOX_CUSTOMIZE.tabs[tabs][ tabkey ] )
            }
            for ( var affected_setting of affected_settings ) {
                if ( FOX_CUSTOMIZE.tabs[tabs][ tab ].includes( affected_setting ) ) {
                    api.control( affected_setting ).container.removeClass( 'hide--innertab' )
                } else {
                    api.control( affected_setting ).container.addClass( 'hide--innertab' )
                }
            }
        }

        // on init
        for ( var tabs in FOX_CUSTOMIZE.tabs ) {
            // active the first one
            var tab_active = FOX_CUSTOMIZE.tabs[ tabs ].tab_active
            if ( ! tab_active ) {
                continue
            }
            delete FOX_CUSTOMIZE.tabs[ tabs ].tab_active
            tabs_update( tabs, tab_active )
        }
        $( '.tabs56' ).on( 'click', 'a', function(e) {
            e.preventDefault()
            var a = $( this ),
                tab = a.data( 'tab' ),
                tabs_wrapper = a.closest( '.tabs56' ),
                tabs = tabs_wrapper.data( 'tabs' )

            tabs_wrapper.find('a').removeClass('active')    
            a.addClass('active')
            tabs_update( tabs, tab )
        })
        
    });

    /**
     * init things only on section open
     */
    var time = Date.now()
    api.bind( 'ready', function() {
        api.section.each( function ( section ) {
            
            section.expanded.bind( function( isExpanding ) {
                if(isExpanding) {
                    if ( ! $( section.contentContainer ).data( 'fox_section_init' ) ) {
                        $( section.contentContainer ).trigger( 'fox_section_init' )
                        $( section.contentContainer ).data( 'fox_section_init', true )
                    }
                    $( section.contentContainer ).find( '.customize-control' ).each(function(){
                        var li = $( this )
                        if ( ! li.data( 'fox_init' ) ) {
                            li.data( 'fox_init', true )
                            li.trigger( 'fox_init' )
                        }
                    })
                }
            });

            $( section.contentContainer ).on( 'fox_section_init', function() {
                $( section.contentContainer ).find( '.hastip' ).tooltipster({});
            })

        });
    })

    /**
     * HINTs
     * ====================================================================================
     */
    api.bind( 'ready', function() {

        $( '#customize-header-actions' ).append( '<input type="search" placeholder="Search option.." class="goto" tabindex="1" onfocus="this.select()" />' );

        var swap = function( json ) {
            var ret = {};
            for(var key in json){
            ret[json[key]] = key;
            }
            return ret;
        }

        var hintlist = {}
        for ( var id in api.settings.controls ) {
            if ( id.substring( 0, 7 ) == 'widget_' ) {
                continue
            }
            var label = api.settings.controls[ id ].hint
            if ( ! label ) {
                label = api.settings.controls[ id ].label
            }
            if ( ! label ) {
                label = api.settings.controls[ id ].heading
            }
            if ( ! label ) {
                continue;
            }
            hintlist[ id ] = label.toLowerCase()
        }

        var goto_input = $( '.goto' ),
            keywords = Object.values( hintlist ),
            hint_reverse = swap( hintlist ),
            args = {
                minLength: 1,
                delay: 0,
                autoFocus: false,
                select: function( event, ui ) {
                    
                    if ( hint_reverse[ ui.item.value ] ) {

                        window.close_widget_editor()
                        
                        setTimeout( function(){
                            // go to the option
                            api.control( hint_reverse[ ui.item.value ] ).focus()
                        }, 120 )
                        
                        // reset the text
                        this.value = "";
                        return false;
                        
                    }
                    
                },
                classes: {
                    "ui-autocomplete": "blah"
                }
            }
        
        args.source = keywords

        goto_input.autocomplete( args )
        
        // cmd F bind
        window.onkeydown = function( event ) {
            
            if((event.ctrlKey || event.metaKey) && event.which == 70) {
                event.preventDefault();
                
                goto_input.focus()
            }
            
        }

    });
    
})( jQuery, wp.customize );