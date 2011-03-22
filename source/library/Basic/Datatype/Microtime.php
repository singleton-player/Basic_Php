<?php
/**
 * Die Ableitung von double verdeutlicht, wie einfach skalare Werte nun in
 * eigene Objekte überführt werden können.
 */
class Basic_Datatype_Microtime extends Basic_Datatype_Scalar_Double
{
    public static function now()
    {
        return new Basic_Datatype_Microtime(microtime(true));
    }
}