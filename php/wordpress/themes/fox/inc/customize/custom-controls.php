<?php
if ( ! class_exists( 'WP_Customize_Control' ) ) {
    return;
}

/* BUILDER
================================================================================================ */
$wp_customize->register_control_type( 'Fox56_Builder_Control' );

class Fox56_Builder_Control extends WP_Customize_Control {

    public $type = 'fox56_builder';

    public function content_template() {
        $fields = [];
?>
<div class="builder56" data-id="{{ data.id }}">

    <div class="hidden hide builder-sectionlist">
        <select multiple data-customize-setting-key-link="{{ data.settings.sectionlist }}">
        </select>
    </div>

    <?php /*
    <div class="builder56__actions">

        <a href="#" class="builder56__add-section button button-primary">Add Section +</a>
        
        <a href="#" class="button builder56__toggle-import">Import Template</a>

        <label class="builder56__import">
            <span><?php echo esc_html( 'Upload *json file', 'wi' ); ?></span>
            <input type="file" name="builder56__import__file" id="builder56__import__file">
        </label>

    </div><!-- .builder56__actions --> */ ?>

    <div class="builder56__sections"></div><!-- .builder56__sections -->

    <a href="#" class="widget56__btn builder56__add-section"><i class="dashicons dashicons-plus-alt2"></i> Add Section</a>

    <div class="widget56 widget56--placeholder">
        <div class="widget56__bar">
            <i class="indicator dashicons dashicons-arrow-right-alt2"></i>
            <span class="widget56__icon"></span>

            <span class="widget56__bar__text" title="Click to Edit this">
                <span class="widget56__title"></span>
                <span class="widget56__info"></span>
            </span>

            <span class="widget56__action" data-action="duplicate" title="Duplicate"><i class="dashicons dashicons-image-rotate-right"></i></span>
            <span class="widget56__action" data-action="delete" title="Delete"><i class="dashicons dashicons-trash"></i></span>

        </div><!-- .widget56__bar -->
        <div class="widget56__content"></div>
    </div><!-- .widget56 -->

    <div class="widget56__editor__bar">
        <span class="widget56__editor__bar__close">
            <i class="dashicons dashicons-arrow-left-alt2"></i>
        </span>
        <h2 class="widget56__editor__bar__title"></h2>
        <a class="widget56__editor__export" href="#">
            Export
            <i class="dashicons dashicons-download"></i>
        </a>
    </div>
    <div class="widget56__editor"></div>

</div>
        
    <?php
    }

