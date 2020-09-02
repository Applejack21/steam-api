@section('title', 'Steam Account Lookup')
@extends('layouts.master')
@section('content')
    <body class="dash-homepage">
        <h1>Steam Account Lookup</h1>
        <p>Want to know information about your Steam statistics? Type in your Steam ID number below!</p>
        <div class="module-body">
            <form class="form-horizontal row-fluid" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                    <div class="control-group">
                        <label class="control-label" for="steam-user-id">Steam ID:</label>
                        <div class="controls row-fluid">
                            <input type="text" id="steam-user-id">
                        </div>
                    </div><br>
                    <div class="control-group">
                        <button type="submit" class="btn btn-primary" name="submitBtn" id="find-steam-id">   
                            <i class="fas fa-search"></i>
                            Find Steam Stats
                            <i class="fas fa-spinner fa-spin" style="visibility:hidden;"></i>
                        </button>
                    </div>
                </div>
            </form><br>
            <div class="alert alert-danger general-error" style="display:none;"><strong>Warning!</strong> Something went wrong, please try again.</div>
            <div class="alert alert-danger empty-id" style="display:none;"><strong>Warning!</strong> Please enter a Steam ID.</div>
            <div class="alert alert-danger user-not-found" style="display:none;"><strong>Warning!</strong> User not found. Please enter a valid Steam ID.</div>
            <div class="alert alert-success user-found" style="display:none;"><strong>Success!</strong> User found!</div>
        </div>
        
        <div class="steam-id-results" style="display:none;">
            <h3 id="steam-name"></h3>
            <img id="steam-avatar" alt="steam avatar">
            <p id="steam-user-status"></p>
            <p id="steam-real-name"></p>
            <p id="steam-created"></p>
            <p id="steam-country"></p>
        </div>
        
        <div class="how-to-find-steam-id" style="display:inline-block;">
            <h2><u>How to find your Steam ID</u></h2>
            <p>Finding your Steam ID number depends on your Steam profile URL properties.</p>
            <div class="how-to-find-noncustom-url">
                <h4><u>Non-custom Steam profile URL</u></h4>
                <p>If you don't have a custom Steam profile URL, then your Steam ID will be the digits at the end of your Steam profile URL.</p>
                <p>e.g. <i>https://steamcommunity.com/id/123456789...</i></p>
            </div>
            
            <div class="how-to-find-custom-url">
                <h4><u>Custom Steam profile URL</u></h4>
                <p>If you have a custom Steam profile URL, this will be a little different. Follow the steps below to find your Steam ID.</p>
                <ol>
                    <li>Copy your custom Steam profile URL, e.g. <i>https://steamcommunity.com/id/customsteamurl</i></li>
                    <li>Go to <a class="hyperlink" target="_blank" href="https://steamid.io/">steamid.io</a> and enter your URL and click "lookup"</li>
                    <li>Copy your "steamID64" and paste it into the textbox at the top of this page.</li>
                </ol>
            </div>
        </div>
        <div id="end-row"><br><br><br></div>
    </body>
@endsection