# 数组增强

数组增强组件主要是对数组等数据进行处理，如无限级分类操作、商品规格的迪卡尔乘积运算等。

# 开始使用

#### 根据键名获取数据

如果键名不存在时返回默认值，支持键名的点语法

```
$d=['a'=>1,'b'=>2];
Arr::get($d,'c','没有数据哟');

```

使用点语法查找：

```
$d = ['web' => [ 'id' => 1, 'url' => 'houdunwang.com' ]];
print_r(Arr::get($d,'web.url'));

```

#### 从数组中移除给定的值

```
$d = [1,2,3,4,5];
Arr::del($d,[3,4]);
//结果是 [1,2,5]

```

#### 排队字段获取数据

以下代码获取除 id、url以外的数据

```
$d = [ 'id' => 1, 'url' => 'houdunwang.com' ,'name'=>'后盾人'];
print_r(Arr::getExtName($d,['id','url']));

```

#### 设置数组元素值支持点语法

```
$data=[];
print_r(Arr::set($data,'a.b.c',99));

```

#### 改变数组键名大小写

```
Arr::keyCase(array('name'=>'houdunwang',array('url'=>'hdphp.com')),1); 
第2个参数为类型： 1 大写  0 小写

```

#### 不区分大小写检测键名是否存

```
Arr::keyExists('Hd',['hd'=>'后盾网']);

```

#### 数组值大小写转换

```
Arr::valueCase(['name'=>'houdunwang'],1); 
第2个参数为类型： 1 大写  0 小写

```

#### 数组进行整数映射转换

```
$data = ['status'=>1];
$d = Arr::intToString($data,['status'=>[0=>'关闭',1=>'开启']]); 

```

生成的结果如下

```
$d=['status'=>1,'_status'=>'开启'];

```

#### 数组中的字符串数字转为数值类型

```
$data = ['status'=>'1','click'=>'200'];
$d = Arr::stringToInt($data); 

```

#### 根据下标过滤数据元素

```
$d = [ 'id' => 1, 'url' => 'houdunwang.com','title'=>'后盾网' ];
print_r(Arr::filterKeys($d,['id','url']));
//过滤 下标为 id 的元素

```

当第三个参数为 0 时只保留指定的元素

```
$d = [ 'id' => 1, 'url' => 'houdunwang.com','title'=>'后盾网' ];
print_r(Arr::filterKeys($d,['id'],0));
//只显示id与title 的元素

```

#### 获得树状结构

```
Arr::tree($data, $title, $fieldPri = 'cid', $fieldPid = 'pid');
参数                   说明
$data                 	数组
$title                	字段名称
$fieldPri             	主键 id
$fieldPid             	父 id

```

示例

```
$data = [
	['cid' => 1, 'pid' => 0, 'title' => '新闻'],
	['cid' => 2, 'pid' => 1, 'title' => '国内新闻'],
];
$d    = \houdunwang\arr\Arr::tree($data, 'title', 'cid', 'pid');

```

#### 获得目录列表

```
Arr::channelList($data, $pid = 0, $html = "&nbsp;", $fieldPri = 'cid', $fieldPid = 'pid');
参数                     说明 
data                 	操作的数组
pid                  	父级栏目的 id 值
html                	栏目名称前缀，用于在视图中显示层次感的栏目列表 
fieldPri              	唯一键名，如果是表则是表的主键
fieldPid              	父 ID 键名

```

#### 获得多级目录列表（多维数组）

```
Arr::channelLevel($data, $pid = 0, $html = "&nbsp;", $fieldPri = 'cid', $fieldPid = 'pid') 
参数                         说明
data                      	操作的数组
pid                      	父级栏目的 id 值
html                     	栏目名称前缀，用于在视图中显示层次感的栏目列表
fieldPri                 	唯一键名，如果是表则是表的主键
fieldPid                  	父 ID 键名

```

#### 获得所有父级栏目

```
Arr::parentChannel($data, $sid, $fieldPri = 'cid', $fieldPid = 'pid');
参数                         说明
data                      	操作的数组
sid                      	子栏目
fieldPri                 	唯一键名，如果是表则是表的主键
fieldPid                  	父 ID 键名

```

#### 是否为子栏目

```
Arr::isChild($data, $sid, $pid, $fieldPri = 'cid', $fieldPid = 'pid')
参数                         说明
data                      	操作的数组
sid                      	子栏目id
pid                      	父栏目id
fieldPri                 	唯一键名，如果是表则是表的主键
fieldPid                  	父 ID 键名

```

#### 是否有子栏目

```
Arr::hasChild($data, $cid, $fieldPid = 'pid')
参数                         说明
data                      	操作的数组
cid                      	栏目cid
fieldPid                  	父 ID 键名

```

#### 迪卡尔乘积

```
Arr::descarte($arr, $tmp = array())
```

