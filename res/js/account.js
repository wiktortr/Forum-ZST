$(document).ready(function () {
    $("#file-ico").css('opacity', '0');
    $(".msg").hide();

    if (window.location.search !== "") {
        var tmp = window.location.search;
        if (tmp.search("nick") > 0) {
            if (tmp.indexOf("&") > 0)
                var fraza = tmp.substring(6, tmp.indexOf("&"));
            else
                var fraza = tmp.substring(6, tmp.length);
            $(".account-login").hide();
            $(".account-div").show();

            if (tmp.search("%20") > 0)
                fraza = fraza.replace("\%20", " ");

            $.ajax({
                type: "GET",
                url: "api/account_data.php",
                data: {
                    nick: fraza
                },
                success: function (d) {
                    $(".account-data").html(d);
                }
            });

            $(".account-name").removeClass("user-name");
            $(".account-name").html(fraza);

            $.ajax({
                type: "GET",
                url: "api/account_ico.php",
                data: {
                    nick: $(".account-name").html()
                },
                success: function (d) {
                    $(".account-icon").html(d);
                }
            });

            $(".tjl").hide();
        }
        else {
            $.ajax({
                url: "api/is_login.php",
                success: function (data) {
                    if (data == "false") {
                        $(".account-login").show();
                        $(".account-div").hide();
                    }
                    else {
                        $(".account-login").hide();
                        $(".account-div").show();

                        $.ajax({
                            url: "api/account_data.php",
                            success: function (d) {
                                $(".account-data").html(d);
                            }
                        });

                        $.ajax({
                            type: "GET",
                            url: "api/account_ico.php",
                            data: {
                                nick: $(".account-name").html()
                            },
                            success: function (d) {
                                $(".account-icon").html(d);
                            }
                        });

                    }
                }
            });
        }
    }
    else {
        $.ajax({
            url: "api/is_login.php",
            success: function (data) {
                if (data == "false") {
                    $(".account-login").show();
                    $(".account-div").hide();
                }
                else {
                    $(".account-login").hide();
                    $(".account-div").show();

                    $.ajax({
                        url: "api/account_data.php",
                        success: function (d) {
                            $(".account-data").html(d);
                        }
                    });

                    $.ajax({
                        //type: "GET",
                        url: "api/account_ico.php",
                        success: function (d) {
                            //alert(d + $(".account-name").html());
                            $(".account-icon").html(d);
                        }
                    });

                }
            }
        });
    }

    $(".login-btn-2").click(function() {
        var user = $("#login2").val();
        var pass = $("#pass2").val();
        $.ajax({
            type: "POST",
            url: "api/login.php",
            data: {
                user: user,
                pass: pass
            },
            success: function (data) {
                if (data == "true") {
                    location.reload();
                }
            }
        });
    });

    $("#save-a-data").click(function () {
        var pass1 = $("#zpass1").val();
        var pass2 = $("#zpass2").val();
        var email = $("#zemail").val();
        var anotl = $("#zautonot").val();
        $.ajax({
            type: "POST",
            url: "api/account_edit_data.php",
            success: function (d) {
                if (d == "ok") {
                    location.reload();
                }
                else {
                    $(".msg").html(d);
                    $(".msg").show(200);
                }
            }
        });
    });

    $(".account-icon").click(function () {
        $("#file-ico").trigger('click');
    });

    $("#file-ico").on("change", function () {
        //upload    
    });

});


$(document).keypress(function (e) {
    if (e.which == 13) {
        var user = $("#login2").val();
        var pass = $("#pass2").val();
        $.ajax({
            type: "POST",
            url: "api/login.php",
            data: {
                user: user,
                pass: pass
            },
            success: function (data) {
                if (data == "true") {
                    location.reload();
                }
            }
        });
    }
});