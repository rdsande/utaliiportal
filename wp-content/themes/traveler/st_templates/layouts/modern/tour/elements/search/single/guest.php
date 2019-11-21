<?php
$start = STInput::post('check_in', date(TravelHelper::getDateFormat()));
$end = STInput::post('check_out', date(TravelHelper::getDateFormat(), strtotime("+ 1 day")));
$adult_number = STInput::post('adult_number', 0);
$child_number = STInput::post('child_number', 0);
$infant_number = STInput::post('infant_number', 0);
$tour_guest_adult = st()->get_option('tour_guest_adult', 'Age 18+');
if (isset($tour_guest_adult) && !empty($tour_guest_adult)) {
    $tour_guest_adult = st()->get_option('tour_guest_adult', 'Age 18+');
} else {
    $tour_guest_adult = __('Age 18+', ST_TEXTDOMAIN);
}

$tour_guest_childrent = st()->get_option('tour_guest_childrent', 'Age 6-17');
if (isset($tour_guest_childrent) && !empty($tour_guest_childrent)) {
    $tour_guest_childrent = $tour_guest_childrent;
} else {
    $tour_guest_childrent = __('Age 6-17', ST_TEXTDOMAIN);
}
$tour_guest_infant = st()->get_option('tour_guest_infant', 'Age 0-5');
if (isset($tour_guest_infant) && !empty($tour_guest_infant)) {
    $tour_guest_infant = $tour_guest_infant;
} else {
    $tour_guest_infant = __('Age 0-5', ST_TEXTDOMAIN);
}
$max_people = get_post_meta(get_the_ID(), 'max_people', true);
if (empty($max_people) or $max_people <= 0)
    $max_people = 20;
$has_icon = (isset($has_icon)) ? $has_icon : false;

$hide_adult = get_post_meta(get_the_ID(), 'hide_adult_in_booking_form', true);
$hide_children = get_post_meta(get_the_ID(), 'hide_children_in_booking_form', true);
$hide_infant = get_post_meta(get_the_ID(), 'hide_infant_in_booking_form', true);
?>

<div class="form-group form-guest-search clearfix <?php if ($has_icon) echo ' has-icon '; ?>">
    <?php
    if ($has_icon) {
        echo TravelHelper::getNewIcon('ico_calendar_search_box');
    }
    ?>
    <?php if ($hide_adult != 'on'): ?>
        <div class="guest-wrapper clearfix">
            <div class="check-in-wrapper">
                <label><?php echo __('Adults', ST_TEXTDOMAIN); ?></label>
                <div class="render"><?php echo sprintf(__('%s', ST_TEXTDOMAIN), $tour_guest_adult); ?></div>
            </div>
            <div class="select-wrapper">
                <div class="st-number-wrapper">
                    <input type="text" name="adult_number" value="<?php echo esc_html($adult_number); ?>"
                           class="form-control st-input-number adult_number" autocomplete="off" readonly
                           data-min="0" data-max="<?php echo esc_attr($max_people); ?>"/>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if ($hide_children != 'on'): ?>
        <div class="guest-wrapper clearfix">
            <div class="check-in-wrapper">
                <label><?php echo __('Children', ST_TEXTDOMAIN); ?></label>
                <div class="render"><?php echo sprintf(__('%s', ST_TEXTDOMAIN), $tour_guest_childrent); ?></div>
            </div>
            <div class="select-wrapper">
                <div class="st-number-wrapper">
                    <input type="text" name="child_number" value="<?php echo esc_html($child_number); ?>"
                           class="form-control st-input-number child_number" autocomplete="off" readonly data-min="0"
                           data-max="<?php echo $max_people; ?>"/>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if ($hide_infant != 'on'): ?>
        <div class="guest-wrapper clearfix">
            <div class="check-in-wrapper">
                <label><?php echo __('Infant', ST_TEXTDOMAIN); ?></label>
                <div class="render"><?php echo sprintf(__('%s', ST_TEXTDOMAIN), $tour_guest_infant); ?></div>
            </div>
            <div class="select-wrapper">
                <div class="st-number-wrapper">
                    <input type="text" name="infant_number" value="<?php echo $infant_number; ?>"
                           class="form-control st-input-number infant_number" autocomplete="off" readonly data-min="0"
                           data-max="<?php echo $max_people; ?>"/>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<div class="guest_name_input hidden "
     data-placeholder="<?php echo esc_html__('Guest %d name', ST_TEXTDOMAIN) ?>"
     data-hide-adult="<?php echo get_post_meta(get_the_ID(), 'disable_adult_name', true) ?>"
     data-hide-children="<?php echo get_post_meta(get_the_ID(), 'disable_children_name', true) ?>"
     data-hide-infant="<?php echo get_post_meta(get_the_ID(), 'disable_infant_name', true) ?>">
    <label><span><?php echo esc_html__('Guest Name', ST_TEXTDOMAIN) ?></span> <span class="required">*</span></label>
    <div class="guest_name_control">
        <?php
        $controls = STInput::request('guest_name');
        $guest_titles = STInput::request('guest_title');
        if (!empty($controls) and is_array($controls)) {
            foreach ($controls as $k => $control) {
                ?>
                <div class="control-item mb10">
                    <select name="guest_title[]" class="form-control">
                        <option value="mr" <?php selected('mr', isset($guest_titles[$k]) ? $guest_titles[$k] : '') ?>><?php echo esc_html__('Mr', ST_TEXTDOMAIN) ?></option>
                        <option value="miss" <?php selected('miss', isset($guest_titles[$k]) ? $guest_titles[$k] : '') ?> ><?php echo esc_html__('Miss', ST_TEXTDOMAIN) ?></option>
                        <option value="mrs" <?php selected('mrs', isset($guest_titles[$k]) ? $guest_titles[$k] : '') ?>><?php echo esc_html__('Mrs', ST_TEXTDOMAIN) ?></option>
                    </select>
                    <?php printf('<input class="form-control " placeholder="%s" name="guest_name[]" value="%s">', sprintf(esc_html__('Guest %d name', ST_TEXTDOMAIN), $k + 2), esc_attr($control)); ?>
                </div>
                <?php
            }
        }
        ?>
    </div>
    <script type="text/html" id="guest_name_control_item">
        <div class="control-item mb10">
            <select name="guest_title[]" class="form-control">
                <option value="mr"><?php echo esc_html__('Mr', ST_TEXTDOMAIN) ?></option>
                <option value="miss"><?php echo esc_html__('Miss', ST_TEXTDOMAIN) ?></option>
                <option value="mrs"><?php echo esc_html__('Mrs', ST_TEXTDOMAIN) ?></option>
            </select>
            <?php printf('<input class="form-control " placeholder="%s" name="guest_name[]" value="">', esc_html__('Guest  name', ST_TEXTDOMAIN)); ?>
        </div>
    </script>
</div>
<input type="hidden" name="adult_price" id="adult_price">
<input type="hidden" name="child_price" id="child_price">
<input type="hidden" name="infant_price" id="infant_price">