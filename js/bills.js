$(".edit-btn").click(function(){
    const id = $(this).parent().find("input").val();

    $.ajax({
        url: "../admin/get_bill.php?id=" + id,
        dataType: "json",
        success: function(resBill){
            $("input[name='title']").val(resBill.title);
            $("input[name='time']").val(resBill.time);
            $("input[name='bill']").val(resBill.bill);
            $("input[name='note']").val(resBill.note);
        }
    })
})

$(".detail-btn").click(function(){
    const id = $(this).parent().find("input").val();

    $.ajax({
        url: "../admin/get_bill.php?id=" + id,
        dataType: "json",
        success: function(resBill){
            $("input[name='title']").val(resBill.title);
            $("input[name='time']").val(resBill.time);
            $("input[name='bill']").val(resBill.bill);
            $("input[name='note']").val(resBill.note);
        }
    })
})