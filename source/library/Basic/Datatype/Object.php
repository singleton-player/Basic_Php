<?php
class Basic_Datatype_Object implements Basic_Datatype_Object_Interface
{
    public function toString()
    {
        return 'Object';
    }

    /**
     * Gibt den Namen der Klasse zurück
     *
     * @return Basic_Datatype_Scalar_String
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