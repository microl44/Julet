import shared.imports as c
import shared.basic as b
from traceback import format_exc
from time import sleep
from shared.Browser import Page

class Index(Page):
	URL = "http://localhost/pages/index.php"
	filename = ''
	testcase = ''
	page_type = 'index'

	def __init__(self, TC):
		super().__init__(TC)

	def press_movie_table_next_btn(self, click_timeout=1):
		self.click_element("nextPageBtn", timeout=click_timeout)

	def press_movie_table_previous_btn(self, click_timeout=1):
		self.click_element("prevPageBtn", timeout=click_timeout)

	def switch_active_table(self, table, click_timeout=1):
		match table:
			case "Group":
				self.click_element("tableTabGroup", timeout=click_timeout)
				return
			case "Marvel":
				self.click_element("tableTabMarvel", timeout=click_timeout)
				return
			case "Solo":
				self.click_element("tableTabSolo", timeout=click_timeout)
				return
			case _:
				return


	def get_table(self, timeout=0):
		rows = self.get_elements("movieTable")
		table = []
		for row in rows[2].text.split('\n')[1:]:
			table.append(row)
		if timeout != 0:
			sleep(timeout)
		return table

	def wait_for_database(self, timeout=10):
		for x in range(timeout):
			table = self.get_table()
			for row in table:
				if "..." not in row:
					#print("Value: " + str(row) + " caused wait_for_database to return...")
					return True
			sleep(1)
		return False