                $(document).ready(function () {
                    "use strict";
                setTimeout(function () {
                    $(".bd-chat").slideDown("slow");
                }, 3000);
                $(".chat-toggle").on("click", function () {
                    $(".bd-chat").slideToggle(300, "swing");
                    $(this).toggleClass('open');
                });
                $(".chat-close").on("click", function (e) {
                    e.preventDefault();
                    $(".bd-live-chat").hide();
                });

            });