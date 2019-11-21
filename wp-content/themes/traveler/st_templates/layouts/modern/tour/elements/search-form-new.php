<?php
$result_page = st()->get_option('tours_search_result_page');
?>
<div class="search-form-wrapper auto-height-form-search normal  st-search-form-st_tours st-search-form-tour">
    <div class="container">

        <div class=" tour-search-form-home style2">
            <div class="search-form">
                <form action="<?php echo esc_url(get_the_permalink($result_page)); ?>" class="form" method="get">

                    <?php echo st()->load_template('layouts/modern/tour/elements/search-new/location', '', ['has_icon' => true]); ?>
                    <?php echo st()->load_template('layouts/modern/tour/elements/search-new/date', '', ['has_icon' => true]); ?>
                    <?php echo st()->load_template('layouts/modern/tour/elements/search-new/guest', '', ['has_icon' => true]); ?>
                    <div class="form-button-new ">

                        <button class="btn btn-primary btn-search"
                                type="submit"><?php echo esc_html__('Search', ST_TEXTDOMAIN); ?></button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>