import shared.imports as c
import shared.basic as b
from traceback import format_exc
from time import sleep

class Jul:
	URL = "http://localhost/pages/jul.php"
	filename = ''
	testcase = ''

	def __init__(self, TC):
		self.testcase = TC
		self.filename = 'test_res/' + self.testcase + '_' + b.get_timestamp() + '.txt'
		self.init_options()

	def init_options(self):
		ops = c.EdgeOptions()
		ops.add_argument("--start-maximized")
		self.browser = c.webdriver.Edge(options=ops)
		self.browser.implicitly_wait(10)

	def load(self):
		self.browser.get(self.URL)

	def click_element(self, element, xpath = True):
		try:
			if xpath:
				ele = self.browser.find_element("xpath", element)
			else:
				ele = self.browser.find_element(c.By.ID, element)
			ele.click()
		except c.NoSuchElementException:
			return "NO ELEMENT FOUND..."


	def login_to_page(self, login_details):
		ele_u = self.browser.find_element(c.By.ID, 'login-username')
		ele_p = self.browser.find_element(c.By.ID, 'login-password')

		ele_u.click()
		for value in ["micke"]:
			ele_u.send_keys(value)

		ele_p.click()
		for value in ["password"]:
			ele_p.send_keys(value)

		login_btn = self.browser.find_element(c.By.ID, 'login-submit')
		login_btn.click()

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

	def get_number_of_elements(self, CLASS_NAME):
		elements = self.browser.find_elements(c.By.CLASS_NAME, CLASS_NAME)
		return(len(elements))

	def insert_input_boxes(self, text):
		eles = self.browser.find_elements(c.By.CLASS_NAME, "inputBox")
		itter = 1
		for ele in eles:
			ele.click()
			for char in text:
				ele.send_keys(char)
			ele.send_keys(str(itter))
			itter = itter + 1