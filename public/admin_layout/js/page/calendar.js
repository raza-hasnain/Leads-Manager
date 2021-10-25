$(document).ready(function() {

    "use strict";
    
    $(".count-number").counterUp( {
        delay: 10, time: 5e3
    }
    ), $(".chat_list").slimScroll( {
        size: "3px", height: "256px", allowPageScroll: !0, railVisible: !0
    }
    ), 
        $(".message_inner").slimScroll({
            size: "3px", 
            height: "351px", 
            allowPageScroll: !0, 
            railVisible: !0
        }), 
        
        $(".monthly_calender").slimScroll( {
            size: "3px", 
            height: "312px", 
            allowPageScroll: !0, 
            railVisible: !0
        }), 
        $(".emojionearea").emojioneArea( {
            pickerPosition: "top", 
            tonesStyle: "radio"
        }), 
        $("#t_calendar").monthly( {
            mode: "event", 
            xmlUrl: "events.xml"
        }
    );
    
    
}
);