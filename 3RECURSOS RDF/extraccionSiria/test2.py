# coding=utf-8
from scrapy.item import Field
from scrapy.item import Item
from scrapy.spiders import CrawlSpider, Rule
from scrapy.linkextractors import LinkExtractor
from scrapy.loader import ItemLoader
from scrapy.loader.processors import MapCompose



class RoomItem(Item):
	tipo = Field()
	capacidad = Field()

/index.php/en/details/martyrs/189137
/index.php/en/details/martyrs/189147
class RoomCrawler(CrawlSpider):
	name = "primer crawler"
	start_urls=['https://www.airbnb.com.ec/s/Londres--Reino-Unido/homes']
	allowed_domains = ['airbnb.com.ec'] #que dominios tiene permitido visitar

	rules ={
		Rule(LinkExtractor(allow=r'section_offset=')), #crawling horizontal
		Rule(LinkExtractor(allow=r'/rooms'), callback = 'parse_items'), #acceder a cada item #crawling vertical
	}

	def parse_items(self, response):
		item= ItemLoader(RoomItem(),response)
		item.add_xpath('tipo', '//*[@id="summary"]/div/div[1]/div/div[2]/div/div/div/div[3]/div[2]/div[1]/span/text()')
		item.add_xpath('capacidad', '//*[@id="summary"]/div/div[1]/div/div[2]/div/div/div/div[3]/div[2]/div[2]/span/text()')
		#item.add_xpath('capacidad', '//*[@id="sumary"]/div/div[1]/div/div[2]/div/div/div/div[3]/div[2]/div[2]/span/text()',MapCompose(lambda i: i[0])) -->para sacar solo el primer caracter de la cadena que estoy extrayendo 
		yield item.load_item()
	

