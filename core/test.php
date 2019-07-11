<?php

namespace Korn\Core;

class Test{
    private $test = null;
    public function get_test(){
        $this->test = "Test text";
        return $this->test;
    }
}
?>