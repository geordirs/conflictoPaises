from scrapy.item import Field
from scrapy.item import Item
from scrapy.spiders import Spider
from scrapy.selector import Selector
from scrapy.contrib.loader import ItemLoader



class Pregunta(Item):
	pregunta = Field()
	id = Field()


class StackSpider(Spider):
	name = "Primer spider" #por lo general se pone un nombre al spider
	start_urls = ['https://stackoverflow.com/']
	def parse(self, response):
		sel = Selector(response)
		preguntas = sel.xpath('//div[@id="question-mini-list"]/div') #es una lista

		for i , elem in enumerate(preguntas):
			item = ItemLoader(Pregunta(),elem) #elem tiene el xpath
			item.add_xpath('pregunta', './/h3/a/text()')
			item.add_value('id',i)
			yield item.load_item()

