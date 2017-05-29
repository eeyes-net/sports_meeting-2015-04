<?php

namespace Admin\Behavior;

class LoginBehavior
{
    public function run(&$return)
    {
        if (session('?name')) {
            $return = true;
        } else {
            $return = false;
        }
    }
}
