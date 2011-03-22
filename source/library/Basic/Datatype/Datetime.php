<?php
/**
 * Wrapper für Date/Time aus dem Zend Framework
 *
 */
class Basic_Datatype_Datetime extends Zend_Date implements Basic_Datatype_Object_Interface
{
    /**
     * Returns the actual date as new date object
     *
     * Überschrieben, damit die Funktion auch das richtige Objekt zurückgibt
     *
     * @param  string|Zend_Locale        $locale  OPTIONAL Locale for parsing input
     * @return Zend_Date
     */
    public static function now($locale = null)
    {
        $date = new Basic_Datatype_Datetime();
        $date->setDate(parent::now());
        return $date;
    }

    /**
     * Gibt den Namen der Klasse zurück
     *
     * @return string;
     */
    public function getType()
    {
        return new Basic_Datatype_Scalar_String(__CLASS__);
    }

    /**
     * Erstellt eine Kopie der aktuellen Instanz und gibt diese zurück
     *
     * @return Basic_Datatype_Object
     */
    public function copy()
    {
        return clone($this);
    }
}
