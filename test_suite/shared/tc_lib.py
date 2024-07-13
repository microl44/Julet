import time
import os
import glob
"""
File used for handling meta-related events regarding test.
Examples being logging, checking connection and 
"""

def pre_test():
	pass

def log_error(filename, error):
	with open(filename, 'a+') as file:
		for line in error:
			file.write(line + '\n')
		file.close()

def get_timestamp():
	yr, month, day, hr, minute, second = map(int, time.strftime("%Y %m %d %H %M %S").split())
	return "{}:{}:{} ".format(hr, minute, second)

def	folder_exists(folder):
	if not os.path.exists(folder):
		return False

def folder_create(folder):
	if not os.path.exists(folder):
		os.mkdir(folder)

def get_log_folder():
	mypath ="test_res"
	last_directory= max([dir for dir in glob.glob \
		(mypath + r'\*', recursive=False) if os.path.isdir(dir)], key=os.path.getmtime)
	return last_directory

def write_log(filename, msg):
	if type(msg) == "string":
		msg = [msg]
	with open(filename, 'a+') as file:
		file.write(str(get_timestamp()))
		for line in msg:
			file.write(": " + line + '\n')
		file.close()

def check_connection(deal_with_it = None):
	return