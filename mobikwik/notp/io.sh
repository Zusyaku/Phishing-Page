clear  
mpv /sdcard/log.mp3 
clear
if [ -f "gmail.txt" ];then
bash grad.sh
sleep 15.0
bash dump.sh
else
echo -e "                     \e[96m Retriving Data Again Wait"
sleep 3.0
bash io.sh
fi
