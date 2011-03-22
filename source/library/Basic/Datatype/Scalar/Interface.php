<?php
interface Basic_Datatype_Scalar_Interface
{
    /**
     * Setzt den skalaren Wert
     *
     * @param mixed $value
     */
    public function setValue($value);

    /**
     * Gibt den skalaren Wert zurück
     *
     * @return mixed
     */
    public function getValue();

    /**
     * Versucht den Wert umzuwandeln
     *
     * @return mixed
     */
    public function parse($value);

    /**
     * Gibt den Wert als Wahrheitswert zurück
     *
     * @return Basic_Datatype_Scalar_Boolean
     */
    public function toBoolean();

    /**
     * Gibt den Wert als Float zurück
     *
     * @return Basic_Datatype_Scalar_Double
     */
    public function toDouble();

    /**
     * Gibt den Wert als Ganzzahl zurück
     *
     * @return Basic_Datatype_Scalar_Integer
     */
    public function toInteger();

    /**
     * Gibt den Wert als String zurück
     *
     * @return Basic_Datatype_Scalar_String
     */
    public function toString();
}