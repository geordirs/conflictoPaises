import time
import csv
from exceptions import Exception
from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from bs4 import BeautifulSoup

browser = webdriver.Chrome()

url = "https://d3svb6mundity5.cloudfront.net/dashboard/index.html"
browser.get(url)

#element = browser.find_element_by_xpath("//path[@class='opposition marker leaflet-clickable']").click()

#element = browser.find_element_by_css_selector("opposition marker leaflet-clickable").click()

'''
<div class="load_more">
<a class="button button_grey" href="#">Load more</a> 
</div>
'''
#browser.find_element_by_css_selector("div.load_more>a").click()

time.sleep(5)

#elements = browser.find_elements_by_css_selector("g>path.government.marker.leaflet-clickable")

aTagsInLi = browser.find_elements_by_css_selector('div.leaflet-overlay-pane svg g path')
with open('carter.csv', 'w') as csvfile:
    fieldNames = ['nombre_ataque','fecha_ataque','iniciador','objetivo','ciudad','medio','enlace_noticia']
    writer = csv.DictWriter(csvfile, fieldnames=fieldNames, restval="", dialect="excel",)
    writer.writeheader()
    for a in aTagsInLi:
        #print a.get_attribute('class')
        #browser.execute_script("arguments[0].setAttribute('class','__web-inspector-hide-shortcut__')", a)
        #browser.execute_script("arguments[0].setAttribute('style','__web-inspector-hide-shortcut__')", a)
        browser.execute_script("arguments[0].setAttribute('style', 'visibility:hidden')", a)

    cont = 0
    con2 = 0

    for a in aTagsInLi:
        #print a.get_attribute('class')
        #browser.execute_script("arguments[0].setAttribute('class','__web-inspector-hide-shortcut__')", a)
        #browser.execute_script("arguments[0].setAttribute('style','__web-inspector-hide-shortcut__')", a)
        try:
            browser.execute_script("arguments[0].setAttribute('style', 'visibility:visible')", a)
            a.click()
            #obtener campos para ataques 
            nombre_ataque1= browser.find_element_by_css_selector('div.event-name')
            fecha_ataque1= browser.find_element_by_xpath('//*[@id="map"]/div[1]/div[2]/div[4]/div/div[1]/div/div/ul/li[1]/span/text()')
            iniciador1= browser.find_element_by_xpath('//*[@id="map"]/div[1]/div[2]/div[4]/div/div[1]/div/div/ul/li[2]/span')
            objetivo1= browser.find_element_by_xpath('//*[@id="map"]/div[1]/div[2]/div[4]/div/div[1]/div/div/ul/li[3]/span')
            ciudad1 = browser.find_element_by_xpath('//*[@id="map"]/div[1]/div[2]/div[4]/div/div[1]/div/div/ul/li[4]/span')
            medio1= browser.find_element_by_xpath('//*[@id="map"]/div[1]/div[2]/div[4]/div/div[1]/div/div/ul/li[5]/span')
            enlace_noticia1= browser.find_element_by_xpath('//*[@id="map"]/div[1]/div[2]/div[4]/div/div[1]/div/div/ul/li[5]/span/a')
            #imprimir por consola los datos extraidos
            print '{0}'.format(nombre_ataque1.text)
            print fecha_ataque1
            print '{0}'.format(iniciador1.text)
            print '{0}'.format(objetivo1.text)
            print '{0}'.format(ciudad1.text)
            print '{0}'.format(medio1.text)
            print '{0}'.format(enlace_noticia1.text)

            #escribir en el csv la data por cada columna
            writer.writerow({'nombre_ataque': '{0}'.format(nombre_ataque1.text),
                'fecha_ataque': '{0}'.format(fecha_ataque1.text), 'iniciador': '{0}'.format(iniciador1.text), 
                'objetivo': '{0}'.format(objetivo1.text), 'ciudad': '{0}'.format(ciudad1.text),
                'medio': '{0}'.format(medio1.text), 'enlace_noticia': '{0}'.format(enlace_noticia1.text)})
            cont = cont + 1
            time.sleep(1)
            browser.execute_script("arguments[0].setAttribute('style', 'visibility:hidden')", a)
        except Exception:
            con2 = con2 + 1
            browser.execute_script("arguments[0].setAttribute('style', 'visibility:hidden')", a)
            continue
