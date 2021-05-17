function niks(){
    this.log= function(){
        console.log('sdfs');
    }
}

class Scrollbar{
    constructor(startPosition){
        this.position= startPosition;

        this.scrollEvent();
        this.navButton();
    }
    scrollEvent(){          
        $(window).on("scroll", function(){
            var newPosition=window.pageYOffset;

            if(this.position < newPosition){
                var navHeight= $('nav').outerHeight();
        
                document.querySelectorAll("nav")[0].style.top = -navHeight + "px";
            }else{
                document.querySelectorAll("nav")[0].style.top = "0";
            }

            this.position= window.pageYOffset;
        })
    }
    navButton(){
        $("#navButton").on("click", function(){
            $("nav ul").toggle();

            if(parseInt($("nav").css("width"))==70){
                $("nav").css({
                    "width": "100%",
                    "backgroundColor":"#1e1919"
                });
            }else{
                $("nav").css({
                    "width": "70",
                });
                document.querySelectorAll("nav")[0].style.backgroundColor="#9a9a9a00";
            }
        })
        $(window).on("resize", function(){
            if($("#navButton").css("display")=="none" && $("nav ul").css("display")=="none"){
                $("nav").css({
                    "top": 0,
                    "width":"100%",
                    "backgroundColor":"#1e1919"
                });
                $("nav ul").show();
            }
        })
    }
}