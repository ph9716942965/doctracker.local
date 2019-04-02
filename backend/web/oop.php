<?php 

class A
{
  public $SID;
  function __construct($sid = null) {
      $this->SID = $sid;
    }
  
   public static function con($obj){
      return new A($obj);
   }

  public function test($data=null){
    //$d=new A;
      return "test F(x)= ".$this->SID;
    }
  public function test2($data2=null){
       return "test2 F(x)= ".$this->SID;
    }
}

echo A::con(2)->test();