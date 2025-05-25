import shared.tc_lib as tclib
import shared.imports as c
from shared.Browser import Page
from time import sleep

class Jul(Page):
	URL = "http://localhost/Pages/jul.php"
	filename = ''
	testcase = ''
	page_type = 'jul'

	def __init__(self, TC):
		super().__init__(TC)

	def add_row(self):
		ele = self.browser.find_element(c.By.ID, "JulAddInputRowBtnID")
		ele.click()

	def delete_row(self):
		ele = self.browser.find_element(c.By.ID, "JulDeleteBtnID")
		ele.click()

	def apply_changes(self):
		ele = self.browser.find_element(c.By.ID, "JulApplyBtnID")
		ele.click()

	def spin_jul(self, duration, should_sleep=True):
		ele = self.browser.find_element(c.By.ID, "JulSpinBtnID")

		ele_input = self.browser.find_element(c.By.ID, "wheelDurationInput")
		ele_input.clear()

		for number in duration:
			ele_input.send_keys(number)
		ele_input.click()

		ele.click()
		if should_sleep:
			sleep(int(duration))

	def insert_input_boxes(self, text):
		eles = self.browser.find_elements(c.By.CLASS_NAME, "inputBox")
		itter = 1
		for ele in eles:
			ele.click()
			for char in text:
				ele.send_keys(char)
			ele.send_keys(str(itter))
			itter = itter + 1
