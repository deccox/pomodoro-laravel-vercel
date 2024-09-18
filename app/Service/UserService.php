<?php

namespace App\Service;

use App\Models\TimerRegister;
use PhpParser\Node\Arg;

class UserService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    public function getRegisterFormated(){
        $data = $this->getAllRegisterTimer();
        $data = $this->FormatDatePerDay($data);
        $data = $this->FormatHourTimer($data);
        return $data ;
    }
    /**
     * @return array
     */
    public function getAllRegisterTimer(): Array
    {
        $data = TimerRegister::select('timer_quantity', 'timer_day')->get()->toArray();
        return $data;
    }


    public function FormatDatePerDay($data): Array{

        $data = array_map(function($item){

            preg_match("/-(\d+)-/", $item['timer_day'], $matches);

            $item['timer_day'] = $matches[1];
            
            return $item;

        }, $data);
        
   
        return $data;

    }

    public function FormatHourTimer($data): Array{

        $data = array_map(function($item){
            preg_match("/\d+:\d+/", $item['timer_quantity'], $matches);
            $item['timer_quantity'] = $matches[0];

            return $item;
        }, $data);

        return $data;
    }
}
