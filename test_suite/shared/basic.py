from datetime import datetime
import time
from sys import platform

def get_timestamp():
	yr, month, day, hr, minute = map(int, time.strftime("%Y %m %d %H %M").split())
	return "{}_{}_{}_{}_{}".format(yr, month, day, hr, minute)

def is_linux():
	if platform == "linux" or platform == "linux2":
		return True
	return False

def is_windows():
	if platform == "win32" or platform == "Win32":
		return True
	return False 
