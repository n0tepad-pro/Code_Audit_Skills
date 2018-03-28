# VulnCTF | Web | Writeup
### ID：5c55674b83536ad3
### Category：Web
### Description：strcmp
### Subject：PHP黑魔法 | strcmp 
### Remarks: VulnCTF

#### 5c55674b83536ad3 Writeup

#### 1.Build

1.1 获取镜像：

```
    docker pull vulnctf/web
```

1.2 创建并启动容器：

```
    docker run -d -p 8081:80 vulnctf/web
```

* 访问Web1题目链接：http://主机:8081/5c55674b83536ad3/


#### 2.Point

strcmp — 二进制安全字符串比较，如果 str1 小于 str2 返回 < 0； 如果 str1 大于 str2 返回 > 0；如果两者相等，返回 0。 
php官方在后面的版本中修复了这个漏洞，使得报错的时候函数不返回任何值。
strcmp只会处理字符串参数，如果给个数组的话呢，就会返回NULL,而判断使用的是==，NULL==0是 bool(true)
![Alt text](http://p1wq82j1w.bkt.clouddn.com/2_1.png)
实际测试如下：
PHP5.2.1版本中使用strcmp比较数组和字符串时候会返回 int(1)
![Alt text](http://p1wq82j1w.bkt.clouddn.com/2_2.png)
PHP5.3版本中使用strcmp比较数组和字符串时候会返回 null
![Alt text](http://p1wq82j1w.bkt.clouddn.com/2_3.png)

#### 3.test：

```    
    <?php 
    	if(null){
    		echo 'test';
    	}else{
    		echo 'test2';
    	}
    	
    	if(null==0){
    		echo '123456';
    	}else{
    		echo '654321';
    	}
    	
    	if(null===0){
    		echo 'abc';
    	}else{
    		echo 'cba';
    	}
    ?>
```

结果如下：
![Alt text](http://p1wq82j1w.bkt.clouddn.com/2_4.png)

#### 3.Writeup

用户传入字符串类型的值和后台的'cab56ab0de5376d2a0c73307ea011da4'值做比较，如果相等，输出flag。

访问：http://localhost/MiniProject_PHP_Code_audit/Web2/index.php?password[]=123
![Alt text](http://p1wq82j1w.bkt.clouddn.com/2_5.png)


#### 4.Reference

CTF之PHP黑魔法总结：http://www.am0s.com/ctf/128.html
PHP 手册 ：http://php.net/manual/zh/function.strcmp.php


 