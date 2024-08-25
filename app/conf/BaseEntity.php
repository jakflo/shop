<?php

namespace app\conf;


class BaseEntity implements \JsonSerializable
{
    public function resetProperties()
    {
        foreach (get_object_vars($this) as &$value) {
            $value = null;
        }
        return $this;
    }
    
    public function getProperties(): \stdClass
    {
        $return = new \stdClass();
        foreach (get_object_vars($this) as $name => $value) {
            $return->$name = $value;
        }
        
        return $return;
    }
    
    public function getXml()
    {
        //TODO
    }
    
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
    
}
