<?php
namespace Tool\Picture;
/**
 * Created by PhpStorm.
 * User: gzq
 * Date: 2019/4/15
 * Time: 10:43
 * 图片处理函数
 */
class Picture{
    /**
     * 获取图片宽高和显示方式
     * @param string $image_soure
     * @return array
     */
    public static function get_atlas_data($image_soure){
        if(empty($image_soure)){
            return array();
        }
        $image_data=@getimagesize(self::get_image_upload_base_path().$image_source);
        $resultArr=array(
            "source_image"=>self::get_image_resource_cdn($image_source),
            "thumb_width"    => $image_data[0],
            "thumb_height"    => $image_data[1],
            "pic_show_type" => $image_data[0]>$image_data[1] ? 2 : 1,
        );
        return $resultArr;
    }

    /**
     * 返回图片上传的基本路径
     * @return string
     */
    public static function get_image_upload_base_path(){
        return dirname(FCPATH)."/".ReturnImageDomain();
    }

    /**
     * 返回图片资源域
     * @return null|string|string[]
     */
    public static function get_image_domain(){
        return preg_replace("/https?:\/\//i","",ImageResourceDomain);
    }

    /**
     * 返回基于图片资源域的路径
     * @param string $imgPath
     * @return string
     */
    public static function get_image_resource_cdn($imgPath){
        if(empty($imgPath)) return "";
        if(preg_match("/^https?/i",$imgPath)) return $imgPath;
        return ImageResourceDomain.$imgPath;
    }
}
