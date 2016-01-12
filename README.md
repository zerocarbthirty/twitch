# twitch

I created this because I wanted to learn how it worked, I realize there are easier options for getting your oauth token.

In order to get an access_token to connect to Twitch follow these steps.

<h1>Step 1</h1>

Note: I do not recommend performing these steps in Firefox because the client secret does not show up when I try it.

Login to the Twitch account you wish to use<br>
Go to Settings >> Connections<br>
At the bottom of the settings page click 'Register your application'<br>
Enter any name for your application and then http://yourwebsite.com/oauth.php for the redirect URI, click register<br>
Note the client id and client secret for use in step 2.<br>

<h1>Step 2</h1>

Edit oauth.php and enter the client id and client secret from Step 1 <br>
$client_id = "Your twitch client id";<br>
$client_secret = "Your twitch client secret";<br>
$redirect_uri = "http://www.yourwebsite.com/oauth.php";

Upload oauth.php to your website.

<h1>Step 3</h1>

in the link below replace the client_id and redirect_uri parameters with the values found earlier.

https://api.twitch.tv/kraken/oauth2/authorize?response_type=code&client_id=client_id&redirect_uri=redirect_uri&scope=chat_login&state=whatever

Copy and paste the link into any browser.

If you did everything properly, Twitch should come up and ask you to authorize your own App to use your Twitch account.

After you authorize your own app to use your twitch account the script you uploaded to your server should simply say:

Your oauth token is: [random string starting with oauth:]

If this doesn't work check your settings and then visit the Twitch auth URL above to try again.

How is this useful?

Now you can connect to your channel with any standard IRC client (Such as MIRC) or use most standard IRC bots such as eggdrop to manange your channel.

<h1>Test!</h1>
C:\Users\tutorial>telnet irc.twitch.tv 6667
PASS <an actual oauth token goes here>
NICK zerocarbthirty
:tmi.twitch.tv 001 zerocarbthirty :Welcome, GLHF!
:tmi.twitch.tv 002 zerocarbthirty :Your host is tmi.twitch.tv
:tmi.twitch.tv 003 zerocarbthirty :This server is rather new
:tmi.twitch.tv 004 zerocarbthirty :-
:tmi.twitch.tv 375 zerocarbthirty :-
:tmi.twitch.tv 372 zerocarbthirty :You are in a maze of twisty passages, all alike.
:tmi.twitch.tv 376 zerocarbthirty :>
quit

Eureka!


