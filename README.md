<p align="center">
  <h2 align="center">⚡使用你的知乎账号数据生成动态Github Readme Card⚡</h2>
  <h2 align="center">Zhihu Statistics Card Generator</h2>
</p>

## 利用的zhihu api：
https://api.zhihu.com/people/{username}

example：
部署到你的服务器以后 在readme.md中写下以下代码

```md
<a href="xxx"><img src="api地址"></a>
<img>标签可手写css style 如：align="right"
```

或者直接用我部署到我服务器的api:https://codingdog.xyz/api/zhihu_stats.php/{username}

zhihu api的并发访问限制应该是5000以下 多了服务器可能会宕机或限制访问

---

展示：
<a href="https://www.zhihu.com/people/qaucodingdog"><img src="https://www.codingdog.xyz/api/zhihu_stats.php?username=qaucodingdog" align="center"></a>
