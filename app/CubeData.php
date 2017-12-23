<?php
/**
 * Created by PhpStorm.
 * User: jhonnyquest
 * Date: 22/12/17
 * Time: 09:26 AM
 */

namespace App;


class CubeData
{
    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public function returnValue($key)
    {
        $value = null;
        if (isset($_SESSION[$key])) {
            $value = $_SESSION[$key];
        }
        return $value;
    }

    public function setKeyValue($key, $value)
    {
            $_SESSION[$key] = $value;
    }

    public function setCubeValue($x, $y, $z, $value){
        $_SESSION['cube'][$x][$y][$z] = $value;
    }

    public function getQuery($x1, $y1, $z1, $x2, $y2, $z2){
        $sum = 0;
        for ($i = $x1; $i <= $x2; $i++) {
            for ($j = $y1; $j <= $y2; $j++) {
                for ($k = $z1; $k <= $z2; $k++) {
                    $sum = $sum + $_SESSION['cube'][$i][$j][$k];
                }
            }
        }
        return $sum;
    }

    public function setCube($newCube, $actions){
        $_SESSION['cube'] = $newCube;
        $_SESSION['initial_actions'] = $actions;
    }

    public function deleteSession(){
        session_destroy();
    }
}