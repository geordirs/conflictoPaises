# -*- coding: utf-8 -*-
import requests
import time
from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from bs4 import BeautifulSoup


driver = webdriver.Chrome()


url = "https://d3svb6mundity5.cloudfront.net/dashboard/index.html"
driver.get(url)

body = driver.find_element_by_tag_name('body')
clase = '.leaflet-popup-pane'
#find_element_by_css_selector(".action-btn.cancel.alert-display")
marcador = body.find_elements_by_css_selector(clase).click()
ventana = marcador.switch_to.frame

print "TEXTO DEL MARCADOR!!!!!!!!!"
titulo= ventana.find_elements_by_class_name('event-name')[cont].text
print 'titulo: '+ titulo

driver.switch_to_default_content()
#driver.close()