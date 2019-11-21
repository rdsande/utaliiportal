<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 13-11-2018
 * Time: 8:27 AM
 * Since: 1.0.0
 * Updated: 1.0.0
 */
if (!is_user_logged_in()) {
    ?>
    <div class="modal fade" id="st-forgot-form" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document" style="max-width: 450px;">
            <div class="modal-content">
                <?php echo st()->load_template('layouts/modern/common/loader'); ?>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <?php echo TravelHelper::getNewIcon('Ico_close') ?>
                    </button>
                    <h4 class="modal-title"><?php echo __('Reset Password', ST_TEXTDOMAIN) ?></h4>
                </div>
                <div class="modal-body">
                    <form action="" class="form" method="post">
                        <input type="hidden" name="st_theme_style" value="modern"/>
                        <input type="hidden" name="action" value="st_reset_password">
                        <p class="c-grey f14">
                            <?php echo __('Enter the e-mail address associated with the account.', ST_TEXTDOMAIN) ?>
                            <br/>
                            <?php echo __('We\'ll e-mail a link to reset your password.', ST_TEXTDOMAIN) ?>
                        </p>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email"
                                   placeholder="<?php echo esc_html__('Email', ST_TEXTDOMAIN) ?>">
                            <?php echo TravelHelper::getNewIcon('ico_email_login_form'); ?>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="form-submit"
                                   value="<?php echo esc_html__('Send Reset Link', ST_TEXTDOMAIN) ?>">
                        </div>
                        <div class="message-wrapper mt20"></div>
                        <div class="text-center mt20">
                            <a href="" class="st-link font-medium open-login"
                               data-toggle="modal"><?php echo esc_html__('Back to Log In', ST_TEXTDOMAIN) ?></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <li class="topbar-item login-item">
        <a href="" class="login" data-toggle="modal"
           data-target="#st-login-form"><?php echo esc_html__('Login', ST_TEXTDOMAIN) ?></a>
    </li>
 
    <li class="topbar-item signup-item">
        <a href="" class="signup" data-toggle="modal"
           data-target="#st-register-form"><?php echo esc_html__('Sign Up', ST_TEXTDOMAIN) ?></a>
    </li>
    <script>

        jQuery(document).ready(function ($) {

            var startApp = function () {
                var key = st_social_params.google_client_id;
                gapi.load('auth2', function () {
                    auth2 = gapi.auth2.init({
                        client_id: key,
                        cookiepolicy: 'single_host_origin',
                    });
                    attachSignin(document.getElementById('st-google-signin2'));
                    attachSignin(document.getElementById('st-google-signin3'));
                });
            };

            if (typeof window.gapi != 'undefined') {
                startApp();
            }

            function attachSignin(element) {
                auth2.attachClickHandler(element, {},
                    function (googleUser) {
                        var profile = googleUser.getBasicProfile();
                        startLoginWithGoogle(profile);

                    }, function (error) {
                        console.log(JSON.stringify(error, undefined, 2));
                    });
            }

            function startLoginWithGoogle(profile) {
                if (typeof window.gapi.auth2 == 'undefined') return;
                sendLoginData({
                    'channel': 'google',
                    'userid': profile.getId(),
                    'username': profile.getName(),
                    'useremail': profile.getEmail(),
                });
            }

            function startLoginWithFacebook(btn) {
                btn.addClass('loading');

                FB.getLoginStatus(function (response) {
                    if (response.status === 'connected') {
                        sendLoginData({
                            'channel': 'facebook',
                            'access_token': response.authResponse.accessToken
                        });

                    } else {
                        FB.login(function (response) {
                            if (response.authResponse) {
                                sendLoginData({
                                    'channel': 'facebook',
                                    'access_token': response.authResponse.accessToken
                                });

                            } else {
                                alert('User cancelled login or did not fully authorize.');
                            }
                        }, {
                            scope: 'email',
                            return_scopes: true
                        });
                    }
                });
            }

            function sendLoginData(data) {
                data._s = st_params._s;
                data.action = 'traveler.socialLogin';

                $.ajax({
                    data: data,
                    type: 'post',
                    dataType: 'json',
                    url: st_params.ajax_url,
                    success: function (rs) {
                        handleSocialLoginResult(rs);
                    },
                    error: function (e) {

                        alert('Can not login. Please try again later');
                    }
                })
            }

            function handleSocialLoginResult(rs) {
                if (rs.reload) window.location.reload();
                if (rs.message) alert(rs.message);
            }

            $('.st_login_social_link').on('click', function () {
                var channel = $(this).data('channel');

                switch (channel) {
                    case "facebook":
                        startLoginWithFacebook($(this));
                        break;
                }
            })

            /* Fix social login popup */
            function popupwindow(url, title, w, h) {
                var left = (screen.width / 2) - (w / 2);
                var top  = (screen.height / 2) - (h / 2);
                return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
            }

            $('.st_login_social_link').on('click', function () {
                var href = $(this).attr('href');
                popupwindow(href, '', 600, 450);
                return false;
            });
            /* End fix social login popup */
        })
    </script>
    <?php
} else {
    $userdata = wp_get_current_user();
    $account_dashboard = st()->get_option('page_my_account_dashboard');
    ?>
    <li class="dropdown dropdown-user-dashboard">
        <?php
        if (!empty($in_header)) {
            echo st_get_profile_avatar($userdata->ID, 40);
        }
        ?>
        <a href="javascript: void(0);" data-toggle="dropdown" aria-haspopup="true"
           aria-expanded="false">
            <?php echo __('Hi, ', ST_TEXTDOMAIN) . TravelHelper::get_username($userdata->ID); ?>
            <i class="fa fa-angle-down"></i>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="<?php echo esc_url(get_the_permalink($account_dashboard)) ?>"><?php echo __('Dashboard', ST_TEXTDOMAIN) ?></a>
            </li>
            <li>
                <a href="<?php echo add_query_arg('sc', 'booking-history', get_the_permalink($account_dashboard)) ?>"><?php echo __('Booking History', ST_TEXTDOMAIN) ?></a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="<?php echo wp_logout_url() ?>"><?php echo __('Log out', ST_TEXTDOMAIN) ?></a>
            </li>
        </ul>
    </li>
    <?php
}

