$(".detail-btn").click(function(){
    const id = $(this).parent().find("input").val();

    $.ajax({
        url: "../admin/get_student.php?id=" + id,
        dataType: "json",
        success: function(resStudent){
            console.log(resStudent)
            $("input[name='ssn']").val(resStudent.ssn);
            $("input[name='name']").val(resStudent.lastname + " " + resStudent.firstname);
            $("input[name='gender']").val(resStudent.gender);
            $("input[name='birthday']").val(resStudent.birthday);
            $("input[name='country']").val(resStudent.country);
            $("input[name='phone']").val(resStudent.phone);
            $("input[name='email']").val(resStudent.email);
            $("input[name='address']").val(resStudent.address);
            $("input[name='username']").val(resStudent.username);
            $("input[name='password']").val(resStudent.password);
            $("input[name='room']").val(resStudent.name + "-" + resStudent.room_number);
            $("input[name='year']").val(resStudent.year);
            $("input[name='university']").val(resStudent.university);
            $("input[name='status']").val(resStudent.s_status + ": " + resStudent.start_date + " - " + resStudent.end_date);
            $("input[name='student_id']").val(resStudent.student_id);
            $("input[name='created_at']").val(resStudent.s_created_at);

        }
    })
})

$(".room-btn").click(function(){
    $(this).parent().children("div").toggle();
    $(this).toggle();
    $(this).toggleClass('col-xl-3');

    if ($(this).hasClass('col-xl-3')) {
        $("#room__table_wrapper").remove();

    }

    else  {
        const id = $(this).find("input").val();

        $.ajax({
            url: "../admin/getAllRoomsByCourt.php?court=" + id,
            dataType: "json",
            success: function(resRooms){

                let roomContent ="";
                let count = 1;
                $.each(resRooms, function(i, room) {
                    let roomItem = `
                    <tr>
                        <td>${count}</td>
                        <td>${room['room_number']}</td>
                        <td>${room['type']}</td>
                        <td>${numberWithCommas(room['fee'])}</td>
                        <td>${room['status']}</td>
                        <td>${room['updated_at']}</td>
                        <td>
                            <a class='edit-btn btn btn-warning' href='./update_room.php?id=${room['id']}'>
                                <i class='ti-settings'></i>
                            </a>
                            <a class='delete-btn btn btn-danger' href='./delete_room.php?id=${room['id']}'>
                                <i class='ti-close'></i>
                            </a>
                        </td>
                    </tr>
                    `;

                    count++;
                    roomContent+=roomItem;
                })

                const roomTable = `
                                    <table id="room__table"
                                            class="table table table-striped table-hover table-bordered no-wrap">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope='col'>#</th>
                                                    <th scope='col'>Room</th>
                                                    <th scope='col'>Type</th>
                                                    <th scope='col'>Fee</th>
                                                    <th scope='col'>Status</th>
                                                    <th scope='col'>Updated At</th>
                                                    <th scope='col'>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                ${roomContent}
                                            </tbody>

                                        </table>
                `;

                $(".room-container").append(roomTable);
                $("#room__table").DataTable();
            }
        })
    }
})


function numberWithCommas(x) {
    return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
}