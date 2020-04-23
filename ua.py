from selenium import webdriver
from selenium.webdriver.common.desired_capabilities import DesiredCapabilities
from selenium.webdriver.common.keys import Keys
from selenium.webdriver import ActionChains
import time
import urllib.parse

def application(environ, start_response):
    start_response('200 OK', [('Content-Type', 'text/html')])

    query = environ['QUERY_STRING']
    query_data = get_param(query)

    print(query_data)
    #cookie = query_data['cookie']
    money = query_data['money']

    # cookie = urllib.parse.unquote(cookie, encoding='utf-8',errors='replace')
    # cookie = cookie.replace('+','')
    #print("cookie参数值|||"+cookie)
    #print(cookie)
    #return [bytes(cookie)]
    ua = get_ua(money)
    #ua = get_ua2(cookie,money)
    print("ua的值:"+ua)
    return [bytes(ua,'utf-8')]
    #return [bytes(cookie,'utf-8')]

def cookie_to_dic(cookie):
    cookie = cookie[:-1]
    print('这里是cookie:'+cookie)
    cookie_dic = {}
    for i in cookie.split(';'):
      cookie_dic[i.split('=')[0]] = i.split('=')[1]
    return cookie_dic

def get_param(query):
    query_data = {}
    tmp1 = query.split('&')
    print(tmp1)
    for v in tmp1:
        param = v.split('=')
        query_data[param[0]] = param[1]
    return query_data

def get_ua(money):
    opt = webdriver.ChromeOptions()
    opt.add_argument('--no-sandbox')
    #opt.add_argument('window-size=1920x3000')
    opt.add_argument('--disable-gpu')
    opt.add_argument('--hide-scrollbars')
    opt.add_argument('blink-settings=imagesEnabled=false')
    opt.add_argument('--headless')
    driver = webdriver.Chrome('/usr/local/bin/chromedriver',chrome_options=opt)
    driver.implicitly_wait(10)
    
    # url = 'http://bank.51godream.com/ua'
    # driver.get(url)
    # driver.save_screenshot('/www/wwwroot/laravel-bank-pay/test.png')
    # return 'test'
    
    url = 'http://bank.51godream.com/ua.html'
    driver.get(url)
    action = driver.find_element_by_xpath('//form[@id="ebankDepositForm"]')
    ActionChains(driver).move_to_element(action).click(action).perform()
    driver.find_element_by_xpath('//input[@id="money"]').send_keys(money)

    #driver.find_element_by_xpath('//input[@id="depositAmount"]').send_keys(money)

    driver.find_element_by_xpath('//input[@id="J-deposit-submit"]').click()
    # driver.find_element_by_xpath('//input[@id="J-deposit-submit"]').click()
    # driver.find_element_by_xpath('//input[@id="J-deposit-submit"]').click()
    time.sleep(2)
    ua = driver.find_element_by_xpath('//input[@id="UA_InputId"]').get_attribute("value")
    driver.save_screenshot('/www/wwwroot/laravel-bank-pay/test.png')
    driver.quit()
    return ua
    
def get_ua2(cookie,money):
    opt = webdriver.ChromeOptions()
    opt.add_argument('--no-sandbox')
    #opt.add_argument('window-size=1920x3000')
    opt.add_argument('--disable-gpu')
    opt.add_argument('--hide-scrollbars')
    opt.add_argument('blink-settings=imagesEnabled=false')
    opt.add_argument('--headless')
    driver = webdriver.Chrome('/usr/local/bin/chromedriver',chrome_options=opt)
    driver.implicitly_wait(10)
    #try:
    #url = 'https://my.alipay.com/portal/i.htm'
    url = 'https://bizfundprod.alipay.com/allocation/deposit/index.htm'
    driver.get(url)
    # data = driver.page_source
    # driver.find_element_by_xpath('//a[@class="ui-button ui-button-swhite j-deposit-link"]').click()
    # driver.switch_to_window(driver.window_handles[1])
    # data = driver.page_source
    # print(data)
    
    #driver.find_element_by_xpath('//a[@seed="content-linkT1"]').click()  #点击'充值到余额'
    driver.save_screenshot('/www/wwwroot/laravel-bank-pay/test1.png')
    choose_url = driver.find_element_by_xpath('//a[@class="J_XBox"]').get_attribute('href');#访问'选择银行的url'
    driver.get(choose_url)
    
    #driver.find_element_by_xpath('//a[@class="J_XBox"]').click()  #点击 '选择其他'
    #driver.switch_to.frame(driver.find_element_by_xpath('//iframe'))
    driver.find_element_by_xpath('//input[@value="CCBccb103_DEPOSIT_DEBIT_EBANK_XBOX_MODEL"]').click() #选择银行
    driver.find_element_by_xpath('//input[@type="submit"]').click() #点击 '下一步'

    #time.sleep(10)
    #driver.save_screenshot('/www/wwwroot/laravel-bank-pay/test1.png')
    
    action = driver.find_element_by_xpath('//input[@id="J-depositAmount"]')
    #ActionChains(driver).move_to_element(action).click(action).perform()
    action.click();
    #print(driver.find_element_by_xpath('//input[@id="UA_InputId"]').get_attribute("value"))
    driver.find_element_by_xpath('//input[@id="J-depositAmount"]').send_keys(money)
    #time.sleep(5)
    driver.find_element_by_xpath('//input[@id="J-deposit-submit"]').click()
    #driver.find_element_by_xpath('//input[@id="J-depositAmount"]').send_keys(Keys.ENTER)
    #time.sleep(5)
    ua = driver.find_element_by_xpath('//input[@id="UA_InputId"]').get_attribute("value")
    #driver.save_screenshot('/www/wwwroot/laravel-bank-pay/test.png')
    driver.quit()
    #except Exception as e:
    #    driver.quit()
    #    return 'expire'    
    return ua
    
#get_ua(1)