<?php
/**
 * Created by PhpStorm.
 * User: Unit
 * Date: 2/14/2018
 * Time: 5:22 PM
 */

namespace App;


class Calc
{

    public function div($int, $int1)
    {
        try{
            return $int / $int1;  
        }catch (\Exception $e){
            return "Nan";
        }
    }
}