    function field_content_template() {
        ?>

    <# var data_change = undefined === field.css ? 'refresh' : 'css';
    if ( 'builder' == field.refresh ) {
        data_change = 'builder';
    }
    #>    

    <?php /* -------------------------------------      text  */ ?>
    <# if ( field.type == 'text' ) { #>

    <input type="text" placeholder="{{ field.placeholder }}" value="{{ field.std }}" data-field-id="{{ field_id }}" data-change="{{ data_change }}" />

    <?php /* -------------------------------------      number  */ ?>
    <# } else if ( field.type == 'number' ) { #>

    <input type="number" placeholder="{{ field.placeholder }}" value="{{ field.std }}" data-field-id="{{ field_id }}" min="{{ field.min }}" max="{{ field.max }}" step="{{ field.step }}" data-change="{{ data_change }}" />

    <?php /* -------------------------------------      textarea  */ ?>
    <# } else if ( field.type == 'textarea' ) { #>

    <textarea placeholder="{{ field.placeholder }}" data-field-id="{{ field_id }}" data-change="{{ data_change }}">{{ field.std }}</textarea>

    <?php /* -------------------------------------      checkbox  */ ?>
    <# } else if ( field.type == 'checkbox' ) { #>

    <label>
        <input type="checkbox" value="true" data-field-id="{{ field_id }}" data-change="{{ data_change }}" />
        {{ field.name }}
    </label>

    <?php /* -------------------------------------      select  */ ?>
    <# } else if ( field.type == 'select' || field.type == 'multiselect' ) {
        var multiple_attr = 'multiselect' == field.type ? ' multiple' : ''
        #>

        <select {{ multiple_attr }} data-field-id="{{ field_id }}" data-change="{{ data_change }}">

            <# for ( var k in field.options ) { #>

            <option value="{{ k }}">{{ field.options[k] }}</option>

            <# } #>
        </select>
        <# if ( 'multiselect' == field.type ) { #>
        <small class="use-hint">Hold Ctrl (Windows) or Command (MacOS) for multi-select</small>
        <# } #>

    <?php /* -------------------------------------      radio  */ ?>
    <# } else if ( field.type == 'radio' ) { #>

        <# for ( var k in field.options ) {
            #>

        <label>
            <input type="radio" name="{{ data.id }}[section__placeholder][{{ field_id }}]" value="{{ k }}" data-field-id="{{ field_id }}" data-change="{{ data_change }}" />
            {{ field.options[k] }}
        </label>

        <# } #>

    <?php /* -------------------------------------      multicheckbox  */ ?>
    <# } else if ( field.type == 'multicheckbox' ) { #>

        <# for ( var k in field.options ) { #>

            <label>
                <input type="checkbox" value="{{ k }}" data-field-id="{{ field_id }}" data-change="{{ data_change }}" />
                {{ field.options[k] }}
            </label>

        <# } #>

    <?php /* -------------------------------------      sortable  */ ?>    
    <# } else if ( field.type == 'sortable' ) { #>

        <div class="sortable56">
            <div class="sortable56__table">
                <span class="sortable56__label">In use</span>
            </div>
            <div class="sortable56__elements">
                <span class="sortable56__label">Not in use</span>
                <# for ( var k in field.options  ) {
                    v = field.options[k]
                    if ( v.name ) {
                        name = v.name
                        display = v.display
                    } else {
                        name = v
                        display = 'block'
                    }
                    #>
                <div class="sortable56__element sortable56__element--{{ display }}" data-element="{{ k }}">{{ name }} <span class="x">&times;</span></div>
                <# } #>
            </div>
        </div>

        <input type="hidden" value="{{ field.std }}" data-field-id="{{ field_id }}" data-change="{{ data_change }}" />

    <?php /* -------------------------------------      image  */ ?>

    <# } else if ( 'image' == field.type ) { #>

    <div class="uploader56">

        <div class="uploader56__image">
            <?php /* the image should goes here */ ?>
            <a class="uploader56__image__remove" title="Remove Image">&times;</a>
        </div>
        <input type="hidden" class="uploader56__result" data-field-id="{{ field_id }}" data-change="{{ data_change }}" />
        <input type="hidden" class="uploader56__src" data-field-id="{{ field_id }}__src" data-change="{{ data_change }}" />
        <input type="button" class="uploader56__button button button-primary" value="Upload Image" />

    </div><!-- .uploader56 -->

    <?php /* -------------------------------------      color  */ ?>
    <# } else if ( 'color' == field.type ) { #>

        <div class="colorpicker56">
            <input type="hidden" value="{{ field.std }}" data-field-id="{{ field_id }}" data-change="{{ data_change }}" />
            <span class="colorpicker56__button"></span>
        </div>

    <?php /* -------------------------------------      radio_image  */ ?>
    <# } else if ( 'radio_image' == field.type ) { #>

        <# for ( var k in field.options ) {
            v = field.options[k]
            if ( typeof v === 'string' ) {
                img = '<img src="' + v + '" />'
            } else {
                img = '<img src="' + v.src + '" style="width:' + v.width +'px" />'
            }
            #>

        <label>
            <input type="radio" name="{{ data.id }}[section__placeholder][{{ field_id }}]" value="{{ k }}" data-field-id="{{ field_id }}" data-change="{{ data_change }}" />
            {{{ img }}}
        </label>

        <# } #>

    <?php /* -------------------------------------      html  */ ?>
    <# } else if ( 'html' == field.type ) { #>

        {{{ field.std }}}

    <?php /* -------------------------------------      GROUP  */ ?>
    <# } else if ( 'group' == field.type ) {
        
        subfields = field.fields
        if ( ! subfields ) {
            subfields = {}
        }
        if ( ! field.std ) {
            field.std = {}
        }
        #>
        <div class="section56__field__group row">
        <# for ( var sub_id in subfields ) {
            var subfield = subfields[sub_id]
            if ( ! subfield.col ) {
                subfield.col = '1-1'
            }
            #>
            <div class="col col-{{ subfield.col }} section56__field__group__item section56__field__group__item--{{ subfield.type }}">
                <small>{{ subfield.name }}</small>
                <# if ( 'text' == subfield.type ) { #>
                <input type="text" placeholder="{{ subfield.placeholder }}" value="{{ field.std[sub_id] }}" data-group-id="{{ sub_id }}" data-change="{{ data_change }}" />

                <# } else if ( 'number' == subfield.type ) { #>
                <input type="number" value="{{ field.std[sub_id] }}" data-group-id="{{ sub_id }}" min="{{ subfield.min }}" max="{{ subfield.max }}" step="{{ subfield.step }}" data-change="{{ data_change }}" />

                <# } else if ( 'color' == subfield.type ) { #>
                
                <div class="colorpicker56">
                    <input type="hidden" value="{{ field.std[sub_id] }}" data-group-id="{{ sub_id }}" data-change="{{ data_change }}" />
                    <span class="colorpicker56__button"></span>
                </div>

                <# } else if ( 'select' == subfield.type ) { #>
                <select data-group-id="{{ sub_id }}" data-change="{{ data_change }}">
                    <# if ( undefined !== subfield.options[''] ) { #>
                    <option value="">{{ subfield.options[''] }}</option>
                    <# } #>
                    <# for ( var k in subfield.options ) { if ( '' === k ) { continue; } #>
                    <option value="{{ k }}">{{ subfield.options[k] }}</option>
                    <# } #>
                </select>
                <# } #>
            </div>
        <# } #>    
        </div>

        <input type="hidden" data-field-id="{{ field_id }}" data-change="{{ data_change }}" />

    <# } #>

        <?php
    }

}

