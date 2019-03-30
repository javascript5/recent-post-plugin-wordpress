jQuery(document).ready(function () {
    jQuery(".post_filter").on('change', function () {
        var postFilterValue = jQuery(this).val();

        if(postFilterValue == "more"){
            jQuery(".post_item").each(function () {
                jQuery(this).css({ "display": "flex" });
                repeatAnimationPostItem();
                jQuery(this).removeClass('bounceOut');
            });
        }else{
            jQuery(".post_item").each(function () {
                var postAttr = jQuery(this).attr("category");

                if (postFilterValue == postAttr) {
                    jQuery(this).css({ "display": "flex" });
                    repeatAnimationPostItem();
                    jQuery(this).removeClass('bounceOut');
                } else {
                    jQuery(this).addClass('bounceOut');
                    repeatAnimationPostItem();
                    jQuery(this).delay(2000).css({ "display": "none" });
                }
            });
        }
    });
    jQuery('.list_button').addClass('grid_list_button_acitved');
    jQuery('.list_button').click(function () {
        jQuery('.post_item').removeClass('bounceIn');
        jQuery('.post_item').addClass("list_item");
        jQuery('.post_item').removeClass("grid_item");
        jQuery('.post_item').removeClass("bounceIn").addClass("bounceIn");
        repeatAnimationPostItem();
        jQuery('.read_more_button > a > button').removeClass("readmore_grid_button");
        jQuery(this).addClass('grid_list_button_acitved');
        jQuery('.grid_button').removeClass('grid_list_button_acitved');

    });
    jQuery('.grid_button').click(function () {
        jQuery('.post_item').removeClass("list_item");
        jQuery('.post_item').addClass("grid_item");
        jQuery('.post_item').removeClass("bounceIn").addClass("bounceIn");
        repeatAnimationPostItem();
        jQuery('.read_more_button > a > button').each(function(){
            jQuery(this).addClass("readmore_grid_button");
        })
        jQuery(this).addClass('grid_list_button_acitved');
        jQuery('.list_button').removeClass('grid_list_button_acitved');
    });


    function repeatAnimationPostItem(){
        jQuery('.post_item').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function (e) {
            jQuery('.post_item').removeClass('bounceIn');
        });
    
        jQuery('.post_item').removeClass('bounceIn').addClass('bounceIn');
    }
});