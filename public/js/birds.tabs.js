jQuery(document).ready(function(e){"use strict";var t=e(".author_box_tabs_navigation a"),n=e(".author_box_tabs_content");t.on("click",function(r){r.preventDefault();var i=e(this);if(!i.hasClass("selected")){var s=i.data("content"),o=n.find('li[data-content="'+s+'"]'),u=o.innerHeight();t.removeClass("selected");i.addClass("selected");o.addClass("selected").siblings("li").removeClass("selected");n.animate({height:u},200)}});e(window).bind("load resize scroll",function(t){var n=e(".author_box_tabs").width(),r=e("li#lposts").width(),i=e("li#social").width(),s=e("li#bio").width(),o=r+s+i;if(o>n){e(".author_box_tabs_navigation li").css("float","none")}else{e(".author_box_tabs_navigation li").css("float","left")}})})