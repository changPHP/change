<?php 

/**
 * @author changPHP@163.com
 * 
 * @param urlQuery() 将url地址截取为键值对形式
 * @param microtime_time() 返回当前时间戳 17 位
 **/

class Sulation{

    /**
     * @access public 
     *
     * @param string $str 接受地址栏内内的参数值
     * @return array 返回类型 
     **/
    public function urlQuery($str)
    {
        $parts = explodey('&', $str);
        $params = [];
        foreach ($parts as $param) {
            $item = explode('=', $param);
            $params[$item[0]] = $item[1];
        }
        return $params;
    }
    
    /**
     * @access public 
     *
     * @return int 返回类型
     **/
    public function microtime_time()
    {
        list($t1, $t2) = explode(' ', microtime());
        $time = (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
        $tionid_time = date('YmdHis',$t2).substr($time,(strlen($time) - 3),3);
        return $tionid_time;
    }
}


?>
