# coding=utf-8
from scrapy.item import Field
from scrapy.item import Item
from scrapy.spiders import CrawlSpider, Rule
from scrapy.linkextractors import LinkExtractor
from scrapy.loader import ItemLoader
from scrapy.loader.processors import MapCompose



class MartyrsItem(Item):
	nombre = Field()
	sexo = Field()
	


class MartyrsCrawler(CrawlSpider):
	name = "Martyrs Crawler"
	start_urls=['http://www.vdc-sy.info/index.php/en/martyrs/1/c29ydGJ5PWEua2lsbGVkX2RhdGV8c29ydGRpcj1ERVNDfGFwcHJvdmVkPXZpc2libGV8ZXh0cmFkaXNwbGF5PTB8']
	allowed_domains = ['vdc-sy.info'] #que dominios tiene permitido visitar

	rules ={
		Rule(LinkExtractor(allow=r'/martyrs/')), #crawling horizontal
		Rule(LinkExtractor(allow=r'/index.php/en/details/details/martyrs'), callback = 'parse_items'), #acceder a cada item #crawling vertical, se crea la funcion parse_items
	}

	def parse_items(self, response):
		item= ItemLoader(MartyrsItem(),response)
		item.add_xpath('nombre', '//*[@id="fullContent"]/div[2]/table/tbody/tr[3]/td[2]')
		item.add_xpath('sexo', '//*[@id="fullContent"]/div[2]/table/tbody/tr[5]/td[2]/text()')
		#item.add_xpath('capacidad', '//*[@id="sumary"]/div/div[1]/div/div[2]/div/div/div/div[3]/div[2]/div[2]/span/text()',MapCompose(lambda i: i[0])) -->para sacar solo el primer caracter de la cadena que estoy extrayendo 
		#print item
		yield item.load_item()
	

