function validateName(element) {
    var value = element.value;
    var message = element.nextElementSibling;

    if (value.length < 4) {
        message.innerHTML = `${element.placeholder} ít nhất 4 ký tự`;
        message.style.color = '#ff4136';
    }

    else {
        message.innerHTML = "Hợp lệ";
        message.style.color ='#198754';
    }
}

function validateSSN(element) {
    var value = element.value;
    var message = element.nextElementSibling;

    if (value.length != 12) {
        message.innerHTML = `${element.placeholder} có 12 số`;
        message.style.color = '#ff4136';

    }

    else {
        message.innerHTML = "Hợp lệ";
        message.style.color ='#198754';

    }
}

function validateCountry(element) {
    var value = element.value;
    var message = element.nextElementSibling;

    if (value.length < 2) {
        message.innerHTML = `${element.placeholder} cần được nhập chính xác`;
        message.style.color = '#ff4136';

    }

    else {
        message.innerHTML = "Hợp lệ";
        message.style.color ='#198754';

    }
}

function validatePhone(element) {
    var value = element.value;
    var message = element.nextElementSibling;

    if (value.length != 10) {
        message.innerHTML = `${element.placeholder} có 10 số`;
        message.style.color = '#ff4136';

    }

    else {
        message.innerHTML = "Hợp lệ";
        message.style.color ='#198754';

    }
}


function validateEmail(element) {
    var value = element.value;
    var message = element.nextElementSibling;
    var validation = value.match(
        /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
      );
    if (!validation) {
        message.innerHTML = `${element.placeholder} không hợp lệ`;
        message.style.color = '#ff4136';

    }

    else {
        message.innerHTML = "Hợp lệ";
        message.style.color ='#198754';

    }
}

function validateUsername(element) {
    var value = element.value;
    var message = element.nextElementSibling;

    if (value.length < 6) {
        message.innerHTML = `${element.placeholder} có 6 ký tự trở lên`;
        message.style.color = '#ff4136';

    }

    else {
        message.innerHTML = "Hợp lệ";
        message.style.color ='#198754';

    }
}

function validatePassword(element) {
    var value = element.value;
    var message = element.nextElementSibling;

    if (value.length < 6) {
        message.innerHTML = `${element.placeholder} có 6 ký tự trở lên`;
        message.style.color = '#ff4136';

    }

    else {
        message.innerHTML = "Hợp lệ";
        message.style.color ='#198754';

    }
}

$(".detail-btn").click(function(){
    const id = $(this).parent().find("input").val();

    $.ajax({
        url: "../admin/get_user.php?id=" + id,
        dataType: "json",
        success: function(resUser){
            $("input[name='ssn']").val(resUser.ssn);
            $("input[name='name']").val(resUser.lastname + " " + resUser.firstname);
            $("input[name='gender']").filter(`[value=${resUser.gender}]`).prop('checked', true);;
            $("input[name='birthday']").val(resUser.birthday);
            $("input[name='country']").val(resUser.country);
            $("input[name='phone']").val(resUser.phone);
            $("input[name='email']").val(resUser.email);
            $("input[name='role']").val(resUser.role);
            $("input[name='address']").val(resUser.address);
            $("input[name='username']").val(resUser.username);
            $("input[name='password']").val(resUser.password);
        }
    })
})