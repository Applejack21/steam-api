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
            steam_id_results_div = $('.steam-id-results-div'),
            steam_avatar_div = $('.steam-avatar-div'),
            results_steam_avatar = $('#steam-avatar'),
            steam_id_button_text = $('#find-steam-id-button-text'),
            valid = true;
                
        steam_id_button_text.text('Searching... ');
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
            steam_id_button_text.text('Find Steam Account');
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
                        
                        steam_avatar_div.css("display", "inline-block");
                        steam_id_results_div.css("display", "inline-block");
                        //display steam id results
                        results_steam_avatar.attr('src', data.steam_data[0]['json_avatar_full']);
            
                        if(data.steam_data[0]['json_real_name'] !== "") {
                            steam_id_results_div.append("<h3 id='steam-name'>"+data.steam_data[0]['json_person_name']+"<span id='steam-real-name' class='text--colour-grey'> ("+data.steam_data[0]['json_real_name']+")</span></h3>");
                        } else {
                             steam_id_results_div.append("<h3 id='steam-name'>"+data.steam_data[0]['json_person_name']+"</h3>");
                        }
                       
                        if(data.steam_data[0]['json_persona_state'] === "Online") {
                            steam_id_results_div.append("<p><i class='fas fa-circle fa-circle-online'></i><span id='steam-user-status'> "+data.steam_data[0]['json_persona_state']+"</span></p>");
                        } else {
                            steam_id_results_div.append("<p><i class='fas fa-circle fa-circle-offline'></i><span id='steam-user-status'> "+data.steam_data[0]['json_persona_state']+"</span></p>");
                        }
                        
                        steam_id_results_div.append("<p><i class='fas fa-calendar-alt'></i><span id='steam-data-created' data-toggle='tooltip' data-placement='right' title='"+data.steam_data[0]['json_time_created_full']+" (UTC)'> "+data.steam_data[0]['json_time_created']+"</span></p>");
                        
                        //http://www.google.co.uk/maps/place/49.46800006494457,17.11514008755796/@49.46800006494457,17.11514008755796,7z
                        

                        
                        //display city, state and country names
                        if(data.steam_data[0]['json_city_name'] && data.steam_data[0]['json_location_coordinates'] !== "") {
                            steam_id_results_div.append("<p><i class='fas fa-map-marker-alt'></i><a class='hyperlink' target='_blank' href='http://www.google.co.uk/maps/place/@"+data.steam_data[0]['json_location_coordinates']+",12z'><span id='steam-user-city'> "+data.steam_data[0]['json_city_name']+",</span><span id='steam-user-state'> "+data.steam_data[0]['json_state_name']+",</span><span id='steam-user-country'> "+data.steam_data[0]['json_country_name']+"</span></a><span id='steam-user-country-code' class='text--colour-grey'> ("+data.steam_data[0]['json_country_code']+")</span></p>");
                            
                        //display state, and country name
                        } else if(data.steam_data[0]['json_state_name'] && data.steam_data[0]['json_location_coordinates'] !== "") {
                            steam_id_results_div.append("<p><i class='fas fa-map-marker-alt'></i><a class='hyperlink' target='_blank' href='http://www.google.co.uk/maps/place/@"+data.steam_data[0]['json_location_coordinates']+",12z'><span id='steam-user-state'> "+data.steam_data[0]['json_state_name']+",</span><span id='steam-user-country'> "+data.steam_data[0]['json_country_name']+"</a></span><span id='steam-user-country-code' class='text--colour-grey'> ("+data.steam_data[0]['json_country_code']+")</span></p>");
                            
                        //display country name
                        } else if(data.steam_data[0]['json_country_name'] !== "") {
                            steam_id_results_div.append("<p><i class='fas fa-map-marker-alt'></i><span id='steam-user-country'> "+data.steam_data[0]['json_country_name']+"</span><span id='steam-user-country-code' class='text--colour-grey'> ("+data.steam_data[0]['json_country_code']+")</span></p>");
                        } 
                        //display unknown text
                        else {
                            steam_id_results_div.append("<p><i class='fas fa-map-marker-alt'></i><span id='steam-user-location-unknown'> Location Unknown</span></p>");
                        }
                        
                        find_steam_info_button.closest('.module-body').find('.user-found').show();
                    } else {
                        find_steam_info_button.closest('.module-body').find('.user-not-found').show();
                    }
                    
                    steam_id_button_text.text('Find Steam Account');
                    find_steam_info_button.find('.fa-spin').css("visibility", "hidden");
                    find_steam_info_button.prop('disabled', false);
                },
                error: function(data) {
                    if(data.status === 400) {
                        find_steam_info_button.closest('.module-body').find('.user-not-found').show(); //will show if the user enters anything other than digits
                    } else if (data.status === 500) {
                        find_steam_info_button.closest('.module-body').find('.general-error').show(); //will show if there was an error finding a user with the digits provided
                    }
                
                    steam_id_button_text.text('Find Steam Account');
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