#!Title:Case 004
#!Description:Test fetching of table content

from shared.index import Index as index
import shared.tc_lib as tclib
import shared.imports as c
import time

def testcase(test):
	#>Pre-test environment check
	tclib.check_connection(test)

	#>open browser to index.php
	test.load()

	time.sleep(2)
	#>Login using username "micke" and password "password"
	test.login_to_page(["micke", "password"])
	time.sleep(2)

	#>Check that the number of temp rows equals 10 (number of entries shown per page)
	if test.get_number_of_elements("tableRow") < 10:
		tclib.write_log(test.filename, ["FAIL: Wrong number of table rows."])
	else:
		tclib.write_log(test.filename, ["PASS: Correct number of table rows."])

	#>Press previous page before the result has been loaded
	test.click_element("prevPageBtn", False)

	#>wait for database to fetch data and update group movie table
	if test.wait_for_database(30):
		tclib.write_log(test.filename, ["PASS: Data was fetched from database..."])
	else:
		tclib.write_log(test.filename, ["FAIL: Data was not fetched from database before timing out..."])

	#>Check that the group movie table ID column values are in sequence, from 1 to the number of group movie entries in the database.
	#>Press next page after checking the currently shown IDs
	entries = 48
	itterator = 1
	try:
		for row in test.get_table():
			if str(row.split(' ')[0]) != str(itterator):
				tclib.write_log(test.filename, ["FAIL: ID columns did not match expected values...\nItterator: " + str(itterator) + "\nValue: " + str(row.split(' ')[0])])
				raise Exception ("Testing")
			if itterator < entries: itterator = itterator + 1
		#tclib.write_log(test.filename, ["LOG: Finished checking movie table page."])
		test.press_movie_table_next_btn()

		for row in test.get_table():
			if str(row.split(' ')[0]) != str(itterator):
				tclib.write_log(test.filename, ["FAIL: ID columns did not match expected values...\nItterator: " + str(itterator) + "\nValue: " + str(row.split(' ')[0])])
			if itterator < entries: itterator = itterator + 1
		#tclib.write_log(test.filename, ["LOG: Finished checking movie table page."])
		test.press_movie_table_next_btn()

		for row in test.get_table():
			if str(row.split(' ')[0]) != str(itterator):
				tclib.write_log(test.filename, ["FAIL: ID columns did not match expected values...\nItterator: " + str(itterator) + "\nValue: " + str(row.split(' ')[0])])
			if itterator < entries: itterator = itterator + 1
		#tclib.write_log(test.filename, ["LOG: Finished checking movie table page."])
		test.press_movie_table_next_btn()

		for row in test.get_table():
			if str(row.split(' ')[0]) != str(itterator):
				tclib.write_log(test.filename, ["FAIL: ID columns did not match expected values...\nItterator: " + str(itterator) + "\nValue: " + str(row.split(' ')[0])])
			if itterator < entries: itterator = itterator + 1
		#tclib.write_log(test.filename, ["LOG: Finished checking movie table page."])
		test.press_movie_table_next_btn()

		for row in test.get_table():
			if str(row.split(' ')[0]) != str(itterator):
				tclib.write_log(test.filename, ["FAIL: ID columns did not match expected values...\nItterator: " + str(itterator) + "\nValue: " + str(row.split(' ')[0])])
			if itterator < entries: itterator = itterator + 1
		#tclib.write_log(test.filename, ["LOG: Finished checking movie table page."])
		test.press_movie_table_next_btn()
	except Exception:
		raise Exception("ERROR: Checking Group movie table ID test failed")

	#>Switch movie table to Marvel Movies.
	test.switch_active_table("Marvel", 3)

	#>Check that the marvel movie table ID column values are in sequence, from 1 to the number of marvel movie entries in the database.
	#>Press next page after checking the currently shown IDs
	entries = 41
	itterator = 1
	try:
		for row in test.get_table():
			if str(row.split(' ')[0]) != str(itterator):
				tclib.write_log(test.filename, ["FAIL: ID columns did not match expected values...\nItterator: " + str(itterator) + "\nValue: " + str(row.split(' ')[0])])
				raise Exception ("Testing")
			if itterator < entries: itterator = itterator + 1
		test.press_movie_table_next_btn(3)

		for row in test.get_table():
			if str(row.split(' ')[0]) != str(itterator):
				tclib.write_log(test.filename, ["FAIL: ID columns did not match expected values...\nItterator: " + str(itterator) + "\nValue: " + str(row.split(' ')[0])])
				raise Exception ("Testing")
			if itterator < entries: itterator = itterator + 1
		test.press_movie_table_next_btn(3)

		for row in test.get_table():
			if str(row.split(' ')[0]) != str(itterator):
				tclib.write_log(test.filename, ["FAIL: ID columns did not match expected values...\nItterator: " + str(itterator) + "\nValue: " + str(row.split(' ')[0])])
				raise Exception ("Testing")
			if itterator < entries: itterator = itterator + 1
		test.press_movie_table_next_btn(3)

		for row in test.get_table():
			if str(row.split(' ')[0]) != str(itterator):
				tclib.write_log(test.filename, ["FAIL: ID columns did not match expected values...\nItterator: " + str(itterator) + "\nValue: " + str(row.split(' ')[0])])
				raise Exception ("Testing")
			if itterator < entries: itterator = itterator + 1
		test.press_movie_table_next_btn(3)
	except Exception:
		raise Exception("ERROR: Checking Marvel movie table ID test failed")

	try:
		#>Switch movie table to Marvel Movies.
		test.switch_active_table("Marvel", 3)
	except Exception:
		raise Exception("ERROR: Checking Solo movie table ID test failed")

try:
	test = index('TC_004')
	testcase(test)
	tclib.write_log(test.filename, ["TEST COMPLETED..."])

except Exception:
	import traceback
	tclib.log_error(test.filename, ["ERROR: " + str(traceback.format_exc())])