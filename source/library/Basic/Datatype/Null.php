<?php
/**
 * Wrapper für NULL
 *
 */
class Basic_Datatype_Null extends Basic_Datatype_Object
{
    /**
     * Gibt den Wert zurück
     *
     * @return int
     */
    public function getValue()
    {
        return null;
    }

    /**
     * Konvertiert nach Boolean
     *
     * @return Basic_Datatype_Scalar_Boolean
     */
    public function toBoolean()
    {
        return new Basic_Datatype_Scalar_Boolean(false);
    }

    /**
     * Konvertiert nach Double
     *
     * @return Basic_Datatype_Scalar_Double
     */
    public function toDouble()
    {
        return new Basic_Datatype_Scalar_Double(0);
    }

    /**
     * Konvertiert nach Integer
     *
     * @return Basic_Datatype_Scalar_Integer
     */
    public function toInteger()
    {
        return new Basic_Datatype_Scalar_Integer(0);
    }

    /**
     * Konvertiert nach String
     *
     * @return Basic_Datatype_Scalar_String
     */
    public function toString()
    {
        return new Basic_Datatype_Scalar_String('');
    }
}
