$(function() {

$("body").css({padding:0,margin:0});
    var f = function() {
        $(".bodycontainer").css({position:"relative"});
        var h1 = $("body").height();
        var h2 = $(window).height();
        var d = h2 - h1;
        var h = $(".bodycontainer").height() + d;        
        var ruler = $("<div>").appendTo(".bodycontainer");              
        h = Math.max(ruler.position().top,h);
        ruler.remove();        
        $(".bodycontainer").height((h > 500) ? h - 18 : h);
    };
    setInterval(f,1000);
    $(window).resize(f);
    f();
});