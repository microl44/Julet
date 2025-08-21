#!Title:Case 001
#!Description:Test regarding adding and deleting jul sections and spinning a jul for a custom duration.

from shared.jul import Jul as jul
import shared.tc_lib as tclib
import shared.imports as c

def testcase(test):
	#>Pre-test environment check
	tclib.check_connection(test)

	#>open browser
	test.load()
	#>Click Jul-Jul in navbar to go to jul.php page.
	test.change_page(test.page_type)
	#>Login using username "micke" and password "password"
	test.login_to_page(["micke", "password"])

	if not test.is_logged_in():
		txlib.write_log(test.filename, ["ERROR: Was not correctly logged in..."])

	#>Add 4 rows
	for _ in range(4):
		test.add_row()

	if not test.get_number_of_elements("inputBox") == 5:
		tclib.write_log(test.filename, ["ERROR: Wrong number of sections."])
	tclib.write_log(test.filename, ["PASS: CORRECT NUMBER OF SECTIONS (5)"])

	#>Delete and apply changes. Re-add removed sections 
	test.delete_row()
	test.add_row()

	#>Check that there's a correct number of sections.
	if not test.get_number_of_elements("inputBox") == 5:
		tclib.write_log(test.filename, [ tclib.get_timestamp() + "ERROR: Wrong number of sections."])
	tclib.write_log(test.filename, ["PASS: CORRECT NUMBER OF SECTIONS (5)"])

	#>Add test strings to each element.
	test.insert_input_boxes("TEST STRING VALUE")
	test.apply_changes()

	#>Spin jul with default values.
	test.spin_jul("10")

try:
	test = jul('TC_001')
	testcase(test)
	tclib.write_log(test.filename, ["TEST COMPLETED..."])
except Exception:
	import traceback
	tclib.log_error(test.filename, ["ERROR: " + str(traceback.format_exc())])