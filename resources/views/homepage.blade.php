@section('title', 'Steam Account Lookup')
@extends('layouts.master')
@section('content')

    <body class="dash-homepage">
        <div class="account-page-heading">
            <h1>Steam Account Lookup</h1>
            <h4>Want to know information about your Steam account? Type in your Steam ID below!</h4>
            <p>Don't know what your Steam ID is? Click below to find out how.</p>
            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#findSteamIDModal">
                How to find your Steam ID
            </button>
        </div>
        <div class="modal fade" id="findSteamIDModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="findSteamIDModalLongTitle"><b>How to find your Steam ID</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Finding your Steam ID depends on your Steam profile URL.</p>
                        <div class="how-to-find-noncustom-url">
                            <h5><u>Non-custom profile URL</u></h5>
                            <p>If you don't have a custom profile URL, then your Steam ID will be the digits at the end of your profile URL.</p>
                            <p>e.g. <i>https://steamcommunity.com/id/123456789...</i></p>
                        </div>
                        <div class="how-to-find-custom-url">
                            <h5><u>Custom profile URL</u></h5>
                            <p>If you have a custom profile URL, then this will be a little bit different. Follow these steps to find your Steam ID:</p>
                            <ol>
                                <li>Copy your custom profile URL, e.g. <i>https://steamcommunity.com/id/customsteamurl</i></li>
                                <li>Go to <a class="hyperlink" target="_blank" href="https://steamid.io/">steamid.io</a> and enter your URL and click "lookup"</li>
                                <li>Copy your "steamID64" and paste it into the search box.</li>
                            </ol>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Got it!</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="module-body form form--padding-top">
            <form class="form-horizontal row-fluid" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                    <div class="control-group">
                        <div class="controls row-fluid">
                            <input type="text" id="steam-user-id-input-box" class="input--border-curved input--font-large" maxlength="17" placeholder="Enter Steam ID here...">  
                        </div>
                    </div><br>
                    <div class="control-group">
                        <button type="submit" class="btn btn-primary" name="submitBtn" id="find-steam-id">   
                            <i class="fas fa-search"></i>
                            <span id="find-steam-id-button-text">Find Steam Account</span>
                            <i class="fas fa-spinner fa-spin" style="visibility:hidden;"></i>
                        </button>
                    </div>
                </div>
            </form><br>
            <div class="alert alert-danger general-error" style="display:none;"><strong>Warning!</strong> Something went wrong. Please make sure you've entered a valid Steam ID. And if so, check <a href="https://steamstat.us/" target="_blank">steamstat.us</a> to see if the "Steam Web API" is up and running.</div>
            <div class="alert alert-danger empty-id" style="display:none;"><strong>Warning!</strong> Please enter a Steam ID.</div>
            <div class="alert alert-danger user-not-found" style="display:none;"><strong>Warning!</strong> Please enter a valid Steam ID. Steam IDs are digits only.</div>
            <div class="alert alert-success user-found" style="display:none;"><strong>Success!</strong> User found!</div>
        </div>
    
        <div class="steam-avatar-div" style="display:none;">
            <img id="steam-avatar" alt="steam avatar">
        </div>
        
        <div class="steam-id-results" style="display:none;padding-left:10px;">
            <h3 id="steam-name"></h3>
            <p id="steam-user-status"></p>
            <p id="steam-real-name"></p>
            <p id="steam-created"></p>
            <p id="steam-country"></p>
        </div>

        <div id="end-row"><br><br><br></div>
    </body>
@endsection