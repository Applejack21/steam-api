@section('title', 'Steam Account Lookup')
@extends('layouts.master')
@section('content')

    <body class="dash-homepage">
        <div class="account-page-heading">
            <h1>Steam Account Lookup</h1>
            <h4>Want to know information about a Steam account? Type in their Steam ID/Steam URL below!</h4>
        </div>
        <div class="module-body form form--padding-top">
            <form class="form-horizontal row-fluid" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                    <div class="control-group">
                        <div class="controls row-fluid">
                            <input type="text" id="steam-user-id-input-box" class="input--border-curved input--font-large" placeholder="Enter Steam ID/Steam URL here...">
                        </div>
                    </div><br>
                    <div class="control-group find-steam-id-button" style="margin-bottom:10px;">
                        <button type="submit" class="btn btn-primary" name="submitBtn" id="find-steam-id">   
                            <i class="fas fa-search"></i>
                                <span id="find-steam-id-button-text">Find Steam Account</span>
                            <i class="fas fa-spinner fa-spin" style="visibility:hidden;"></i>
                        </button>
                    </div>
                </div>
            </form>
            <div class="alert alert-danger general-error" style="display:none;"><strong>Warning!</strong> Something went wrong. Please make sure you've entered a valid Steam ID/Steam URL. And if so, check <a href="https://steamstat.us/" target="_blank">steamstat.us</a> to see if the "Steam Web API" is up and running.</div>
            <div class="alert alert-danger empty-id" style="display:none;"><strong>Warning!</strong> Please enter a Steam ID/Steam URL.</div>
            <div class="alert alert-danger user-not-found" style="display:none;"><strong>Warning!</strong> Please enter a valid Steam ID/Steam URL.</div>
            <div class="alert alert-success user-found" style="display:none;"><strong>Success!</strong> User found! -<strong> Click to dismiss.</strong></div>
            <div class="alert alert-info user-private" style="display:none;"><strong>Success!</strong> User found!<strong> However,</strong> This user's profile is private resulting in limited information. If this is your profile, you can change your Steam profile's "Privacy Settings". Privacy settings take time to update so try again later. -<strong> Click to dismiss.</strong></div>
            <div class="alert alert-secondary user-images" style="display:none;">Click the images to visit their respective pages. -<strong> Click to dismiss.</strong></div>
        </div><hr><br>
        
    <div class="steam-overall-results">
        <div class="steam-avatar-div" style="display:none;">
            <a id="steam-avatar-link" target=_blank>
                <img id="steam-avatar-frame" alt="">
                <img id="steam-avatar" alt="Steam Avatar">
            </a>
        </div>
        <div class="steam-id-user-game-results">
            <div class="steam-id-results-div" style="display:none;"></div>
            <div class="steam-id-game-div" style="display:none;"></div>
        </div>
    </div>
    <br>
        
    <div class="steam-id-recent-games">
        <div class="recent-games-heading">
            <hr>
            <h3>Recent Games</h3>
            <h5>Click the button below to find information about the recent games this user has played.</h5>
            <div class="module-body form form--padding-top">
                <form class="form-horizontal row-fluid" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="control-group find-recent-games-button" style="margin-bottom:10px;">
                            <button type="submit" class="btn btn-primary" name="submitBtn" id="find-recent-games">   
                                <i class="fas fa-search"></i>
                                    <span id="find-recent-games-text">Find Recent Games</span>
                                <i class="fas fa-spinner fa-spin" style="visibility:hidden;"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="end-row"><br><br><br></div>
    </body>
@endsection