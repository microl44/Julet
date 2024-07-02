import os
import sys
import subprocess
import ctypes
import glob
import re
import time

cases = []

test_suite = "C:/xampp/htdocs/Julet/test_suite"
if not os.path.exists(test_suite):
    os.mkdir(test_suite)

if len(sys.argv) >= 2:
	for arg in sys.argv[1:]:
		if arg.isnumeric():
			cases.append(arg)
else:
	for file in os.listdir(test_suite):
		try:
			cases.append(re.search(r'(\d+)\D+$', file).group(1))
		except AttributeError as e:
			pass 

print("Following cases will be run:")
print(*cases)

yr, month, day, hr, minute = map(int, time.strftime("%Y %m %d %H %M").split())
timestamp = "{}_{}_{}_{}_{}".format(yr, month, day, hr, minute)
test_res = os.path.join(os.getcwd(), "test_res", timestamp)

if not os.path.exists(test_res):
	os.makedirs(test_res)

for case in cases:
	filepath = test_suite + "/test_" + case + ".py"
	res = subprocess.check_output(["python", filepath])
	print(res.decode('utf-8'))

error_sources = []
for file in os.listdir(test_res):
	with open(filepath.rsplit('/', 1)[0] + "/test_res/" + timestamp + "/" + file, 'r') as f:
		for line in f:
			if f.name in error_sources:
				break 
			if "FAIL:" in line or "ERROR:" in line:
				error_sources.append(f.name)

if len(error_sources) > 0:
	print("The following test failed:")
	for source in error_sources:
		print(source.rsplit('/')[-1][3:6])