/* GENERAL CLASS
================================================================================================ */
class Fox56_Control extends WP_Customize_Control {
    public function content_template()
    {
        ?>
        <# if ( data.heading ) { #>
        <h2 class="sep--customizer">{{{ data.heading }}}</h2>
        <# } #>

        <# if ( data.msg_before ) { #>
            <div class="sep--message">{{{ data.msg_before }}}</div>
        <# } #>

        <# if ( data.label ) { #>
        <label class="customize-control-label">    
            <span class="customize-control-title">{{{ data.label }}}</span>
        </label>
        <# } #>

        <# if ( data.description ) { #>
            <span class="description">{{{ data.description }}}</span>
        <# } #>

        <?php $this->js_content(); ?>

        <# if ( data.msg ) { #>
            <div class="sep--message">{{{ data.msg }}}</div>
        <# } #>
        <?php
    }
    function js_content() {}
}

/* GROUP
================================================================================================ */
$wp_customize->register_control_type( 'Fox56_Group_Control' );

class Fox56_Group_Control extends Fox56_Control {

    public $type = 'group';
    function js_content() {
?>
    <# 
        subfields = data.fields
        if ( ! subfields ) {
            subfields = {}
        }
        if ( ! data.std ) {
            data.std = {}
        }
        #>
        <input type="hidden" data-customize-setting-link="default" />
        <div class="group56 row">
        <# for ( var sub_id in subfields ) {
            var subfield = subfields[sub_id]
            if ( ! subfield.col ) {
                subfield.col = '1-1'
            }
            #>
            <div class="col col-{{ subfield.col }} group56__item group56__item--{{ subfield.type }}">
                <small>{{ subfield.name }}</small>
                <# if ( 'text' == subfield.type ) { #>
                <input type="text" placeholder="{{ subfield.placeholder }}" value="{{ data.std[sub_id] }}" data-group-id="{{ sub_id }}" />

                <# } else if ( 'number' == subfield.type ) { #>
                <input type="number" value="{{ data.std[sub_id] }}" data-group-id="{{ sub_id }}" min="{{ subfield.min }}" max="{{ subfield.max }}" step="{{ subfield.step }}" />

                <# } else if ( 'color' == subfield.type ) { #>

                <div class="colorpicker56">
                    <input type="hidden" value="{{ data.std[sub_id] }}" data-group-id="{{ sub_id }}" />
                    <span class="colorpicker56__button"></span>
                </div>

                <# } else if ( 'image' == subfield.type ) { #>

                <div class="uploader56">

                    <div class="uploader56__image">
                        <?php /* the image should goes here */ ?>
                        <a class="uploader56__image__remove" title="Remove Image">&times;</a>
                    </div>
                    <input type="hidden" class="uploader56__result" data-group-id="{{ sub_id }}" />
                    <input type="hidden" class="uploader56__src" data-group-id="{{ sub_id }}__src" value="{{ subfield.src }}" />
                    <input type="button" class="uploader56__button button button-primary" value="Upload Image" />

                </div><!-- .uploader56 -->

                <# } else if ( 'select' == subfield.type ) { #>
                <select data-group-id="{{ sub_id }}">
                    <# if ( undefined !== subfield.options[''] ) { #>
                    <option value="">{{ subfield.options[''] }}</option>
                    <# } #>

                    <# for ( var k in subfield.options ) { if ( '' === k ) { continue; } #>
                    <option value="{{ k }}">{{ subfield.options[k] }}</option>
                    <# } #>
                </select>
                <# } #>
            </div>
        <# } #>    
        </div>
<?php
    }

}

