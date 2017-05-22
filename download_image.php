<?php

/**
 * @param string $url       图片的地址
 * @param string $fileName  文件名称
 * @param $dirName          文件目录名称
 * @param array $fileType   文件类型
 * @param int $type         使用curl还是缓冲来获取图片
 * @return array|bool
 */

function download_image($url = '', $fileName = '', $dirName, $fileType = ['jpg', 'gif', 'png'], $type = 1)
{
    if ($url == '') {
        return false;
    }

    //获取文件名
    $defaultFileNmae = basename($url);

    //获取文件类型
    $suffix = substr(strrchr($url, '.'), 1);
    if (!in_array($suffix, $fileType)) {
        return false;
    }

    //设置保存文件的后缀名
    $fileName = $fileName == '' ? time() . rand(0, 9) . '.' .$suffix : $defaultFileNmae;

    //获取远程文件资源
    if ($type) {
        $ch = curl_init();
        $timeout = 30;
        curl_setopt($ch, CURLOPT_URL, $url);                   // 需要获取的url地址
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    // 将获取到的信息以字符串的形式返回
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);    // 在尝试连接时等待的秒数。设置为0，则无限等待。
        $file = curl_exec($ch);                                        // 执行curl参数
        curl_close($ch);                                               // 关闭curl
    }else{
        echo "false";
        ob_start();                 // 打开输出控制缓冲
        readfile($url);             // 输出文件
        $file = ob_get_contents();  // 返回缓冲区的内容
        ob_end_clean();             // 清空缓冲区并关闭输出缓冲
    }

    // 设置保存文件路径
    $dirName = $dirName . '/'. date("Y-m-d", time());
    if (!file_exists($dirName)) {
        mkdir($dirName, 0777, true);
    }

    //保存文件
    $res = fopen($dirName. '/' . $fileName, 'a');
    fwrite($res, $file);
    fclose($res);

    return [
        'fileName' => $fileName,
        'saveDir'  => $dirName
        ];
}

download_image('http://imgsrc.baidu.com/baike/abpic/item/6648d73db0edd1e89f3d62f7.jpg', '', './', ['jpg', 'gif', 'png'], 0);