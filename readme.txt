Hello.
First of all, you need web-server with php support (or just php-cli with sockets - from mywebplayer 1.2 we have php-based web-server;)) ), bash, mkfifo utilite and console-based mplayer (http://mplayerhq.hu).
For detailed instruction for your OS, please go to http://ru-shell.livejournal.com/8715.html and ask there. I'll try to answer any your question.

With best regards, Daniel Grohman.

-------------------------
How to...

Edit config.php:
Add correct path to your audio/video-collection at $rootDir

Edit $MASK-array - add your file-types if you need ;-)

cd sh && ./fifo.sh start
and follow instructions...

To stop it run "./fifo.sh stop"

Enjoy ;-)

