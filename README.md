## Steam User Profile Getter Thingamajig

This uses the Steam User Stats (https://developer.valvesoftware.com/wiki/Steam_Web_API) API to display information about Steam users.

This is being built using Laravel. Currently using Laravel 8.x.

Basic information to show
-
- [x] Display basic information:
    - [x] Account name.
    - [x] Account avatar.
    - [x] Account creation date.
    - [x] Current location.
    - [x] Current game they're playing.
- [x] Link to Steam Store page of currently playing game.
- [ ] Price in GBP.
- [x] "Join Game" button.

Later information to show
-
- [ ] Display user's game information (last 2 weeks):
    - [ ] Recently played games 
    - [ ] Total hours played per game
    - [ ] Achievements in these games
    
* Display user's stats of games:
    + TF2 Stats - Total time played per class, buildings destroyed per class etc...
    + CSGO Stats - Total enemies killed, Total deaths, Wins, Stats per weapon (?).
    + Dota Stats - Total enemies killed, Total deaths, Wins, Stats per hero (?).
    + More games to be added later in development.

**(Above to do list will most likely change as development goes on).**

Afterwards
-
Once I've completed the to-do list, I'll change the JavaScript to be using React/Vue/Angular instead of jQuery/plain JavaScript. As well as change the CSS to be SCSS.
Also do some code cleanups to make the requests faster.
