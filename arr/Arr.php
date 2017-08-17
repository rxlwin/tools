<?php
namespace rxlwin\tools\arr;

/**
 * Class View
 * @package myself\view
 */
class Arr{
    /**
     * @param $name 外部调用的没有找到的方法名
     * @param $arguments 调用方法时所带的参数
     * @return mixed 这此我们直接返回了调用本类下run方法所返回的内容
     *
     */
    public function __call($name, $arguments)
    {
        return self::run($name, $arguments);
    }

    /**
     * 静态方法拦截器 __callStatic 当外部静态调用应用模型类中一个本类和基类都不存在的方法中,触发本方法
     * @param $name 外部调用的没有找到的方法名
     * @param $arguments 调用方法时所带的参数
     * @return mixed 这此我们直接返回了调用run方法所返回的内容
     *
     */
    public static function __callStatic($name, $arguments)
    {
        //1.静态调用run方法并返回 2.因为这里有代码重用,所以我们又封装了一个方法用来调用
        return self::run($name, $arguments);
    }

    /**
     * 封装的用来实例化Base类并调用其方法的方法
     * @param $name 外部调用的没有找到的方法名
     * @param $arguments 调用方法时所带的参数
     * @return mixed 调用Base类下$name方法时的返回值,我们原封不动的全部返回去
     */
    private static function run($name, $arguments){
        //1.使用call_user_func_array函数调用Base中的$name方法 2.这里使用函数调用而不是直接调用,主要的原因在后面的参数上,如果直接调用,参数可能会混乱,而使用此函数进行方法调用,此函数会自动根据方法所需要的参数类型转换.兼容率更高.(再详细解释一下,方法中有时是用数据做参数,有时使用字符串做参数,而在使用字符串做参数时,可能会使2个或更多的字符串,因为我们调用时,是使用的魔术方法来进行调用的,参数经过几次转手,已经统一都变成了数组类型,这时,如果我们直接调用时($obj->method($arguments)),参数的数量和类型就很可能会出错了;而这个函数就会把我们调用时使用的参数类型准备好,根据所调用方法需要的类型转换,最终成功调用)
       return call_user_func_array([new Base(),$name],$arguments);
    }
}