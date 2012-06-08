#!/bin/bash
myfiles=`pwd`;
fifo=${myfiles}/tmp/mplayer.fifo
log=${myfiles}/tmp/mplayer.log
pid=${myfiles}/tmp/mplayer.pid
webpid=${myfiles}/tmp/mplayerweb.pid
webport=1234;

start_webserver()
{
cd ${myfiles}/.. && ./phseudo.php ${webport}&
	if [ $? -gt 0 ]; then
	    echo "We can't start our web-server. You need to install php with socket support. Or, anyway, you can use Apache2 or nginx, or any other web-serv."
	fi
}

pid_webserver()
{
echo `ps ax| grep phseudo.php| grep -v grep| awk {'print $1'}` > $webpid
}

kill_webserver() 
{ 
	web_running=1;
	while [ "$web_running" != 0 ]; do
		if [ "`netstat -anl | grep tcp| grep "${webport}"`" != "" ]; then
		web_running=1; 
			for i in `ps ax | grep phseudo.php|grep -v grep| awk {'print $1'}`; do 
				kill -9 $i 1>&2 > /dev/null;
			done;
                        for i in `ps ax | grep common.php|grep -v grep| awk {'print $1'}`; do
                                kill -9 $i 1>&2 > /dev/null;
                        done;
			echo "Please wait, stopping web-server...";
			sleep 2;
			echo;
		else
			web_running=0;
		fi
	done
}

start_mplayer ()
{
if [ "`ps ax | grep mplayer| grep fifo`" = '' ]; then
		if [ `uname` != 'Linux' ]; then
			mplayer -msglevel all=-1 -idx -zoom -slave -quiet -idle -input file=$fifo > $log < /dev/null &
		else
			DISPLAY=:`ls -1 /tmp/.X11-unix/|tail -n 1|sed s/X//` mplayer -msglevel all=-1 -idx -zoom -slave -quiet -idle -input file=$fifo > $log < /dev/null  &
		fi
	
		echo "Mplayer started"
		echo -e "\033[32m\033[1A\033[40C [OK] \033[0m"
		echo `ps ax | grep mplayer| grep fifo|grep -v grep| awk {'print $1'}` > $pid
	else
		echo "Mplayer running"
	fi
}

stop_mplayer ()
{
        kill -9 `cat $pid`
                if [ "`ps ax | grep mplayer| grep fifo`" != '' ]; then
                for i in `ps ax | grep mplayer| grep fifo| grep -v fifo.sh| awk {'print $1'}`; do
                        kill -9 $i;
                done
                fi
        echo "Mplayer killed";
        echo -e "\033[32m\033[1A\033[40C [OK] \033[0m"
        echo 0 > $pid
}

status_mplayer ()
{
cur_pid=`cat ${pid}`;

	if [ "$cur_pid" = "0" ]; then 
		echo "Mplayer isn't running";
	else
		echo "Mplayer is running with pid $cur_pid";
	fi
}

wtd=$1

case $wtd in
start)
	touch $log
	if [ -w $fifo ]; then 
		echo "Fifo exists";
	else
		mkfifo -m 777 $fifo;
		chmod 777 ${myfiles}/tmp/mplayer.*;
		echo "FIfo created";
                echo -e "\033[32m\033[1A\033[40C [OK] \033[0m"
	fi

	start_webserver
	pid_webserver
	echo "Starting webserver on http://`uname -n`:${webport}";
	echo "Open it in browser";
	echo "";

	start_mplayer

        echo "daemonizing";   

	while true; do
		sleep 1
                if [ "`cat $pid`" = "0"  ]; then
                        exit 0
                fi
		if [ "`ps ax | grep mplayer| grep fifo|grep -v grep | awk {'print $1'}`" != "`cat $pid`" ]; then
			killall mplayer
			start_mplayer 1>&2 > /dev/null
		fi
        done&
        echo -e "\033[32m\033[1A\033[40C [OK] \033[0m"

;;
stop)
#kill -9 `cat $webpid`;
kill_webserver
stop_mplayer
        rm -f ${fifo};
        echo "Fifo deleted";
        echo -e "\033[32m\033[1A\033[40C [OK] \033[0m"

	for i in `ps ax | grep fifo.sh | awk {'print $1'}`; do
		kill -9 $i
	done
;;
status)
status_mplayer
;;

*)
        echo -e "\033[31m * \033[0m" "ERROR: wrong args ( $1 )"; 
echo
echo -e "\033[31m * \033[0m" "Usage: fifo.sh { start|stop|status } "
	
esac
