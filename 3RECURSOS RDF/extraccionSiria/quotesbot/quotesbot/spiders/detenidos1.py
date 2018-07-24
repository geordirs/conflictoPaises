# -*- coding: utf-8 -*-
import scrapy


class ToScrapeSpiderXPath(scrapy.Spider):
    name = 'detenidos'
    start_urls = [
        'http://www.vdc-sy.info/index.php/en/detainees/1/c29ydGJ5PWEuaTN0ZXFhbF9kYXRlfHNvcnRkaXI9REVTQ3xhcHByb3ZlZD12aXNpYmxlfGV4dHJhZGlzcGxheT0wfA==',
    ]

    def parse(self, response):
        for quote in response.xpath('//tr'):
            yield {
               'titulo':quote.xpath('.//td/a/text()').extract_first(),
               'titulo2':quote.xpath('.//td[2]/text()').extract_first(),
               'titulo3':quote.xpath('.//td[3]/text()').extract_first(),
            }
        for i in enumerate(campo):
            a='[' + str(i) + ']'   
            #a='[2]'
            next_page_url = response.xpath('.//div[@class="tablePgaination"]/a'+a+'/@href').extract_first()
            if next_page_url is not None:
                yield scrapy.Request(response.urljoin(next_page_url))