/* HEADING
================================================================================================ */
$wp_customize->register_control_type( 'Fox56_Heading_Control' );

class Fox56_Heading_Control extends WP_Customize_Control {

    public $type = 'fox56_heading';

    public function content_template()
    {
        ?>
        <h2 class="sep--customizer">{{ data.heading }}</h2>
        <?php
    }

}

/* HTML
================================================================================================ */
$wp_customize->register_control_type( 'Fox56_HTML_Control' );

class Fox56_HTML_Control extends WP_Customize_Control {

    public $type = 'fox56_html';

    public function content_template()
    {
        ?>
        {{{ data.html }}}
        <?php
    }

}

/* IMAGE CONTROL
================================================================================================ */
$wp_customize->register_control_type( 'Fox56_Image_Control' );

class Fox56_Image_Control extends Fox56_Control {

    public $type = 'fox56_image';

    public function js_content()
    {
        ?>

        <div class="uploader56">

            <div class="uploader56__image">
                {{{ data.image }}}
                <a class="uploader56__image__remove" title="Remove Image">&times;</a>
            </div>
            <input type="hidden" class="uploader56__result" data-customize-setting-link="{{ data.settings.default }}" />
            <input type="button" class="uploader56__button button button-primary" value="Upload Image" />

        </div><!-- .uploader56 -->

        <?php
    }

}

/* RADIO IMAGE
================================================================================================ */
$wp_customize->register_control_type( 'Fox56_Radio_Image_Control' );

class Fox56_Radio_Image_Control extends Fox56_Control {

    public $type = 'fox56_radio_image';

    public function js_content()
    {
        ?>
        <# for ( var k in data.choices ) {
            v = data.choices[k]
            if ( typeof v === 'string' ) {
                img = '<img src="' + v + '" />'
            } else {
                img = '<img src="' + v.src + '" style="width:' + v.width +'px" />'
            }
            #>

        <label>
            <input type="radio" name="{{ data.settings.default }}" value="{{ k }}" data-customize-setting-link="{{ data.settings.default }}" />
            {{{ img }}}
        </label>

        <# } #>

        <?php
    }

}

/* COLOR CONTROL
================================================================================================ */
$wp_customize->register_control_type( 'Fox56_Color_Control' );

class Fox56_Color_Control extends Fox56_Control {

    public $type = 'fox56_color';

    public function js_content()
    {
        ?>

        <div class="colorpicker56">
            <input type="hidden" data-customize-setting-link="{{ data.settings.default }}" />
            <span class="colorpicker56__button"></span>
        </div>

        <?php
    }

}

/* SORTABLE
================================================================================================ */
$wp_customize->register_control_type( 'Fox56_Sortable_Control' );
class Fox56_Sortable_Control extends Fox56_Control {

    public $type = 'sortable';

