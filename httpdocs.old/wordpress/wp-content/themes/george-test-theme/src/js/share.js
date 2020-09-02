var Share = {
    settings: {
        $facebook_button: jQuery('.sharing-icons .facebook'),
        $twitter_button: jQuery('.sharing-icons .twitter'),
        $linkedin_button: jQuery('.sharing-icons .linkedin'),
        $whatsapp_button: jQuery('.sharing-icons .whatsapp'),
        $email_button: jQuery('.sharing-icons .email'),
        share_loc : jQuery('meta[property="og:url"]').attr('content'),
        share_title : encodeURIComponent(jQuery('meta[property="og:title"]').attr('content')),
        share_img : jQuery('meta[property="og:image"]').attr('content'),
        share_via_twitter : 'TheMancUK'
    },

    init: function() {
        if(!Share.settings.share_loc) {
            Share.settings.share_loc = window.location.href;
        }

        Share.settings.$facebook_button.on('click', this.facebookShare);
        Share.settings.$twitter_button.on('click', this.twitterShare);
        Share.settings.$linkedin_button.on('click', this.linkedinShare);
        Share.settings.$whatsapp_button.on('click', this.whatsappShare);
        Share.settings.$email_button.on('click', this.emailShare);
    },

    facebookShare: function(e){
        e.preventDefault();
        window.open('https://www.facebook.com/sharer/sharer.php?u='+Share.settings.share_loc, 'manc_facebook_share', 'height=600, width=600, top='+(jQuery(window).height()/2 - 300) +', left='+jQuery(window).width()/2 +',toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');
    },

    twitterShare: function(e){
        e.preventDefault();
        window.open('http://twitter.com/share?url='+Share.settings.share_loc+'&text=' + Share.settings.share_title+'&via=' + Share.settings.share_via_twitter +'', 'manc_twitter_share', 'height=450, width=550, top='+(jQuery(window).height()/2 - 225) +', left='+jQuery(window).width()/2 +', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');
    },

    linkedinShare: function(e){
        e.preventDefault();
        window.open('http://www.linkedin.com/shareArticle?mini=true&url='+Share.settings.share_loc +'&title='+Share.settings.share_title+'', 'manc_linkedin_share', 'height=488, width=600, top='+(jQuery(window).height()/2 - 300) +', left='+jQuery(window).width()/2 +',toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');
    },

    whatsappShare: function(e){
        e.preventDefault();
        window.open('https://api.whatsapp.com/send?text='+Share.settings.share_title+'%20'+Share.settings.share_loc+'', 'manc_whatsapp_share', 'height=488, width=600, top='+(jQuery(window).height()/2 - 300) +', left='+jQuery(window).width()/2 +',toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');
    },

    emailShare: function(e){
        e.preventDefault();
        window.open('mailto:?subject='+Share.settings.share_title+'&body=Read this at: '+Share.settings.share_loc+'', 'manc_email_share', 'height=488, width=600, top='+(jQuery(window).height()/2 - 300) +', left='+jQuery(window).width()/2 +',toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');
    }
};

jQuery(function(){    
    Share.init();
});