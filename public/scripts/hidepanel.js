var panelIsHidden;
$("form").removeClass("hidden")
$("#hidepanel").click(function(){
    if(panelIsHidden == true){
        $("form").removeClass("hidden")
        panelIsHidden = false;
    }
    else{
        $("form").addClass("hidden")
        panelIsHidden = true;
    }
});

var overallIsHidden = true;
var recentIsHidden = false;
$("#leaderboardrecent").removeClass("hidden")
$("#hideoverall").click(function(){
    if(overallIsHidden == true){
        $("#leaderboardoverall").removeClass("hidden")
        // $("#leaderboardrecent").addClass("hidden")
        overallIsHidden = false;
        recentIsHidden = true;
    }
    else{
        $("#leaderboardoverall").addClass("hidden")
        // $("#leaderboardrecent").removeClass("hidden")
        overallIsHidden = true;
        recentIsHidden = false;
    }
});

$("#hiderecent").click(function(){
    if(recentIsHidden == true){
        // $("#leaderboardrecent").removeClass("hidden")
        $("#leaderboardoverall").addClass("hidden")
        overallIsHidden = true;
        recentIsHidden = false;
    }
    else{
        // $("#leaderboardrecent").addClass("hidden")
        $("#leaderboardoverall").removeClass("hidden")
        overallIsHidden = false;
        recentIsHidden = true;
    }
});