    public function js_content()
    {
        ?>
        <div class="sortable56">
            <div class="sortable56__table">
                <span class="sortable56__label">In use</span>
            </div>
            <div class="sortable56__elements">
                <span class="sortable56__label">Not in use</span>
                <# for ( var k in data.choices  ) { #>
                <div class="sortable56__element" data-element="{{ k }}">{{ data.choices[k] }} <span class="x">&times;</span></div>
                <# } #>
            </div>
        </div>

        <?php
    }

}

/* MULTICHECKBOX
================================================================================================ */
$wp_customize->register_control_type( 'Fox56_Multicheckbox_Control' );
class Fox56_Multicheckbox_Control extends Fox56_Control {

    public $type = 'fox56_multicheckbox';

    public function js_content()
    {
        ?>
        <div class="multichecbox56">
            <# for ( var k in data.choices  ) { #>
            <label>
                <input type="checkbox" value="{{ k }}" />
                {{ data.choices[k] }}
            </label>
            <# } #>
        </div>

        <?php
    }

}

/* GOOGLE FONT SELECT
================================================================================================ */
$wp_customize->register_control_type( 'Fox56_Fonts_Control' );

class Fox56_Fonts_Control extends Fox56_Control {

    public $type = 'fox56_fonts';

    public function js_content()
    {
        ?>
        <div class="fonts56">
            <select data-customize-setting-link="{{ data.settings.default }}">
            <# for ( var k in data.choices ) { #>
                <option value="{{ k }}">{{ data.choices[k] }}</option>
            <# } #>
            </select>
        </div>

        <?php
    }

}

/* TEXTAREA
================================================================================================ */
$wp_customize->register_control_type( 'Fox56_Textarea' );

class Fox56_Textarea extends Fox56_Control {

    public $type = 'fox56_textarea';

    public function js_content()
    {
        ?>
        <textarea data-customize-setting-link="{{ data.settings.default }}" rows="5" placeholder="{{ data.placeholder }}"></textarea>
        <?php
    }

}

/* TEXT
================================================================================================ */
$wp_customize->register_control_type( 'Fox56_Text' );

class Fox56_Text extends Fox56_Control {

    public $type = 'fox56_text';

    public function js_content()
    {
        ?>
        <input type="text" placeholder="{{ data.placeholder }}" data-customize-setting-link="{{ data.settings.default }}" />
        <?php
    }

}

/* NUMBER
================================================================================================ */
$wp_customize->register_control_type( 'Fox56_Number' );

class Fox56_Number extends Fox56_Control {

    public $type = 'fox56_number';

    public function js_content()
    {
        ?>
        <input type="number" min="{{ data.min }}" max="{{ data.max }}" step="{{ data.step }}" data-customize-setting-link="{{ data.settings.default }}" />
        <?php
    }

}

/* CHECKBOX
================================================================================================ */
$wp_customize->register_control_type( 'Fox56_Checkbox' );

class Fox56_Checkbox extends Fox56_Control {

    public $type = 'fox56_checkbox';

    public function js_content()
    {
        ?>
        <input type="checkbox" data-customize-setting-link="{{ data.settings.default }}" />
        <?php
    }

}

/* SELECT
================================================================================================ */
$wp_customize->register_control_type( 'Fox56_Select' );

class Fox56_Select extends Fox56_Control {

    public $type = 'fox56_select';

    public function js_content()
    {
        ?>
        <# if ( data.multiple ) { multiple = ' multiple' } else { multiple = '' } #>

        <select data-customize-setting-link="{{ data.settings.default }}"{{ multiple }}>
            <# for ( var k in data.choices ) { #>
                <option value="{{ k }}">{{ data.choices[k] }}</option>
            <# } #>
        </select>
        
        <?php
    }

}

/* RADIO
================================================================================================ */
$wp_customize->register_control_type( 'Fox56_Radio' );

class Fox56_Radio extends Fox56_Control {

    public $type = 'fox56_radio';

    public function js_content() {
        ?>
        <# for ( var k in data.choices ) { #>
        <label>
            <input type="radio" data-customize-setting-link="{{ data.settings.default }}" name="{{ data.settings.default }}" value="{{ k }}" />
            {{ data.choices[k] }}
        </label>
        <# } #>
        
        <?php
    }

}