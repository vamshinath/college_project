
#pip3 install -U git+git://github.com/guptarohit/smspy.git
from smspy import Way2sms
import datetime,time
timenow=datetime.datetime.now().strftime('%H:%M:%S')

def send_sms(to,msg):
	w2s = Way2sms()

	w2s.login(9603559140, 56811865)

	w2s.send(to, msg+timenow)
	time.sleep(30)
	w2s.logout()
