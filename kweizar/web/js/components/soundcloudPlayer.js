// JavaScript Document
var mjq = jQuery.noConflict(true);

(function ($) {
kwzrPlayer = {
    SONGS:{
        LIFESPRICE:"/tracks/73368235",
        SHARING:"/tracks/73368671",
        ENDWORLD:"/tracks/72000381",
        DEADAGAIN:"/tracks/73368787",
        LAYER:"/tracks/70916196",
        SING:"/tracks/193108587"
    },
    CURRENT_SONG:"",
    INIT:function(){
        SC.initialize({
          client_id: '32318f3bff1735d66e218aa802f81d0f'
        });
        $("#playpause").click(function(){
            if (kwzrPlayer.CURRENT_SONG.paused){
                kwzrPlayer.CURRENT_SONG.play();
                $("#playpause").addClass("pause").removeClass("play");
            }else{
                kwzrPlayer.CURRENT_SONG.pause();
                $("#playpause").addClass("play").removeClass("pause");
            }
        });
        $(".next").click(function(){
            next = false;
            for (var song in kwzrPlayer.SONGS){
                if (next){
                    kwzrPlayer.PLAY(kwzrPlayer.SONGS[song]);
                    return false;
                }
                if (kwzrPlayer.CURRENT_SONG.url.indexOf(kwzrPlayer.SONGS[song])>0){
                    next = true;
                }
            }
        });
        $(".back").click(function(){
            previous = false;
            previousElement = null;
            for (var song in kwzrPlayer.SONGS){

                if (kwzrPlayer.CURRENT_SONG.url.indexOf(kwzrPlayer.SONGS[song])>0){
                    previous = true;
                }
                if (previous){
                    kwzrPlayer.PLAY(kwzrPlayer.SONGS[previousElement]);
                    return false;
                }
                previousElement=song;
            }
        });
    },
    PLAY:function(id){
        SC.get(id, {limit: 1}, function(tracks){
            $("#playerbox").removeClass("hidden");
            $("#playerbox .info").fadeOut(300,function(){
               $(this).removeClass("small").fadeIn(300); 
            });
            art = (tracks.artwork_url)?tracks.artwork_url:tracks.user.avatar_url;
            $("#playerbox .image").html("<img src='"+art+"'/>");
            $("#playerbox .band").html(tracks.user.username);
            $("#playerbox .song").html(tracks.title);
            setTimeout(function (){
                $("#playerbox .info").fadeOut(300,function(){
                    $(this).addClass("small").fadeIn(300);
                });
            },5000);
        });
        SC.stream(id, function(sound){
            if (kwzrPlayer.CURRENT_SONG){
                kwzrPlayer.CURRENT_SONG.stop();
            }
            kwzrPlayer.CURRENT_SONG=sound;
            kwzrPlayer.CURRENT_SONG.play();
        });
        
    },
    PAUSE:function(){
        kwzrPlayer.CURRENT_SONG.pause();
    }
};

})(mjq);






