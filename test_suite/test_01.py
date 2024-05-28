from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.chrome.options import Options
from selenium.webdriver import EdgeOptions
from selenium import webdriver

from time import sleep

import shared.basic

class Browser:
	URL = "http://localhost/pages/index.php"

	def __init__(self):
		ops = EdgeOptions()
		#ops.add_experimental_option("detach", True)
		ops.add_argument("--start-maximized")
		self.browser = webdriver.Edge(options=ops)
		self.browser.implicitly_wait(20)

	def load(self):
		self.browser.get(self.URL)

	def click_element(self, element):
		ele = self.browser.find_element("xpath", element)
		ele.click()

	def login_to_page(self, login_details):
		ele_u = self.browser.find_element(By.ID, 'login-username')
		ele_p = self.browser.find_element(By.ID, 'login-password')

		ele_u.click()
		for value in ["micke"]:
			ele_u.send_keys(value)
		ele_p.click()
		for value in ["password"]:
			ele_p.send_keys(value)

		login_btn = self.browser.find_element(By.ID, 'login-submit')
		login_btn.click()

	def jul_add_row(self):
		ele = self.browser.find_element(By.ID, "JulAddInputRowBtnID")
		ele.click()
		sleep(1)

	def jul_delete_row(self):
		ele = self.browser.find_element(By.ID, "JulDeleteBtnID")
		ele.click()
		sleep(1)

	def jul_apply_changes(self):
		ele = self.browser.find_element(By.ID, "JulApplyBtnID")
		ele.click()
		sleep(1)

	def jul_spin_wheel(self):
		ele = self.browser.find_element(By.ID, "JulSpinBtnID")
		ele.click()
		sleep(1)

	def get_number_of_elements(self, CLASS_NAME):
		elements = self.browser.find_elements(By.CLASS_NAME, CLASS_NAME)
		return(len(elements))

	def jul_insert_input_boxes(self, text):
		eles = self.browser.find_elements(By.CLASS_NAME, "inputBox")
		itter = 1
		for ele in eles:
			ele.click()
			for char in text:
				ele.send_keys(char)
			ele.send_keys(str(itter))
			itter = itter + 1

for x in range(10):
	########################################
	# TEST JUL SPINNING WITH 5 SECTIONS    #
	########################################

	#Navigate to jul page and login
	browser = Browser()
	browser.load()
	browser.click_element("//a[text()=' JUL-JUL ']")
	browser.login_to_page(["micke", "password"])

	#Add 4 rows
	for _ in range(4):
		browser.jul_add_row()

	#Delete and apply changes. Re-add removed sections 
	browser.jul_delete_row()
	browser.jul_add_row()

	#Check that there's a correct number of sections.
	if not browser.get_number_of_elements("inputBox") == 5:
		print("TEST FAILED: Number of sections did not match expected value...")

	#Add test strings to each element.
	browser.jul_insert_input_boxes("TEST STRING VALUE ")
	browser.jul_apply_changes()

	#Spin jul with default values.
	browser.jul_spin_wheel()
	sleep(10)

	#CONTINUE WITH 