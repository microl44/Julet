#!Title:Case 002
#!Description:Test regarding multiple spins with low duration (1) 

import shared.Browser as b
import shared.tc_lib as tc
import shared.imports as c

def testcase(test):
	#>Pre-test environment check
	tc.check_connection(test)

	#open browser
	test.load()
	test.click_element("//a[text()=' JUL-JUL ']")
	test.login_to_page(["micke", "password"])
	tc.write_log(test.filename, ["PASS: LOGIN SUCCESSFULL"])

	#>Add 4 rows
	for _ in range(2):
		test.add_row()

	#>Check that there's a correct number of sections.
	if not test.get_number_of_elements("inputBox") == 3:
		tc.write_log(test.filename, ["ERROR: "])
	tc.write_log(test.filename, ["PASS: CORRECT NUMBER OF SECTIONS (3)"])

	#>Add test strings to each element.
	test.insert_input_boxes("TEST STRING VALUE ")
	test.apply_changes()

	#>Spin jul with default values.
	test.spin_jul("10", False)
	b.sleep(4)

	#!>Add three sections during jul spin
	for _ in range(3):
		test.add_row()

	#!>Respin
	test.spin_jul("5")

try:
	test = b.Jul('TC_003')
	testcase(test)
	tc.write_log(test.filename, ["TEST PASSED..."])

except Exception as e:
	import traceback
	tc.log_error(test.filename, [traceback.format_exc()])