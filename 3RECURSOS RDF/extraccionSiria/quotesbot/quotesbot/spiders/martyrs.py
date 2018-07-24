# coding=utf-8
from scrapy.item import Field
from scrapy.item import Item
from scrapy.spiders import CrawlSpider, Rule
from scrapy.linkextractors import LinkExtractor
from scrapy.loader import ItemLoader
from scrapy.loader.processors import MapCompose

class MartyrItem(Item):
	nombre = Field()
	tipo_ciudadano = Field()
	sexo = Field()
	provincia_muerte = Field()
	lugar_nacimiento = Field()
	fecha_muerte = Field()
	causa_muerte = Field()
	grupo_causante = Field()


class MartyrCrawler(CrawlSpider):
	name = "martyrcrawler"
	start_urls=['http://www.vdc-sy.info/index.php/en/martyrs/1/c29ydGJ5PWEua2lsbGVkX2RhdGV8c29ydGRpcj1ERVNDfGFwcHJvdmVkPXZpc2libGV8ZXh0cmFkaXNwbGF5PTB8']
	allowed_domains = ['vdc-sy.info'] #que dominios tiene permitido visitar

	rules ={
		Rule(LinkExtractor(allow=r'/martyrs/')), #crawling horizontal
		Rule(LinkExtractor(allow=r'/index.php/en/details/martyrs'), callback = 'parse_items'), #acceder a cada item #crawling vertical
	}
	def parse_items(self, response):
		item= ItemLoader(MartyrItem(),response)
		item.add_xpath('nombre', '//tr[3]/td[2]/text()')
		item.add_xpath('tipo_ciudadano', '//tr[6]/td[2]/text()')
		item.add_xpath('sexo', '//tr[5]/td[2]/text()')
		item.add_xpath('provincia_muerte', '//tr[4]/td[2]/text()')
		item.add_xpath('lugar_nacimiento', '//tr[12]/td[2]/text()')
		item.add_xpath('fecha_muerte', '//tr[17]/td[2]/text()')
		item.add_xpath('causa_muerte', '//tr[19]/td[2]/text()')
		item.add_xpath('grupo_causante', '//tr[23]/td[2]/text()')		
		yield item.load_item()



	