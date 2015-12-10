<?php
/**
 * Created by PhpStorm.
 * User: cejixo3
 * Date: 09.12.15
 * Time: 21:10
 */

namespace app\helpers\url;


use yii\helpers\Url;

/**
 * Shortcuts for Books
 * Class Books
 * @package app\helpers\url
 */
class Books
{
    /**
     * Generate Base Books Url
     * @param string $route
     * @param array $param
     * @return string
     */
    public static function base($route, $param = [])
    {
        $route = empty($param) ? '/books/' . $route : ['/books/' . $route, $param];
        return Url::toRoute($route);
    }


    /**
     * books/index
     * @return string
     */
    public static function index()
    {
        return static::base('index');
    }


    /**
     * books/view
     * @return string
     */
    public static function view()
    {
        return static::base(['view']);
    }


    /**
     * books/update
     * @return string
     */
    public static function update()
    {
        return static::base(['update']);
    }


    /**
     * books/remove
     * @return string
     */
    public static function remove()
    {
        return static::base(['remove']);
    }
}