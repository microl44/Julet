import os
import sys
import subprocess
import ctypes

cases=['01','02', '03']

if not os.path.exists("C:/xampp/htdocs/Julet/test_suite"):
    os.makedirs("C:/xampp/htdocs/Julet/test_suite")

for case in cases:
	cmd = "python C:/xampp/htdocs/Julet/test_suite/test_" + case + ".py"
	os.system("start /wait cmd /c {}".format(cmd))