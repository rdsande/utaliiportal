(function ($) {
    'use strict';
    var body = $('body');

    $(document).ready(function () {
        setTimeout(function () {
            $('.tour-slider-wrapper ').each(function () {
                let t = $(this);
                var owl = $('.owl-carousel', t).owlCarousel({
                    center: true,
                    items: 1,
                    loop: true,
                    autoplay: true,
                    margin: 0,
                });
                $('.st-next', t).click(function (ev) {
                    ev.preventDefault();
                    owl.trigger('next.owl.carousel');
                })
                $('.st-pre', t).click(function (ev) {
                    ev.preventDefault();
                    owl.trigger('prev.owl.carousel');
                })

            });
        }, 100);
        //----------- Description Tour-------------------------------

        $('.st-description-more .stt-more').on('click', function () {

            $('.st-description-more').hide();
            $('.st-description-less').show();
        });
        $('.st-description-less .stt-less').on('click', function () {

            $('.st-description-less').hide();
            $('.st-description-more').show();
        });
        //----------- End Description Tour---------------------------
        //----------- Content Comment--------------------------------
        $('.comment-item').each(function () {
            let that = this;
            $('.st-comment-more .stt-more', that).on('click', function(e) {

                $('.st-comment-less', that).show();
                $('.st-comment-more', that).hide();
            })
        });
        $('.comment-item').each(function () {
            let that = this;
            $('.st-comment-less .stt-less', that).on('click', function(e) {

                $('.st-comment-more', that).show();
                $('.st-comment-less', that).hide();
            })
        });

        //----------- End Content Comment----------------------------
        //--------------- Guest Name Inputs -------------------------

        var adultNumber = $('.form-has-guest-name .adult_number');
        var childrenNumber = $('.form-has-guest-name .child_number');
        var infantNumber = $('.form-has-guest-name .infant_number');
        var guestNameInput = $('.form-has-guest-name .guest_name_input');
        adultNumber.on('change',triggerGuestInputChange);
        childrenNumber.on('change',triggerGuestInputChange);
        infantNumber.on('change',triggerGuestInputChange);

        function triggerGuestInputChange(e) {
            guestNameInput.trigger('guest-change', {
                'adult': parseInt(adultNumber.val()),
                'children': parseInt(childrenNumber.val()),
                'infant': parseInt(infantNumber.val())
            });
        };

        guestNameInput.on('guest-change',function(e,number){
            var adult = number.adult;
            var children = number.children;
            var infant = number.infant;
            var hideAdult  = $(this).data('hide-adult');
            var hideChildren  = $(this).data('hide-children');
            var hideInfant  = $(this).data('hide-infant');
            var controlWraps = $(this).find('.guest_name_control');
            var controls = controlWraps.find('.control-item');
            if(isNaN(infant)) infant=0;
            if(isNaN(children)) children=0;

            if(hideAdult=='on'){
                adult = 0;
            }

            if(typeof hideChildren=='undefined' || hideChildren!='on') adult += children;
            if(typeof hideInfant=='undefined' ||  hideInfant!='on') adult += infant;

            //adult-=1;// Only input guest >=2 name

            if(adult<=0){
                $(this).addClass('hidden');
            }else{
                // Append
                for(var i = controls.length?(controls.length):0;i<adult;i++)
                {
                    var div = $($('#guest_name_control_item').clone().html());
                    var p = div.find('input').attr('placeholder');
                    div.find('input').attr('placeholder',p.replace('%d',i+1));

                    controlWraps.append(div);
                }

                // Remove
                controls.each(function () {
                    if($(this).index() > adult -1)
                    {
                        $(this).remove();
                    }
                });

                $(this).removeClass('hidden');
            }
        });

        triggerGuestInputChange();
        //------------------End Guest Name Inputs -------------------
    })
})(jQuery);