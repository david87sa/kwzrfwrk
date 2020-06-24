// JavaScript Document
//var mjq = jQuery.noConflict(true);

(function ($) {
    kwzr = {
        GLOBALS: {
            CURRENT_SECTION: "",
            SECTION_OFFSET: [],
            TIMER: "",
            IS_SCROLLING:false,
            LAST_POSITION:0,
            IS_MOBILE:false
        },
        handler_document_ready: function () {
            //initialize soundcloud player
            window.onbeforeunload = function(){
                window.scrollTo(0,0);
            };
            $("iframe").attr("width",$(window).width()*0.8);
            $("iframe").attr("height",$(window).height()*0.8);
            kwzrPlayer.INIT();
            kwzr.GLOBALS.CURRENT_SECTION=$("#container").children().first().attr("id");
            //$('#logo').css("left",($(window).width()/2)-($("#logo").width()/2)+15);
            //$('#logo').css("top",($(window).height()/2)-($("#logo").height()/2)-250);
            //$(".homecontainer").css("height",$(window).height());
            //$(".container").css("height",$(window).height());
            $("#contactImage").attr("src","img/newer/FotoBandaMedios.png");
            $(".sectioncontainer").each(function(){
                    $(this).css("width",($(".element").width()+340)*$(this).children().length);
            });
                    
            //$(".container").css("height",$(window).height());
            
            $("#container").fadeIn(1500,function(){
                $('#logo').animate({
                    opacity: 1,
                    top:"15vh",
                }, {
                    duration: 1500,
                    queue: false,
                    specialEasing:{top:"easeOutCubic",opacity:"easeInQuint"},
                    complete: function () {
                        kwzr.crearToolbar(1);
                        $('.promo').animate({
                            opacity: 1
                        }, {
                            duration: 1500,
                            queue: false,
                            specialEasing:{top:"easeOutCubic",opacity:"easeInQuint"}
                        });
                        $('#listento').animate({
                            opacity:1
                        },{
                            duration:1500,
                            queue: false
                        });

                    }
                });
                
            });

            $(".element").click(function(){
                items = [];
                selectedIndex=0;
                selectedElement=$(this);
                
                info = $(this).find(".link .invisible");
                type = info.attr("destinationtype");
                if (type=="soundcloud"){
                    kwzrPlayer.PLAY(info.html());
                    return false;
                }
                $(this).parent().children().each(function(index, element){
                    if($(element).is(selectedElement)){
                        selectedIndex=index;
                    }
                    info = $(element).find(".link.invisible");
                    type = info.attr("destinationtype");
                    if (type=="iframe"){
                        info= info.html().trim();
                    }
                    
                    items[index]={
                        src: info,
                        type: type
                    };
                });
                $.magnificPopup.open({
                    items: items,
                    gallery: {
                      enabled: true
                    },
                    type:type,
                    overflowY:'scroll'
                },selectedIndex);
            });
            //////////navigation
            $('.toolbarElement').click(function (evt) {
                if ($(window).scrollTop()==0&&$(this).attr("id")=="elem8"){
                    return;
                }
                kwzr.gotosection($(this).attr("id"),1000);
            });
            $(".newscontrols").bind("click", function (evt) {
                if ($(this).hasClass("left")){
                    kwzr.scrollNews("left");
                }
                if ($(this).hasClass("right")){
                    kwzr.scrollNews("right");
                }
            });
            $(document).keydown(function(event){
                if (event.keyCode=="38"||event.keyCode=="40"){
                    kwzr.goToNearestSection(event);
                }
                if (event.keyCode=="39"){
                    kwzr.scrollNews("right");
                }
                if (event.keyCode=="37"){
                    kwzr.scrollNews("left");
                }
            });
            $(".see_more").click(function(evt){
                evt.preventDefault();
            });
            $("#contactEmailContainer form").submit(function(evt){
                evt.preventDefault();
                $("#contactEmailContainer .result").html("...Loading");
                $.ajax({
                    type:"POST",
                    url:$(this).attr("action"),
                    data:    $(this).serialize(),
                    success:function(data){
                        if(data.trim()=="true"){
                            $("#contactEmailContainer .result").html("Your email has been submitted");
                            $("#contactEmailContainer input,#contactEmailContainer textarea").val("");
                        }else{
                            $("#contactEmailContainer  .result").html("There was an error sending the email");
                        }
                    },
                    error:function(request){
                        $("#contactEmailContainer  .result").html("There was an error sending the email");
                        console.log(request.responseText);
                    }
                    });
                return false;
            });
            
            $(window).scroll(function (e) { 
                if($("#toolbar").offset().top-$(window).scrollTop()<=0){

                    $("#toolbar").css("position", "fixed");
                    $("#toolbar").css("z-index", "10");
                    $("#toolbar").css("top", "0");
                    $(".logosmall").removeClass("nodisplay");
                    $("#toolbarContent").addClass("stuck");
                    
                    $("#listento").addClass("listentotop");
                }
                if($(window).scrollTop()<=$(window).height()*0.85){
                    $("#toolbar").css("top", "85%");
                    $("#toolbar").css("position", "relative");
                    $("#toolbar").removeClass("toptoolbar");
                    $(".logosmall").addClass("nodisplay");
                    $("#toolbarContent").removeClass("stuck");
                    
                    $("#listento").removeClass("listentotop");
                }
                //heightLeft = ($(window).height()-($(window).width()/1280*720))/2*-1;
                //$(".homecontainer").css("background-position","center "+(($(window).scrollTop()-heightLeft)*1.3)+"px");
                $(".imgleft").css("margin-left",-$(window).scrollTop()*1.25);
                $(".imgright").css("margin-left",$(window).scrollTop()*1.25);
                $(".homecontainer").css("background-size",100+($(window).scrollTop()*0.075)+"%");
                $("#toolbarContent").css("width",$(window).scrollTop()/($(window).height()-50)*100+"%");
                
                
            });
            $("#container").children().each(function(){
                $(this).waypoint(function(direction){
                    $(this.element).find(".element").each(function(index,element){
                        $(element).animate({margin:"0 20px",opacity:1},500,function(){});
                    });
                    $(this.element).find(".sectioncontainer").width(($(".element").width()+40)*300);
                    wayElement = this.element;
                    $(".toolbarElement").each(function(){
                        if ($(wayElement).hasClass($(this).attr("id"))){
                            kwzr.GLOBALS.CURRENT_SECTION=$(this).attr("id");
                        }
                    });
                },{offset:"50%"});
                
            });
            if (!kwzr.GLOBALS.IS_MOBILE){
                $(".scrollbar").perfectScrollbar({suppressScrollY:true});
                $(window).scroll(kwzr.goToNearestSection);
            }else{
                $("#element-1 .image img").attr("src","img/newer/shirtsmockupmobile.png");
                $("#section1").append('<div class="promo">Human convergence<br>Available Now!</div>');
            }
        },
        goToNearestSection:function(e){
            if ($(".mfp-wrap").lenght>0)
                return;
            if(e)
                e.preventDefault();
            if(!kwzr.GLOBALS.IS_SCROLLING){
                if (kwzr.GLOBALS.LAST_POSITION!==$(window).scrollTop() || e.keyCode){
                    if (kwzr.GLOBALS.LAST_POSITION>$(window).scrollTop()||e.keyCode=="38") {
                        kwzr.gotosection($("#"+kwzr.GLOBALS.CURRENT_SECTION).prev().attr("id"),1000);
                    }else {
                        kwzr.gotosection($("#"+kwzr.GLOBALS.CURRENT_SECTION).next().attr("id"),1000);
                    }
                }
            }    
        },
        crearToolbar: function (count) {

            if (count <= 12) {
                $('#elem' + count).animate({
                    opacity: 1
                }, {
                    duration: 200,
                    borderSpacing: 'linear',
                    complete: function () {
                        kwzr.crearToolbar(count + 1);

                    }
                });
            } else {
                
                $(".container").css("height",$(window).height()-$("#toolbarContent").height());
                $(".homecontainer").css("height",$(window).height());
                //$(".element").css("height",($(window).height()-$("#toolbarContent").height())/2);
                //$(".scrollbar").css("height",$(window).height()-$("#toolbarContent").height());
                //$(".newscontrols").css("height",$(window).height()-$("#toolbarContent").height());
            }
            Waypoint.refreshAll();

        },
        
        pause: function () {
            var audioPlayer = document.getElementById('audioplaylist');
            if (audioPlayer.paused && audioPlayer.currentTime > 0) {
                audioPlayer.play();
            } else {
                audioPlayer.pause();
                return;
            }
            if (audioPlayer.src == null || audioPlayer.src == "") {
                audioPlayer.src = playlist[0] + ".mp3";
                audioPlayer.play();
            }

        },
        /////news
        sortnews: function () {

            var newsContainer = "";
            var currentColumn = "<div class='newscolumn' >";
            var currentColumnSize = 0;

            $(".newspost").each(function (i, j) {
                if (currentColumnSize + $(j).height() < 600) {
                    currentColumn += "<div id='post1' class='newspost'>" + $(j).html() + "</div>";
                    currentColumnSize += $(j).height();
                } else if (currentColumnSize == 0) {

                    currentColumn += "<div id='post1' class='newspost'>" + $(j).html() + "</div>";
                    currentColumn += "</div><div class='newscolumn'>";
                    currentColumnSize = 0;
                } else {
                    currentColumn += "</div><div class='newscolumn'>";
                    currentColumn += "<div id='post1' class='newspost'>" + $(j).html() + "</div>";
                    currentColumnSize = $(j).height();
                }
            });

            currentColumn += "</div>";
            $(".element").html(currentColumn);
            $(".element").width($(".newscolumn").length * 550);
            $("#falsenews").remove();
            $(".newscolumn").each(function(){
                    $(this).perfectScrollbar();
            });
        },
        scrollNews: function (direction) {
            elem=$("."+kwzr.GLOBALS.CURRENT_SECTION);
            if (direction=="right") {
                $(elem).find('#newsscrollbarcontainer').stop().animate({
                    scrollLeft: $(elem).parent().find("#newsscrollbarcontainer").scrollLeft() + $(".element").width()+40
                }, 500,function(){$(elem).parent().find('#newscontnewsscrollbarcontainer').perfectScrollbar('update');});
            }

            if (direction=="left") {
                $(elem).find('#newsscrollbarcontainer').stop().animate({
                    scrollLeft: $(elem).parent().find("#newsscrollbarcontainer").scrollLeft() - $(".element").width()+40
                }, 500,function(){$(elem).parent().find('#newscontnewsscrollbarcontainer').perfectScrollbar('update');});
            }
            
        },
        gotosection: function (sectionid,time) {
            sectionid=sectionid.replace("section","elem");
            kwzr.GLOBALS.IS_SCROLLING=true;
            //$(window).unbind("scroll",kwzr.goToNearestSection);

            $("html, body").stop().animate({
                scrollTop: $("." + sectionid).offset().top-$("#toolbarContent").height()
            },
            time,
            "easeInOutCirc",
            function () {

                //$("#toolbar").css("top", "0px");
                $("#toolbar").removeClass("movable");
                $("#toolbar").addClass("toptoolbar");
                kwzr.GLOBALS.CURRENT_SECTION = sectionid;
                kwzr.GLOBALS.IS_SCROLLING=false;

                //$(window).bind("mousewheel DOMMouseScroll",kwzr.goToNearestSection);
                kwzr.GLOBALS.LAST_POSITION=$(window).scrollTop();
            });
/*
            $("."+sectionid).find(".element").each(function(index,element){
                setTimeout(function(){
                    $(element).animate({margin:"0 20px",opacity:1},500,function(){});
                },500);
            });*/
        }


    };
    $(window).on('load',function () {
        if (/Mobi|Android/i.test(navigator.userAgent)) {
            kwzr.GLOBALS.IS_MOBILE = true;
        }
        kwzr.handler_document_ready();
    });
})(mjq);
