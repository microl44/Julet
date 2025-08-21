import subprocess
import os

db_password = os.getenv('DB_PASSWORD')
db_username = os.getenv('DB_USERNAME')
db_name = os.getenv('DB_NAME')

if db_password == "":
	exit("Set env variable DB_PASSWORD to root database password and try again.")
if db_username == "":
	db_username = "root"
	print("NO DB USERNAME USED. USING DEFAULT ROOT.")
if db_name == "":
	db_name = "jul"
	print("NO DB NAME GIVEN. USING DEFAULT JUL.")

def run_command(cmd):
	proc = subprocess.Popen(cmd, shell=True, stdout=subprocess.PIPE, stderr=subprocess.PIPE)
	return [proc.stdout.read(), proc.stderr.read()]

res = run_command(f"mysql -u {db_username} -p{db_password} -e \"use {db_name}; select table_name from information_schema.tables where table_schema = '{db_name}';\"")
if res[1]:
	print(res[1])
elif res[0]:
	decoded_res = res[0].decode('utf-8')
	cleaned_res = decoded_res.split('\r\n')[1:-1]

	for table in cleaned_res:
		print("#############################################")
		print(("#".ljust(15, ' ') + table).ljust(44, ' ') + "#")
		print("#############################################")
		res = run_command(f"mysql -u {db_username} -p{db_password} -e \"use {db_name}; describe " + table + "\"")
		if res[1]:
			print(res[1])
			exit()
		elif res[0]:
			decoded_res = res[0].decode('utf-8')[:]
			print(decoded_res)