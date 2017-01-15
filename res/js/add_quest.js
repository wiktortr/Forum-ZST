$(document).ready(function () {
    $(".msg").hide();

    $.ajax({
        url: "api/home_data.php",
        success: function (data) {
            $("#home-data").html(data);
        }
    });

    $.ajax({
        url: "api/is_login.php",
        success: function (data) {
            if (data == "false") {
                $(".add-q-div").hide();
                $(".msg").html("Musisz się zalogować żeby zadać pytanie!");
                $(".msg").show(220);
            }
            else {
                $(".msg").hide(200);
                $(".add-q-div").show(200);
                $.ajax({
                    url: "api/user_name.php",
                    success: function (d) {
                        $(".zap-data-nick").html(d);

                        $.ajax({
                            type: "GET",
                            url: "api/account_ico.php",
                            data: {
                                nick: d
                            },
                            success: function (d1) {
                                $(".zap-data-icon").html(d1);
                            }
                        });

                    }
                });

            }
        }
    });

});

$(document).on('click', '#a-d-btn', function () {
    var title = $("#add-q-title").val();
    var quest = $("#add-q-t").val();
    var kat = $("#add-q-k").val();
    $.ajax({
        type: "GET",
        url: "api/add_quest.php",
        data: {
            title: title,
            quest: quest,
            kat: kat
        },
        success: function (data) {
            if (data == "error") {
                $(".msg").html("Jest jakiś problem");
                $(".msg").show(200);
            }
            else {
                window.location.replace('index.html?id_pyt=' + data);
            }
        }
    });
});

