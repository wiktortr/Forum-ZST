function reload_stye() {
    $.ajax({
        url: "api/is_login.php",
        success: function (data) {
            if (data == "false") {
                $("#ac").hide(200);
                $("#log-out").hide(200);
                $(".pz").show(200);
                $(".nav-user").hide(200);
            }
            else {
                $("#ac").show(200);
                $("#log-out").show(200);
                $(".pz").hide(200);
                $.ajax({
                    url: "api/user_name.php",
                    success: function (name) {
                        $(".user-name").html(name);
                    }
                });
                $(".nav-user").show(200);
            }
        }
    });
}

$(document).ready(function () {
    
    //$(".navbar").sticky({ topSpacing: 0 });

    $.ajax({
        url: "api/is_login.php",
        success: function (data) {
            //alert(data);
            if (data == "false") {
                $("#ac").hide();
                $("#log-out").hide();
                $(".nav-user").hide();
            }
            else {
                $("#ac").show();
                $("#log-out").show();
                $(".pz").hide();
                $.ajax({
                    url: "api/user_name.php",
                    success: function (name) {
                        $(".user-name").html(name);
                    }
                });
                $(".nav-user").show();
            }
        }
    });

    $(".lb").click(function () {
        var user = $(".login").val();
        var pass = $(".pass").val();
        $.ajax({
            type: "POST",
            url: "api/login.php",
            data: {
                user: user,
                pass: pass
            },
            success: function (data) {
                reload_stye();
            }
        });
    });

    $(".loa").click(function () {
        $.ajax({
            url: "api/log_out.php",
            success: function (data) {
                reload_stye();
            }
        });
    });

    $("#rej").click(function () {
        window.location.replace("rejestracja.html");
    });

});