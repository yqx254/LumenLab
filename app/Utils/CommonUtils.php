<?php


namespace App\Utils;


class CommonUtils{
    /**
     * @param $result
     * @param array $data
     * @param string $msg
     * @param int $errorCode
     * @return \Illuminate\Http\JsonResponse
     * 通用的json返回方法
     */
    public static function jsonResponse($result,$data = [],$msg = "", $errorCode = 0){
        $res = [
            "result"    => $result,
            "msg"       => $msg,
            "data"      => $data,
            "errCode"   => $errorCode
        ];
//        return response()->json($res);
        return response(self::jsonEncodeWithCN($res))->withHeaders([
            'Content-Type'  => 'application/json'
        ]);
    }

    /**
     * @param $data
     * @return false|mixed|string
     * 中文编码，是否有必要？
     */
    private static function jsonEncodeWithCN($data)    {
        $json1 = json_encode($data, JSON_UNESCAPED_UNICODE);
        $json1 = str_replace("\\/", "/", $json1);
        return $json1;
    }
}