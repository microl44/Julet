import shared.imports as c
import shared.basic as b
import shared.tc_lib as tclib
from traceback import format_exc
from time import sleep

class Page:
	URL = filename = testcase = page_type = ''

	def __init__(self, TC):
		self.testcase = TC
		logfolder = tclib.get_log_folder()
		self.filename = logfolder + "/" + self.testcase + '.txt'
		self.init_options()

	def load(self):
		self.browser.get(self.URL)

	def close_browser(self):
		self.browser.close()

	def change_page(self, page_type):
		tclib.write_log(self.filename, ["LOG: Page Changed to " + page_type])
		if self.page_type == 'jul':
			self.click_element("//a[text()=' JUL-JUL ']", True)
		elif self.page_type == 'index':
			self.click_element("//a[text()=' HOME ']", True)
		elif self.page_type == 'movies':
			self.click_element("//a[text()=' MOVIES ']", True)
		elif self.page_type == 'rules':
			self.click_element("//a[text()=' JUL-RULES ']", True)
		elif self.page_type == 'stats':
			self.self.click_element("//a[text()=' STATS ']", True)

	def get_number_of_elements(self, CLASS_NAME):
		tclib.write_log(self.filename, ["LOG: Counting number of elements of class: " + CLASS_NAME])
		elements = self.browser.find_elements(c.By.CLASS_NAME, CLASS_NAME)
		return(len(elements))

	def get_elements(self, CLASS_NAME):
		tclib.write_log(self.filename, ["LOG: Returning list of elements of class: " + CLASS_NAME])
		elements = self.browser.find_elements(c.By.CLASS_NAME, CLASS_NAME)
		return elements

	def init_options(self):
		ops = c.EdgeOptions()
		ops.add_argument("--start-maximized")
		self.browser = c.webdriver.Edge(options=ops)
		self.browser.implicitly_wait(10)

	def click_element(self, element, xpath=False, timeout=1):
		for x in range(timeout):
			try:
				if xpath:
					ele = self.browser.find_element("xpath", element)
				else:
					ele = self.browser.find_element(c.By.ID, element)
				if ele.click():
					return
			except c.NoSuchElementException:
				pass
			if timeout != 1:
				sleep(1)
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

		for x in range(40):
			if self.is_logged_in():
				tclib.write_log(self.filename, ["LOG: LOGIN SUCCESSFULL"])
				return
			if "loginFunctions.php" in self.browser.current_url:
				raise Exception("ERROR: Could not establish connection to database...")
			sleep(0.5)
		tclib.write_log(self.filename, ["ERROR: LOGIN FAILED..."])

	def is_logged_in(self):
		if self.get_number_of_elements("logoutBtn") > 0:
			return True
		return False

	def get_number_of_elements(self, CLASS_NAME):
		elements = self.browser.find_elements(c.By.CLASS_NAME, CLASS_NAME)
		return(len(elements))