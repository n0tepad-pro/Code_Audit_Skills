# VulnCTF | Web | Writeup
### ID：c569d1f25f24fc39
### Category：Web
### Description：绕过and后面的is_numeric()
### Subject：PHP黑魔法 | 绕过and后面的is_numeric()
### Remarks: VulnCTF

#### c569d1f25f24fc39 Writeup

#### 1.Build

1.1 获取镜像：

```
    docker pull vulnctf/web
```

1.2 创建并启动容器：

```
    docker run -d -p 8081:80 vulnctf/web
```

* 访问Web1题目链接：http://主机:8081/c569d1f25f24fc39/


#### 2.Point

只是知道这是绕过的一种方式，但是为什么会出现这种情况呢，本来以为只要第一个判断为真就不会判断后面的条件正确还是不正确 ，以为问题出现在is_numeric，但是问题好像出现在and上面，根据PHP的优先级来看 赋值运算= 优先级大于 and 。
举一个例子：
![Alt text](http://p1wq82j1w.bkt.clouddn.com/4_4.png)
算是PHP的一种特性吧：
![Alt text](http://p1wq82j1w.bkt.clouddn.com/4_5.png)


#### 3.Test

```
    <?php 
    $test = true and false;
    var_dump($test);
    
    $test2 = true && false;
    var_dump($test2);
    ?>
```

#### 4.Writeup

初始变量被赋值为string，所以打开就是输出"is_numeric(a) and is_numeric(b) error ！"，根据题目同时出现is_numeric()和and判断（图一）
![Alt text](http://p1wq82j1w.bkt.clouddn.com/4_1.png)
由于使用了and，出现了PHP解析优先级的问题，绕过。
![Alt text](http://p1wq82j1w.bkt.clouddn.com/4_2.png)
![Alt text](http://p1wq82j1w.bkt.clouddn.com/4_3.png)

#### 5.Reference

由PHP小tip引发的思考（PHP优先级）：https://www.t00ls.net/viewthread.php?from=notice&tid=42223
CTF 之 PHP 黑魔法总结 ：http://www.zjicmisa.org/index.php/archives/112/
运算符优先级：http://php.net/manual/zh/language.operators.precedence.php
 