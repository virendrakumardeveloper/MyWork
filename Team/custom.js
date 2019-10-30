$(document).ready(function(){
	setTimeout(function() {
        $(".team-profile").css({'display':'block'});
        $(".team-profile .col-md-2 .member1").animate({'top':'48px','right':'42%'});
        $(".team-profile .col-md-2 .member2").animate({'top':'48px','right':'70%'});
        $(".team-profile .col-md-2 .member3").animate({'top':'48px','left':'42%'});
        $(".team-profile .col-md-2 .member4").animate({'top':'48px','left':'70%'});
		
		
		
		
    }, 5000);
});