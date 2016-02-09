# imageserve

A ShareX image hosting solution for your own domain.

## application setup

[**Video tutorial here**](https://www.youtube.com/watch?v=GtN79l5AGvQ)

* Drag the contents of the `public/` directory into your webserver (in a folder, if you desire)
* Configure the options in the `public/protected/config/config.php` file
* Ensure the `public/images/` directory is writable by the web server

If you're having issues with setting up on IIS, please see [**here**](https://github.com/aerouk/imageserve/wiki/IIS-Issues).

## ShareX setup

Below is an example of how ShareX should be configured to work with imageserve. Obviously, you'll need to change the 'password' POST field to whatever you set it to in your config.php file, and also the URL at which imageserve is hosted. In my example, it's set to http://imageserve/.

example: http://i.imgur.com/KKiaBLd.png

Regex from response: [^,]*$
URL: http://your.domain/$1$

setting up on the server

Drag contents of downloaded zip file into your preferred directory.
Setup config file according to your preferences.
Set write permissions in the directory /public/i for your web server user (or just 777 if you're really lazy) recursively.
If you have problems with this, consult Google.
