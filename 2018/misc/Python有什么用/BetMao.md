## 解压
```py
#coding=utf-8
#author:宁宁
import os
for i in range(200,0,-1)
     cmd="winRAR.exe x  C:\\Users\\lala\\Desktop\\ZJGSCTF\\web\\"+str(i)+'.rar'+" C:\\Users\\lala\\Desktop\\ZJGSCTF\\web\\压缩包"
     print cmd
     os.system(cmd)
```

## 解密
最后一层是被加密的压缩包，从注释看出不能从暴力或字典跑出密码：

 ![](./images/1.png)

仔细观察发现有些无用的通知文件：

 ![](./images/2.png)

而这些文件可以从教务网获得：

 ![](./images/3.png)

用已知明文攻击，即可解密数据包（注意，此时生成的压缩包与被加密的压缩包要使用相同的程序压缩，不过压缩程序就那么几种，多试试就好了）

 ![](./images/4.png)

停止后保存明文即可：

 ![](./images/5.png)
