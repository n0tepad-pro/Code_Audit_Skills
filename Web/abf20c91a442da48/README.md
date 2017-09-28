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

* 访问Web1题目链接：http://主机:8081/abf20c91a442da48/


#### 2.Point
文件包含（Local File Include）

要成功的利用文件包含漏洞，需要满足下面两个条件： include（）等函数通过动态变量的方式引入需要包含的文件 用户能够控制该动态变量。


#### 3.Writeup


#### 4.Reference



 