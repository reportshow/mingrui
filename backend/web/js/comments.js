$(".comment-line [act='delete']").click(function() {
    var $cid = $(this).attr('cid');
    var $url = '?r=comments/delete&comment_id=' + $cid;
    $.ajax({
        type: "GET",
        url: $url,
        dataType: "json",
        success: function(data, textStatus) {
        	var cid = data.delete;
            $(".comment-line[cid='" + $cid + "']").fadeOut();
        },
        error: function() {}
    });
});