##zaihuitou项目文档

---
**背景：**时隔十月，重新开始关注微信公众平台的开发，所以取名再回头。[之前的项目][1]


###1.现在支持的功能：

- 接受用户订阅并返回欢迎信息
- 订阅号的自动回复功能

###2.项目代码说明：

- **index.php** 项目入口文件，微信认证的时候这个文件里面的代码可以替换成他们提供的`sample.php`中的代码，然后修改`token`就可以实现服务器的绑定了。
- **MessageResponseClass.php** 信息回复类，主要实现按照微信要求的格式回复数据。
- **MessageReceiveClass.php**  信息接受类，主要接受微信服务器发送的信息，写入类变量。
- **MessageResolveClass.php**  信息处理类，这里主要是根据用户发送的信息调用不同的接口，并返回结果。

>注：以上四个文件属于核心文件，扩展的时候只需要在MessageResponse类中加上相应的接口调用代码就可以了*
- **GetPyExperimentClass.php**  我自己用的一个扩展功能，从Mongondb里获取数据并返回，具体数据是什么就不要在意。
- **AIResponseClass.php** 我自己扩展的一个功能，想着能够智能回复，（没学过人工智能，只是自己瞎猜这写的，没什么科学依据）。
- **UserInfoRecordClass.php** 用户信息记录类，记录订阅者weichatID便于提供个性化服务。

###3.扩展方法：

先在项目目录下新建类文件，文件名必须是`XXXClass.php`，类名就是`XXX`,然后使用的时候只需在任意文件的任意位置`new XXX()`己可以了。

>注：这里使用的php的__autoload()自动加载文件，所以不需要另外的require，只需要保证类名和文件名按照规则来即可。

核心类中每个函数的功能详见代码。

###4.使用工具

- php
- mongodb



  [1]: https://github.com/Tairy/weixin