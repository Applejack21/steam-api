var General = {
    settings: {
        api_url: "http://steamapi.test/api",
        global_steam_id: ""
    }
};

var Homepage = {
    settings: {
        $find_steam_info: $('#find-steam-id'),
        $find_recent_games: $('#find-recent-games'),
    },

    init: function() {
        Homepage.bindEvents();
    },

    bindEvents: function() {
        $('#find-steam-id').on('click', Homepage.findSteamInfo);
        $('#find-recent-games').on('click', Homepage.fineRecentGames);
    },
    
    findSteamInfo: function(e) {
        e.preventDefault();
        
        var payload = new FormData(), 
            find_steam_info_button = $('#find-steam-id'),
            steam_user_id = $('#steam-user-id-input-box').val(),
            steam_results_overall_div = $('.steam-id-user-game-results'),
            steam_id_results_div = $('.steam-id-results-div'),
            steam_id_game_div = $('.steam-id-game-div'),
            steam_avatar_div = $('.steam-avatar-div'),
            results_steam_avatar = $('#steam-avatar'),
            results_steam_avatar_frame = $('#steam-avatar-frame'),
            results_game_header = $('#steam-id-game-image'),
            steam_id_button_text = $('#find-steam-id-button-text'),
            steam_avatar_link = $('#steam-avatar-link'),
            steam_recent_games = $('.steam-id-recent-games'),
            find_recent_games_button = $('#find-recent-games'),
            steam_recent_button_text = $('#find-recent-games-text'),
            valid = true;
                
        steam_id_button_text.text('Searching... ');
        find_steam_info_button.prop('disabled', true);
        find_steam_info_button.find('.fa-spin').css("visibility", "visible");
        find_steam_info_button.closest('.module-body').find('.alert').hide();
                        
        if(steam_user_id == "") {
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
                        steam_id_game_div.empty(); //remove the previous steam game results
                        results_steam_avatar.removeAttr('src'); //remove the image from the previous steam id results
                        results_steam_avatar_frame.removeAttr('src');
                        results_game_header.removeAttr('src'); // ""
                        
                        //reenable the recent games button if they click it and then click "find steam account" button
                        find_recent_games_button.closest('.module-body').find('.alert').hide();
                        find_recent_games_button.find('.fa-spin').css("visibility", "hidden");
                        find_recent_games_button.prop('disabled', false);
                        steam_recent_button_text.text('Find Recent Games');
                        
                        General.settings.global_steam_id = data.steam_data['json_steam_id64']; //set steam id in global variable
                        
                        steam_avatar_div.css({'display' : 'inline-block'});                        
                        steam_id_results_div.css({'display' : 'inline-block'});
                        
                        //display steam id results
                        if("json_avatar_frame" in data.steam_data) {
                            results_steam_avatar.css("border-style", "none");
                            results_steam_avatar_frame.attr('src', data.steam_data['json_avatar_frame']);
                        } else {
                            results_steam_avatar.css("border-style", "ridge");
                        }
                        
                        results_steam_avatar.attr('src', data.steam_data['json_avatar_full']);
                        steam_avatar_link.attr('href', "https://steamcommunity.com/profiles/"+data.steam_data['json_steam_id64']);
                        
                        if("json_real_name" in data.steam_data) {
                            steam_id_results_div.append("<h3 id='steam-name'>"+data.steam_data['json_person_name']+"<span id='steam-real-name' class='text--colour-grey'> ("+data.steam_data['json_real_name']+")</span></h3>");
                        } else {
                             steam_id_results_div.append("<h3 id='steam-name'>"+data.steam_data['json_person_name']+"</h3>");
                        }
                       
                        
                        if("json_persona_state" in data.steam_data) {
                            if(data.steam_data['json_persona_state'] === "Online") {
                                steam_id_results_div.append("<p><i class='fas fa-circle fa-circle-online'></i><span id='steam-user-status'> "+data.steam_data['json_persona_state']+"</span></p>");
                            } else {
                                steam_id_results_div.append("<p><i class='fas fa-circle fa-circle-offline'></i><span id='steam-user-status'> "+data.steam_data['json_persona_state']+"</span></p>");
                            }
                        }
                        
                        if("json_time_created" in data.steam_data) {
                            steam_id_results_div.append("<p><i class='fas fa-calendar-alt'></i><span id='steam-data-created' data-toggle='tooltip' data-placement='right' title='"+data.steam_data['json_time_created_full']+" (UTC)'> "+data.steam_data['json_time_created']+"</span></p>");
                        }

                        //display city, state and country names "json_location_coordinates" in data.steam_data
                        if("json_city_name" in data.steam_data && "json_location_coordinates" in data.steam_data) {
                            steam_id_results_div.append("<p><i class='fas fa-map-marker-alt'></i> <a class='hyperlink' target='_blank' href='https://www.google.co.uk/maps/place/@"+data.steam_data['json_location_coordinates']+",12z'><span id='steam-user-city'>"+data.steam_data['json_city_name']+", </span><span id='steam-user-state'>"+data.steam_data['json_state_name']+", </span><span id='steam-user-country'>"+data.steam_data['json_country_name']+"</span></a><span id='steam-user-country-code' class='text--colour-grey'> ("+data.steam_data['json_country_code']+")</span></p>");
                            
                        //display state, and country name
                        } else if("json_state_name" in data.steam_data && "json_location_coordinates" in data.steam_data) {
                            steam_id_results_div.append("<p><i class='fas fa-map-marker-alt'></i> <a class='hyperlink' target='_blank' href='https://www.google.co.uk/maps/place/@"+data.steam_data['json_location_coordinates']+",12z'><span id='steam-user-state'> "+data.steam_data['json_state_name']+", </span><span id='steam-user-country'>"+data.steam_data['json_country_name']+"</a></span><span id='steam-user-country-code' class='text--colour-grey'> ("+data.steam_data['json_country_code']+")</span></p>");
                            
                        //display country name
                        } else if("json_country_name" in data.steam_data) {
                            steam_id_results_div.append("<p><i class='fas fa-map-marker-alt'></i> <a class='hyperlink' target='_blank' href='https://www.google.co.uk/maps/place/"+data.steam_data['json_country_name']+"'><span id='steam-user-country'> "+data.steam_data['json_country_name']+"</a></span><span id='steam-user-country-code' class='text--colour-grey'> ("+data.steam_data['json_country_code']+")</span></p>");
                        } 
                        //display unknown text
                        else {
                            steam_id_results_div.append("<p><i class='fas fa-map-marker-alt'></i><span id='steam-user-location-unknown'> Location Unknown</span></p>");
                        }
                        
                        if("json_current_game_name" in data.steam_data) {
                            steam_id_game_div.css({'display' : 'inline-block'});
                            
                            $('#steam-user-status').append(" - In Game");
                            steam_id_game_div.append("<a target=_blank href='https://store.steampowered.com/app/"+data.steam_data['json_current_game_id']+"'><img alt='Game Store Banner' id='steam-id-game-image' src='"+data.steam_data['json_current_game_image']+"'</a>");
                            steam_id_game_div.append("<p class='text--colour-grey'>Currently Playing: "+data.steam_data['json_current_game_name']+"</p>");
                            
                            if("json_current_game_lobby_id" in data.steam_data) {
                                steam_id_game_div.append("<span><a href='steam://joinlobby/"+data.steam_data['json_current_game_id']+"/"+data.steam_data['json_current_game_lobby_id']+"/"+data.steam_data['json_steam_id64']+"' class='btn btn-success' role='button'>Join Game Lobby</a></span>");
                            } else if ("json_current_game_server_ip" in data.steam_data) {
                                steam_id_game_div.append("<span><a href='steam://connect/"+data.steam_data['json_current_game_server_ip']+"' class='btn btn-success' role='button'>Join Game Server</a></span>");
                            }  else {
                                steam_id_game_div.append("<span style='cursor: not-allowed;' class='btn btn-danger disabled' role='button'>No Game Lobby/Server To Join</span>");
                            }
                        }

                        if("json_visibility_state" in data.steam_data) {
                            if(data.steam_data['json_visibility_state'] === 1) {
                                find_steam_info_button.closest('.module-body').find('.user-private').show();
                            } else {
                                find_steam_info_button.closest('.module-body').find('.user-found').show();
                            }
                        }
                        
                        find_steam_info_button.closest('.module-body').find('.user-images').show();
                    } else {
                        find_steam_info_button.closest('.module-body').find('.user-not-found').show();
                    }
                    
                    $(".user-found").click(function() {
                        $(".user-found").fadeOut( "slow" );
                    });
                    
                    $(".user-private").click(function() {
                        $(".user-private").fadeOut( "slow" );
                    });
                    
                    $(".user-images").click(function() {
                        $(".user-images").fadeOut( "slow" );
                    });
                      
                    steam_recent_games.css({'visibility' : 'visible'});
                    steam_id_button_text.text('Find Steam Account');
                    find_steam_info_button.find('.fa-spin').css("visibility", "hidden");
                    find_steam_info_button.prop('disabled', false);
                },
                error: function(data) {
                    if(data.status === 400) {
                        find_steam_info_button.closest('.module-body').find('.user-not-found').show(); //will show if the user enters anything other than a steamid/url
                    } else if (data.status === 500) {
                        find_steam_info_button.closest('.module-body').find('.general-error').show(); //will show if there was an error finding a user with the steamid/url provided
                    }
                
                    steam_id_button_text.text('Find Steam Account');
                    find_steam_info_button.find('.fa-spin').css("visibility", "hidden");
                    find_steam_info_button.prop('disabled', false);
                }
            });
        }     
    },
    
    
    fineRecentGames: function(e) {
        
        e.preventDefault();
        
        var payload = new FormData(),
            find_recent_games_button = $('#find-recent-games'),
            steam_recent_button_text = $('#find-recent-games-text'),
            global_steam_id = General.settings.global_steam_id,
            valid = true;
        
        steam_recent_button_text.text('Searching... ');
        find_recent_games_button.prop('disabled', true);
        find_recent_games_button.find('.fa-spin').css("visibility", "visible");
        find_recent_games_button.closest('.module-body').find('.alert').hide();
        
        if(global_steam_id == "") {
            valid = false;
        }
        
        if(!valid) {
            find_recent_games_button.closest('.module-body').find('.empty-id').show();
            find_recent_games_button.find('.fa-spin').css("visibility", "hidden");
            find_recent_games_button.prop('disabled', false);
            steam_recent_button_text.text('Find Recent Games');
        } else {
            payload.append("steam_id", global_steam_id);
            
            $.ajax({
                url: General.settings.api_url+'/steam/findrecentgames',
                type: 'POST',
                data: payload,
                cache: false,
                contentType: false,
                processData: false,
                success:function(data) {
console.log(data);
                    if(data.status === 200) {
                        jQuery.each(data.steam_data, function(index, response) {
console.log("Game: "+response.json_game_name);
console.log("Recent Hours: "+response.json_recent_hours+" hours");
console.log("Total Hours: "+response.json_total_hours+" hours");
                        });
                    } else {
                        find_recent_games_button.closest('.module-body').find('.user-not-found').show();
                    }
                    
                    $(".user-found").click(function() {
                        $(".user-found").fadeOut( "slow" );
                    });
                    
                    $(".user-private").click(function() {
                        $(".user-private").fadeOut( "slow" );
                    });
                    
                    $(".user-images").click(function() {
                        $(".user-images").fadeOut( "slow" );
                    });
                      
                    steam_recent_button_text.text('Find Recent Games');
                    find_recent_games_button.find('.fa-spin').css("visibility", "hidden");
                    find_recent_games_button.prop('disabled', false);
                },
                error: function(data) {
                    if(data.status === 400) {
                        find_recent_games_button.closest('.module-body').find('.user-not-found').show(); //will show if the user enters anything other than a steamid/url
                    } else if (data.status === 500) {
                        find_recent_games_button.closest('.module-body').find('.general-error').show(); //will show if there was an error finding a user with the steamid/url provided
                    }
                    steam_recent_button_text.text('Find Recent Games');
                    find_recent_games_button.find('.fa-spin').css("visibility", "hidden");
                    find_recent_games_button.prop('disabled', false);
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