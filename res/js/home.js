﻿$(document).ready(function () {

    $.ajax({
        url: "api/home_data.php",
        success: function (data) {
            $("#home-data").html(data);
        }
    });

    if (window.location.search !== "") {
        var tmp = window.location.search;
        if (tmp.search("search") > 0) {
            if (tmp.indexOf("&") > 0)
                var fraza = tmp.substring(8, tmp.indexOf("&"));
            else
                var fraza = tmp.substring(8, tmp.length);
            $.ajax({
                type: "GET",
                url: "api/home.php",
                data: {
                    search: fraza
                },
                success: function (data) {
                    $(".context").html(data);
                }
            });
        }
        else if (tmp.search("id_pyt") > 0) {
            if (tmp.indexOf("&") > 0)
                var id = tmp.substring(8, tmp.indexOf("&"));
            else
                var id = tmp.substring(8, tmp.length);
            $.ajax({
                type: "GET",
                url: "api/pyt.php",
                data: {
                    id_pyt: id
                },
                success: function (data) {
                    Prism.highlightAll();
                    $(".context").html(data);

                    $(".loa").click(function () {
                        $("#soy").hide(200);
                    });

                    $("#coment-btn").click(function () {
                        var com = $("#coment-in").val();
                        com = com.replace(/\r?\n/g, '<br />');
                        com = com.replace(/\t/g, '   ');
                        $.ajax({
                            type: "GET",
                            url: "api/coment.php",
                            data: {
                                id_pyt: id,
                                coment: com
                            },
                            success: function (d) {
                                //alert(d);
                                if (d == "ok") {
                                    location.reload();
                                }
                            }
                        });
                    });

                    $(".zap-data").click(function () {
                        window.open("account.html?nick=" + $(this).children(".zap-data-nick").html(), '_blank');
                    });

                    $(".icon-thumbs-up").click(function () {
                        var id = $(this).attr("title");
                        $.ajax({
                            type: "GET",
                            url: "api/answer_like.php",
                            data: {
                                id: id,
                                like: "+"
                            },
                            success: function (d) {
                                if (d == "ok") {
                                    location.reload();
                                }
                            }
                        });
                    });

                    $(".icon-thumbs-down").click(function () {
                        var id = $(this).attr("title");
                        $.ajax({
                            type: "GET",
                            url: "api/answer_like.php",
                            data: {
                                id: id,
                                like: "-"
                            },
                            success: function (d) {
                                if (d == "ok") {
                                    location.reload();
                                }
                            }
                        });
                    });

                    var edit = false;
                    $(".zap-edit").on("click", function () {
                        if (edit == false) {
                            edit = true;
                            var id_answer = $(this).attr("title");
                            var text_div = $(this).parent(".zap-data2").parent(".zap-data-div").parent(".odpowiedz").children(".zap-text");
                            var text = $(text_div).html();
                            $(text_div).html('<textarea id="edit-in" rows="13" cols="50" placeholder="Popraw text">' + text.replace(/<br>/g, '\n') + '</textarea><button class="btn btn-d zz" style="width:50%">Zpisz zmiany</button><button class="btn btn-d aze" style="width:50%;background-color: #E8574C;">Anuluj</button>');
                            $(".aze").click(function () {
                                $(text_div).html(text);
                                edit = false;
                            });
                            $(".zz").click(function () {
                                var ei = $("#edit-in").val();
                                ei = ei.replace(/\r?\n/g, '<br />')
                                $.ajax({
                                    type: "GET",
                                    url: "api/hash.php",
                                    data: {
                                        text: ei
                                    },
                                    success: function (d) {
                                        $(text_div).html(d);
                                        $.ajax({
                                            type: "GET",
                                            url: "api/edit_answer.php",
                                            data: {
                                                id_answer: id_answer,
                                                text: ei
                                            },
                                            success: function (d2) {
                                                edit = false;
                                                //alert(d2);
                                                if (d2 != "ok")
                                                    $(text_div).html(text);
                                            }
                                        });
                                    }
                                });
                            });
                        }
                        });
                    
                    }
            });
        }
        else {
            $.ajax({
                url: "api/home.php",
                success: function (data) {
                    $(".context").html(data);
                }
            });
        }
    }
    else {
        $.ajax({
            url: "api/home.php",
            success: function (data) {
                $(".context").html(data);
                $(".pyt-ico").click(function () {
                    var id_pyt = $(this).attr('title');
                    window.location.replace("index.html?id_pyt=" + id_pyt);
                });
            }
        });
    }

    $("#search-btn").click(function () {
        var search = $("#search-in").val();
        window.location.replace("index.html?search=" + search);
    });

});

//$(document).on('click', '.pyt-ico', function () {
//    alert();
//});

