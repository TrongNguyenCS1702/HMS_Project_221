$(".detail-btn").click(function(){
    const id = $(this).parent().find("input").val();

    $.ajax({
        url: "../admin/get_facilities.php?id=" + id,
        dataType: "json",
        success: function(resFaci){
            $("input[name='room']").val(resFaci.court + "-" +resFaci.room);
            $("input[name='created_by']").val(resFaci.created_by);
            $("textarea[name='description']").text(resFaci.description);
            $("input[name='status']").val(resFaci.status);
        }
    })
})