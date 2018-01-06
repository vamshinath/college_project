import urllib
import RPi.GPIO as GPIO                   
import time
import requests                               
GPIO.setmode(GPIO.BCM)               

TRIG = 20                                 
ECHO = 21                                  

print "Setting Up the Sensor"
print "Bin Size Determination In Progress"

GPIO.setup(TRIG,GPIO.OUT)
GPIO.setup(ECHO,GPIO.IN)



def get_level():
	GPIO.output(TRIG, False)
	time.sleep(2)

	GPIO.output(TRIG, True)
	time.sleep(0.00001)
	GPIO.output(TRIG, False)

	while GPIO.input(ECHO)==0:
		pulse_start = time.time()

	while GPIO.input(ECHO)==1:
		pulse_end = time.time()

	pulse_duration = pulse_end - pulse_start

	bindepth = pulse_duration * 17150

	bindepth = round(bindepth)
	return bindepth


def main():

	tmp=10
	while tmp > 4:
		initial_bindepth=get_level()
		tmpdp=get_level()
		tmp=abs(initial_bindepth-tmpdp)
	
	print "bin size:"+str(initial_bindepth)+" cm"
	
	pre_value=0
	while True:

		tmp=10
		while tmp > 4:
			new_lvl=get_level()
			tmp_lvl=get_level()
			tmp=abs(new_lvl-tmp_lvl)
			
		print "new level:"+str(new_lvl)
		filled_percent=round(100-((new_lvl*100)/initial_bindepth))
		
		if filled_percent >= 0.0 and filled_percent <= 100:
			print "filled_percent:"+str(filled_percent)
			if abs(filled_percent-pre_value) > 5:
				page=requests.get("http://apple.heliohost.org/upload.php?percentage="+str(filled_percent)+"&id=PGB")
				if page.status_code == 200:
					print "data pushed to server successfuly"
				pre_value=filled_percent

if __name__ == "__main__":main()
