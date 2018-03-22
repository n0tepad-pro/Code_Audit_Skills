# VulnCTF | Web | Writeup
### ID：abf20c91a442da48
### Category：Web
### Description：文件包含（Local File Include）
### Subject：LFI | 伪协议
### Remarks: VulnCTF

#### abf20c91a442da48 Writeup

#### 1.Build

1.1 获取镜像：

```
    docker pull vulnctf/web
```

1.2 创建并启动容器：

```
    docker run -d -p 8081:80 vulnctf/web
```

* 访问Web1题目链接：http://主机:8081/abf20c91a442da48/


#### 2.Point
文件包含（Local File Include）

要成功的利用文件包含漏洞，需要满足下面两个条件： include（）等函数通过动态变量的方式引入需要包含的文件 用户能够控制该动态变量。

PHP官方文档描述了这样的一种场景，当您在include语句中使用输入变量而没有正确的输入验证时，会发生LFI和RFI漏洞。

php://filter 是一种元封装器， 设计用于数据流打开时的筛选过滤应用。 
这对于一体式（all-in-one）的文件函数非常有用，类似 readfile()、 file() 和 file_get_contents()， 在数据流内容读取之前没有机会应用其他过滤器。 
php://filter 目标使用以下的参数作为它路径的一部分。 复合过滤链能够在一个路径上指定。


#### 3.Writeup
用户需要输入一个page参数，作为程序员，会希望您访问到Y29uZmln.php中的phpinfo信息，但是攻击者可以获取源代码。

打开页面查看源代码发现注释（图一）
    ![Alt text](http://p1wq82j1w.bkt.clouddn.com/1_1.png)
    访问Y29uZmln.php发现执行了phpinfo();（图二）
    ![Alt text](http://p1wq82j1w.bkt.clouddn.com/1_2.png)
    但是没有flag，通过php://filter获取Y29uZmln.php源代码（图三）
    ![Alt text](http://p1wq82j1w.bkt.clouddn.com/1_3.png)
    Base64解密后得到flag（图四）。
    ![Alt text](http://p1wq82j1w.bkt.clouddn.com/1_4.png)

#### 4.Reference
PHP 手册：[PHP 手册](http://php.net/manual/zh/function.include.php)  
谈一谈php://filter的妙用-Phithon：[谈一谈php://filter的妙用-Phithon](https://www.leavesongs.com/PENETRATION/php-filter-magic.html)


 