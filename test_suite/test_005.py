#!Title:Case 005
#!Description:Test race condition and time of database fetching

from shared.index import Index as index
import shared.tc_lib as tclib
import shared.imports as c
import time

def testcase(test):
	#>Pre-test environment check
	tclib.check_connection(test)


	for x in range(10):
		#>open browser to index.php
		test.load()

		#>Check if database correctly fetches information (cells will equals '...' if not)
		#>Do this 10 times
		if test.wait_for_database(10):
			tclib.write_log(test.filename, ["LOG: Data was fetched from database..."])
		else:
			raise Exception("Table was not correctly updated from database.")
		time.sleep(1)
	tclib.write_log(test.filename, ["PASS: Test Passed."])
try:
	test = index('TC_005')
	testcase(test)
	tclib.write_log(test.filename, ["TEST COMPLETED..."])

except Exception:
	import traceback
	tclib.log_error(test.filename, ["ERROR: " + str(traceback.format_exc())])