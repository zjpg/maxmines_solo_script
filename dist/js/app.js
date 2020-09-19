$("#loginForm").submit(function(t) {
    t.preventDefault();

    if(document.getElementById("xmr-address").value.length < 95
    || document.getElementById("xmr-address").value.length > 105) {
        $(".modal-content").css("background", "#501b1bed");
        $("#modal-text").text("Địa chỉ Monero không hợp lệ");
        $("#modal").modal("show");
    } else {
        $.ajax({
            type: "POST",
            url: "handler.php",
            datatype: "script",
            data: {
                action: "login",
                address: document.getElementById("xmr-address").value
            },
            success: function(t) {
                if("success" == t) {
                    $(".modal-content").css("background", "#104e46e8");
                    $("#modal-text").text("Địa chỉ Monero của bạn đã được lưu.");
                    $("#modal").modal("show");
                    if(true == document.getElementById("redirect").value) 
                        window.location = "/account"
                } else {
                    $(".modal-content").css("background", "#501b1bed");
                    $("#modal-text").text(t);
                    $("#modal").modal("show");
                }
            }
        })
    }
});
$(document).on("click", 'a[href^="#"]', function(t) {
    t.preventDefault();
    $("html, body").animate({
        scrollTop: $($.attr(this, "href")).offset().top
    }, 500)
});
$(document).ready(function() {
    $("#year").text((new Date).getFullYear());
    var t = {};
    document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function() {
        function e(t) {
            return decodeURIComponent(t.split("+").join(" "))
        }
        t[e(arguments[1])] = e(arguments[2])
    }), void 0 !== t.action && location.replace(document.referrer), $("#logout").on("click", function(t) {
        t.preventDefault(), $.ajax({
            type: "POST",
            url: "handler.php",
            datatype: "script",
            data: {
                action: "logout"
            },
            success: function(t) {
                if("success" == t) {
                    $(".modal-content").css("background", "#104e46e8")
                    $("#modal-text").text("Đăng xuất thành công")
                    $("#modal").modal("show")
                    if(true == document.getElementById("redirect").value) 
                        window.location = "/";
                } else {
                    $(".modal-content").css("background", "#501b1bed");
                    $("#modal-text").text("Không thể đăng xuất");
                    $("#modal").modal("show");
                }
            }
        })
    })
});