# coding=utf-8
from scrapy.item import Field
from scrapy.item import Item
from scrapy.spiders import CrawlSpider, Rule
from scrapy.linkextractors import LinkExtractor
from scrapy.loader import ItemLoader
from scrapy.loader.processors import MapCompose

class MissingItem(Item):
	nombre = Field()
	fecha_desaparicion = Field()
	sexo = Field()
	provincia_desaparicion = Field()
	lugar_nacimiento = Field()
	fecha_encontrado = Field()
	
class MissingCrawler(CrawlSpider):
	name = "miss"
	start_urls=['http://www.vdc-sy.info/index.php/en/missing/1/c29ydGJ5PWEuZGlzYXBlYXJlZF9kYXRlfHNvcnRkaXI9REVTQ3xhcHByb3ZlZD12aXNpYmxlfGV4dHJhZGlzcGxheT0wfA==']
	allowed_domains = ['vdc-sy.info'] #que dominios tiene permitido visitar

	rules ={
		Rule(LinkExtractor(allow=r'/missing/')), #crawling horizontal
		Rule(LinkExtractor(allow=r'/index.php/en/details/missing'), callback = 'parse_items'), #acceder a cada item #crawling vertical
	}
	def parse_items(self, response):
		item= ItemLoader(MissingItem(),response)
		item.add_xpath('nombre', '//tr[4]/td[2]/text()')
		item.add_xpath('fecha_desaparicion', '//tr[18]/td[2]/text()')
		item.add_xpath('sexo', '//tr[6]/td[2]/text()')
		item.add_xpath('provincia_desaparicion', '//tr[5]/td[2]/text()')
		item.add_xpath('lugar_nacimiento', '//tr[12]/td[2]/text()')
		item.add_xpath('fecha_encontrado', '//tr[19]/td[2]/text()')	
		yield item.load_item()

		



	