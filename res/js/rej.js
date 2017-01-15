function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function is_space(text) {
    for (i = 0; i < text.length; i++) {
        if (text[i] == " ")
            return true;
    }
    return false;
}

$(document).ready(function () {
    $(".msg").hide();

    $.ajax({
        url: "api/is_login.php",
        success: function (data) {
            if (data == "false") {
                $("#rej-btn").click(function () {
                    var login = $("#login-rej").val();
                    var pass1 = $("#pass-rej-1").val();
                    var pass2 = $("#pass-rej-2").val();
                    var email = $("#email-rej").val();
                    if (login !== "" && pass1 !== "" && pass2 !== "" && email !== "") {
                        if(!is_space(login)){   
                            if (pass1 == pass2) {
                                if (validateEmail(email)) {
                                    $.ajax({
                                        type: "POST",
                                        url: "api/rej.php",
                                        data: {
                                            login: login,
                                            pass: pass1,
                                            email: email
                                        },
                                        success: function (data) {
                                            if (data == "ok") {
                                                window.location.replace("account.html");
                                            }
                                            else {
                                                $(".msg").html(data);
                                                $(".msg").show(200);
                                            }
                                        }
                                    });
                                }
                                else {
                                    $(".msg").html("Email jest nieprawidłowy!");
                                    $(".msg").show(200);
                                }
                            }
                            else {
                                $(".msg").html("Hasło musi być takie samo w obu polach!");
                                $(".msg").show(200);
                            }
                        }
                        else {
                            $(".msg").html("Nie może być spacji w loginie!");
                            $(".msg").show(200);
                        }
                    }
                    else {
                        $(".msg").html("Musisz wypełnić wszystkie pola!");
                        $(".msg").show(200);
                    }
                });
            }
            else {
                $(".rej-div").hide(100);
                $(".msg").html("Ty już posiadasz konto!");
                $(".msg").show(200);
            }
        }
    });

});