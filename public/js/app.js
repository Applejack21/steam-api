var General = {
    settings: {
        api_url: "http://steamapi.test/api"
    }
};

var Homepage = {
    settings: {
        $find_steam_info: $('#find-steam-id'),
    },

    init: function() {
        Homepage.bindEvents();
    },

    bindEvents: function() {
        $('#find-steam-id').on('click', Homepage.findSteamInfo);
    },
    
    findSteamInfo: function(e) {
        e.preventDefault();
        
        var payload = new FormData(), 
            find_steam_info_button = $('#find-steam-id'),
            steam_user_id = $('#steam-user-id-input-box').val(),
            find_steam_id_div = $('.how-to-find-steam-id'),
            steam_id_results_div = $('.steam-id-results'),
            steam_avatar_div = $('.steam-avatar-div'),
            results_steam_avatar = $('#steam-avatar'),
            valid = true;
                
        find_steam_info_button.prop('disabled', true);
        find_steam_info_button.find('.fa-spin').css("visibility", "visible");
        find_steam_info_button.closest('.module-body').find('.alert').hide();
                
        if((steam_user_id === "")) {
            valid = false;
        }
        
        if(!valid) {
            find_steam_info_button.closest('.module-body').find('.empty-id').show();
            find_steam_info_button.find('.fa-spin').css("visibility", "hidden");
            find_steam_info_button.prop('disabled', false);
        } else {
            payload.append("steam_id", steam_user_id.trim());
            
            $.ajax({
                url: General.settings.api_url+'/steam/findsteamid',
                type: 'POST',
                data: payload,
                cache: false,
                contentType: false,
                processData: false,
                success:function(data) {
                    if(data.status === 200) {
                        
                        steam_id_results_div.empty(); //remove the previous steam id results
                        results_steam_avatar.removeAttr('src'); //remove the image from the previous steam id results
                        
                        steam_id_results_div.css("display", "inline-block");
                        steam_avatar_div.css("display", "inline-block");
                            
                        steam_id_results_div.append("<h3 id='steam-name'>"+data.steam_data[0]['json_person_name']+"</h3>");
                        results_steam_avatar.attr('src', data.steam_data[0]['json_avatar_full']);
                        steam_id_results_div.append("<p id='steam-user-status'>"+data.steam_data[0]['json_persona_state']+"</p>");
                        console.log (data.steam_data[0]['json_real_name']);
                        console.log (data.steam_data[0]['json_time_created']);
                        console.log (data.steam_data[0]['json_country_code']);
                            
                        find_steam_info_button.closest('.module-body').find('.user-found').show();
                    } else {
                        find_steam_info_button.closest('.module-body').find('.user-not-found').show();
                    }
                    
                    find_steam_info_button.find('.fa-spin').css("visibility", "hidden");
                    find_steam_info_button.prop('disabled', false);
                },
                error: function(data) {
                    if(data.status === 400) {
                        find_steam_info_button.closest('.module-body').find('.user-not-found').show(); //will show if the user enters anything other than digits
                    } else if (data.status === 500) {
                        find_steam_info_button.closest('.module-body').find('.general-error').show(); //will show if there was an error finding a user with the digits provided
                    }
                
                    find_steam_info_button.find('.fa-spin').css("visibility", "hidden");
                    find_steam_info_button.prop('disabled', false);
                }
            });
        }     
    }
};


$(function() {
    if($('.dash-homepage').length) {
        Homepage.init();
    }
});