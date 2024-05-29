from datetime import datetime

def pre_test():
	pass

def log_error(filename, error):
	with open(filename, 'a+') as file:
		for line in error:
			file.write(line + '\n')
		file.close()

def write_log(filename, msg):
	with open(filename, 'a+') as file:
		for line in msg:
			file.write(line + '\n')
		file.close()

def check_connection(deal_with_it = None):
	return