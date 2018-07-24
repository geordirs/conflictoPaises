# -*- coding: utf-8 -*-
import scrapy
from scrapy.selector import Selector
from scrapy.http import HtmlResponse
from HTMLParser import HTMLParser
import re

opentags=[]
endtags=[]
contenedor=[]
class archivos(object):
    def escritura(self,t):
        archivo = open("hello.txt", "w") 
        archivo.write(t.encode("utf-8"))
        archivo.close()

    def limpieza(self):
        archivo = open("hello.txt", "r") 
        contenido = archivo.readlines()
        cadena=""
        for t in contenido:
            w=t.strip()
            q=w.lstrip()
            s=q.rstrip()
            if (s!=" "):
                cadena=cadena+s
        return (cadena)
        archivo.close() 




class Almacen(object):
    def openTags(self,tag):
        opentags.append("/"+tag)
        
    def endTags(self,tag):
        endtags.append("/"+tag)
        longit=len(opentags)
            
        i=longit-1
        del opentags[i]
        #comparo arreglos

    def datas(self,data):
        ruta=[]
        ruta_valida=""  
        for x in range(1,len(opentags)):
            ruta_valida=ruta_valida+opentags[x]
        estadarRuta="./"+ruta_valida+"/text()"
        contenedor.append(estadarRuta)
        

class MyHTMLParser(HTMLParser):
    
    def handle_starttag(self, tag, attrs):
        if(tag!="img" and tag!="meta"):
            instancia=Almacen()
            instancia.openTags(tag)
          
    def handle_endtag(self, tag):
        instancia=Almacen()
        instancia.endTags(tag)
    def handle_data(self, data):
        if data.strip() and data.lstrip() and data.rstrip() :
            print(data)
            instancia=Almacen()
            instancia.datas(data)   

  
class ToScrapeSpiderXPath(scrapy.Spider):
    name = 'valido'
    start_urls = [
        'http://www.imdb.com/search/title?country_of_origin=ec',
    ]
    
    def parse(self, response): 
        s=response.xpath('//div[@class="lister-item mode-advanced"]') 
        t=response.xpath('//div[@class="lister-list"]').extract_first()
        ar=archivos()
        ar.escritura(t)
        contenido=ar.limpieza()
        parser = MyHTMLParser()
        parser.feed(contenido)

      
       
        for g in contenedor:
            print(g)


