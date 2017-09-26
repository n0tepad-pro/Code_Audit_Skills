# VulnCTF 的练习教室 | 每日一练
## ID：abf20c91a442da48
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

* 访问Crypto3题目链接：http://主机:8081/abf20c91a442da48/


#### 2.Point
文件包含（Local File Include）

要成功的利用文件包含漏洞，需要满足下面两个条件： include（）等函数通过动态变量的方式引入需要包含的文件 用户能够控制该动态变量。


#### 3.Writeup

打开时候是jsfuck编码
直接拖到控制台发现执行不了，看一下题目，知道了是缺点东西，打开[jsfuck](http://www.jsfuck.com/)，对比一下，发现头部缺少]，补齐以后放入控制台，但是结果如下：

* ![Alt text](src/1.png)


感觉像是和我开了一个玩笑，到这都没有思路了，决定换一个网站看一下：[poisonjs](https://ooze.ninja/javascript/poisonjs/)（强烈推荐），看到里面的flag后面紧跟了一alert的弹窗，所以使用控制台执行就会出现弹窗覆盖了前面提示的flag信息，get了。

* ![Alt text](src/1.png)

#### 4.Reference

PHP文件包含介绍及一些利用方式-拿衣服的安全屋：https://zhuanlan.zhihu.com/p/26308699

 