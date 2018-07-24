import requests
from time import time, sleep
from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from bs4 import BeautifulSoup

# These params will be for https://api.socar.kr/reserve/oneway_zone_list 
# which we can get the zone_ids from.
params = {"type": "start", "_": str(time())}
# We use the zone_id from each dict we parse from the json receievd
params2 = {"zone_id": ""}

with requests.Session() as s:
    s.get("http://www.socar.kr/reserve#jeju")
    s.headers.update({
        "User-Agent": "Mozilla/5.0 (X11; Linux x86_64)"})
    r = s.get("https://api.socar.kr/reserve/oneway_zone_list", params=params)
    result = r.json()["result"]
    for d in result:
        params2["zone_id"] = d["zone_id"]
        params2["_"] = str(time())
        sleep(1)
        r2 = s.get("https://api.socar.kr/reserve/zone_info", params=params2)
        print(r2.json())