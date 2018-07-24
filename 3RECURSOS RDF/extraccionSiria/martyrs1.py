# -*- coding: utf-8 -*-
import scrapy


class ToScrapeSpiderXPath(scrapy.Spider):
    name = 'martyrs'
    start_urls = [
        'http://www.vdc-sy.info/index.php/en/martyrs/1/c29ydGJ5PWEua2lsbGVkX2RhdGV8c29ydGRpcj1ERVNDfGFwcHJvdmVkPXZpc2libGV8ZXh0cmFkaXNwbGF5PTB8',
    ]

    def parse(self, response):
        for quote in response.xpath('//tr'):
            yield {
               'titulo':quote.xpath('.//td/a/text()').extract_first(),
            }
        for i in enumerate(response):
            a='[' + str(i) + ']'   
            #a='[4]'
            next_page_url = response.xpath('.//div[@class="tablePgaination"]/a'+a+'/@href').extract_first()
            if next_page_url is not None:
                yield scrapy.Request(response.urljoin(next_page_url))
