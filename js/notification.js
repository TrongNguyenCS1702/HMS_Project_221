function validateTitle(){

}

$(".edit-btn").click(function(){
    const id = $(this).parent().find("input").val();

    $.ajax({
        url: "../admin/get_notification.php?id=" + id,
        dataType: "json",
        success: function(resNoti){
            $("input[name='noti_id']").val(id);
            $("input[name='title']").val(resNoti.title);
            $("textarea[name='description']").text(resNoti.description);
        }
    })
})

$(".detail-btn").click(function(){
    const id = $(this).parent().find("input").val();

    $.ajax({
        url: "../admin/get_notification.php?id=" + id,
        dataType: "json",
        success: function(resNoti){
            $("input[name='title']").val(resNoti.title);
            $("textarea[name='description']").text(resNoti.description);
        }
    })
})