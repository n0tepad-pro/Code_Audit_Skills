# VulnCTF | Web | Writeup
### ID：9630e9ba0442fa3a
### Category：Web
### Description：弱类型==与===比较
### Subject：PHP黑魔法 | 弱类型==与===比较
### Remarks: VulnCTF

#### 9630e9ba0442fa3a Writeup

#### 1.Build

1.1 获取镜像：

```
    docker pull vulnctf/web
```

1.2 创建并启动容器：

```
    docker run -d -p 8081:80 vulnctf/web
```

* 访问Web1题目链接：http://主机:8081/9630e9ba0442fa3a/


#### 2.Point

这段代码中有一个逻辑点，怎么样使的两个值不相等，但是sha1()后的值相等。===会比较类型，比如bool sha1()函数和md5()函数存在着漏洞，sha1()函数默认的传入参数类型是字符串型，那要是给它传入数组呢会出现错误，使sha1()函数返回错误，也就是返回false，这样一来===运算符就可以发挥作用了，需要构造username和password既不相等，又同样是数组类型。
1. === 在进行比较的时候，会先判断两种字符串的类型是否相等，再比较。 
2. == 在进行比较的时候，会先将字符串类型转化成相同，再比较。 
PS：URL可以传递数组参数，形式是链接：xxx.com?x[]=1&x[]=2&x[]=3
这样就提交了一个x[]={1,2,3}的数组。 如果使用sha1对一个数组进行加密，返回的将是NULL，NULL===NULL。

#### 3.Test
通过打印出传入的值以及类型，以及sha()后的值和类型看看如何绕过：
    ![Alt text](http://p1wq82j1w.bkt.clouddn.com/3_1.png)
    ![Alt text](http://p1wq82j1w.bkt.clouddn.com/3_2.png)

#### 4.Writeup

这段代码的逻辑是用户输入username和password两个参数，如果username和password的值不相等，再判断username和password字符串的 sha1 散列值与类型是否相等，如果相等才输出flag值。

分析代码逻辑，发现GET了两个字段username和password，获得flag要求的条件是：username != password & sha1(username) == sha1(password)，可以利用sha1()函数的漏洞来绕过。
如果把这两个字段构造为数组，如：?name[]=a&password[]=q，这样在第一处判断时两数组确实是不同的，但在PHP中，sha1 是不能处理数组的，sha1(数组)会返回null，所以sha1 (a[])==null,sha1 (b[])==null，sha1 (a[])=sha1 (b[])=null,这样就可以了。 
在第二处判断时由于sha1()函数无法处理数组类型，将报错并返回false，if 条件成立，获得flag。经验证md5()函数同样存在此漏洞。
index.php?username[]=1&password[]=9
![Alt text](http://p1wq82j1w.bkt.clouddn.com/3_3.png)

#### 5.Reference
PHP手册：http://php.net/manual/zh/function.sha1.php
php 弱类型总结：http://www.cnblogs.com/Mrsm1th/p/6745532.html


 