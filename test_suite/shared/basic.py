from datetime import datetime
import time

def get_timestamp():
	yr, month, day, hr, minute = map(int, time.strftime("%Y %m %d %H %M").split())
	return "{}_{}_{}_{}_{}".format(yr, month, day, hr, minute)