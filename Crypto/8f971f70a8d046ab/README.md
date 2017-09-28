# VulnCTF 的练习教室 | 每日一练
## ID：8f971f70a8d046ab
### Category：Crypto
### Description：JSJS
### Subject：JS
### Remarks: 2017_广东省”强网杯“网络安全大赛

#### 8f971f70a8d046ab Writeup

#### 1.Build

1.1 获取镜像：

```
    docker pull vulnctf/crypto
```

1.2 创建并启动容器：

```
    docker run -d -p 8080:80 vulnctf/crypto
```

* 访问Crypto1题目链接：http://主机:8080/8f971f70a8d046ab/


#### 2.Point
jother/jsfuck是另类的javascript模式。

Jother（Jsfuck）是用匿名函数的原生形式，解码则按照编码原理倒过来写个程序。其特点是由“[]，()，{}，+,！”组成的编码后的字符，这是一个JavaScript的绕过代码编码方式。


#### 3.Writeup

#### 4.Reference

 WooYun/jother编码之谜:https://github.com/tczhangzhi/WooYun/blob/master/jother%E7%BC%96%E7%A0%81%E4%B9%8B%E8%B0%9C.html

 