from selenium import webdriver
from selenium.webdriver.common.desired_capabilities import DesiredCapabilities
from selenium.webdriver.common.keys import Keys
from selenium.webdriver import ActionChains
from selenium.webdriver.support.select import Select
import time
import urllib.parse

def application(environ, start_response):
    start_response('200 OK', [('Content-Type', 'text/html')])

    query = environ['QUERY_STRING']

    if query == '':
        return [bytes(query,'utf-8')]

    query_data = get_param(query)
    #http://39.96.176.33:8000/?token=i41tly1728ad2mazud5rsogkl237namco3phrmxe&cardNumber=4984511157764646&expireMonth=01&expireYear=33&securityCode=111
    token = query_data['token']
    cardNumber = query_data['cardNumber']
    expireMonth = query_data['expireMonth']
    expireYear = query_data['expireYear']
    securityCode = query_data['securityCode']
    # token = 'bcgjp3kyof485vk9iysrwxmki28z3e666o7ctlgt'
    # cardNumber = '4984511157764646'
    # expireMonth = '01'
    # expireYear = '33'
    # securityCode = '111'
    pay(token,cardNumber,expireMonth,expireYear,securityCode)

    return [bytes(query,'utf-8')]
    #return [bytes(cookie,'utf-8')]
    
def pay(token,cardNumber,expireMonth,expireYear,securityCode):

    opt = webdriver.ChromeOptions()
    opt.add_argument('--no-sandbox')
	
    opt.add_argument('--disable-gpu')
    opt.add_argument('--hide-scrollbars')
    opt.add_argument('blink-settings=imagesEnabled=false')
    opt.add_argument('--headless')
    driver = webdriver.Chrome('/usr/local/bin/chromedriver',chrome_options=opt)
    driver.implicitly_wait(10)
    
    url = 'https://pps.collegeboard.org/?pagenameflow=changeSAT&token='+token
    print("访问网页中")
    driver.get(url)
	
    print("访问成功，等待网页加载")
    time.sleep(3)
    driver.save_screenshot('/www/wwwroot/test1.png')
	
    print("点击按钮")
    driver.find_element_by_xpath('//button[@class="btn btn-primary btn-sm"]').click()
    driver.save_screenshot('/www/wwwroot/test2.png')
    Select(driver.find_element_by_name("cards")).select_by_value("VI")
    driver.find_element_by_xpath('//input[@id="creditCardNumber"]').send_keys(cardNumber)
    Select(driver.find_element_by_name("expireMonth")).select_by_value(expireMonth)
    Select(driver.find_element_by_name("expireYear")).select_by_value(expireYear)
    driver.find_element_by_xpath('//input[@id="securityCode"]').send_keys(securityCode)
    
    driver.find_element_by_xpath('//button[@class="btn btn-primary btn-sm "]').click()
    time.sleep(10)
    driver.save_screenshot('/www/wwwroot/test3.png')
    driver.quit()  
    
def get_param(query):
    query_data = {}
    tmp1 = query.split('&')
    print(tmp1)
    for v in tmp1:
        param = v.split('=')
        query_data[param[0]] = param[1]
    return query_data
