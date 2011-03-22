<?php
interface Basic_Datatype_Object_Interface
{
    /**
     * Gibt die Stringrepresentation des Objekts zurück
     *
     * @return string
     */
    public function toString();

    /**
     * Gibt den Namen der Klasse zurück
     *
     * @return string;
     */
    public function getType();

    /**
     * Erstellt eine Kopie der aktuellen Instanz und gibt diese zurück
     *
     * @return Basic_Datatype_Object
     */
    public function copy();
}