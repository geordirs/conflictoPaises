# coding=utf-8
from scrapy.item import Field
from scrapy.item import Item
from scrapy.spiders import CrawlSpider, Rule
from scrapy.linkextractors import LinkExtractor
from scrapy.loader import ItemLoader
from scrapy.loader.processors import MapCompose

class DetenidosItem(Item):
	nombre = Field()
	fecha_detencion = Field()
	sexo = Field()
	provincia_detencion = Field()
	lugar_nacimiento = Field()
	causa_detencion= Field()

class DetenidosCrawler(CrawlSpider):
	name = "detenidoscrawler"
	start_urls=['http://www.vdc-sy.info/index.php/en/detainees/1/c29ydGJ5PWEuaTN0ZXFhbF9kYXRlfHNvcnRkaXI9REVTQ3xhcHByb3ZlZD12aXNpYmxlfGV4dHJhZGlzcGxheT0wfA==']
	allowed_domains = ['vdc-sy.info'] #que dominios tiene permitido visitar

	rules ={
		Rule(LinkExtractor(allow=r'/detainees/')), #crawling horizontal
		Rule(LinkExtractor(allow=r'/index.php/en/details/detainees'), callback = 'parse_items'), #crawling horizontal
	}
	def parse_items(self, response):
		item= ItemLoader(DetenidosItem(),response)
		item.add_xpath('nombre', '//tr[3]/td[2]/text()')
		item.add_xpath('fecha_detencion', '//tr[16]/td[2]/text()')
		item.add_xpath('sexo', '//tr[5]/td[2]/text()')
		item.add_xpath('provincia_detencion', '//tr[4]/td[2]/text()')
		item.add_xpath('lugar_nacimiento', '//tr[11]/td[2]/text()')
		item.add_xpath('causa_detencion', '//tr[21]/td[2]/text()')		
		yield item.load_item()


		





	