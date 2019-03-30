$('document').ready(function () {
    $(".post_filter").on('change', function () {
        var postFilterValue = $(this).val();

        if(postFilterValue == "more"){
            $(".post_item").each(function () {
                $(this).css({ "display": "flex" });
            });
        }else{
            $(".post_item").each(function () {
                var postAttr = $(this).attr("category");

                if (postFilterValue == postAttr) {
                    $(this).css({ "display": "flex" });
                } else {
                    $(this).css({ "display": "none" });
                }
            });
        }
    });

    $('.list_button').click(function () {
        $('.post_item').addClass("list_item");
        $('.post_item').removeClass("grid_item");
    });
    $('.grid_button').click(function () {
        $('.post_item').removeClass("list_item");
        $('.post_item').addClass("grid_item");
    });
});