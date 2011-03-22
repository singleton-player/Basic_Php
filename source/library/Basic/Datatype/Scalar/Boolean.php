<?php
/**
 * Wrapper für Datentyp Boolean
 *
 */
class Basic_Datatype_Scalar_Boolean extends Basic_Datatype_Object implements Basic_Datatype_Scalar_Interface
{
    /**
     * Falsch
     *
     * @var boolean
     */
    const FALSE = false;

    /**
     * Wahr
     *
     * @var boolean
     */
    const TRUE = true;

    /**
     * Wert
     *
     * @var boolean
     */
    protected $_value;

    /**
     * Initialisiert das Objekt
     *
     * @param boolean $value
     */
    public function __construct($value = false)
    {
        $this->setValue($value);
    }

    /**
     * Setzt den Wert
     *
     * @param boolean $value
     */
    public function setValue($value)
    {
        if ($value === self::FALSE || $value === self::TRUE) {
            $this->_value = $value;
            return $this;
        }
        throw new OutOfBoundsException(sprintf("Given value %s is eather false nor true. Try to cast.", $value));
    }

    /**
     * Gibt den Wert zurück
     *
     * @return boolean
     */
    public function getValue()
    {
        return $this->_value;
    }

    /**
     * Gibt Wahr zurück, wenn der interne Wert Wahr ist
     *
     * @return boolean
     */
    public function isTrue()
    {
        return $this->_value === true;
    }

    /**
     * Gibt Falsch zurück, wenn der interne Wert nicht Wahr ist
     *
     * @return boolean
     */
    public function isFalse()
    {
        return $this->_value === false;
    }

    /**
     * Versucht aus dem gegebenen Objekt zu parsen
     * Diese Funktion ist erstmal sehr rudimentär und schneidet u.U. Stellen ab
     * Im Grunde genommen ein einfacher PHP cast
     *
     * @param mixed $value
     * @return Basic_Datatype_Scalar_Boolean
     */
    public function parse($value)
    {
        if ($value === true || $value === false) {
            // Ist ja eigentlich klar
            $this->setValue($value);
        } elseif (is_float($value) || is_int($value)) {
            // Ist Wahr, wenn der Wert ungleich 0 ist
            $this->setValue(($value != 0) ? true : false);
        } elseif (is_string($value)) {
            // String kann entweder True oder False enthalten
            // oder es wird nach Empty/Not Empty entschieden
            $this->setValue((mb_strtolower($value) == 'true' || ($value != '' && mb_strtolower($value) != 'false')) ? true : false);
        } else {
            // Hardcore PHP bool cast verwenden (zb für Objekte)
            $this->setValue((bool)$value);
        }
        return $this;
    }

    /**
     * Gibt sich selbst zurück
     * Erfüllt nur das Interface
     *
     * @return Basic_Datatype_Scalar_Boolean
     */
    public function toBoolean()
    {
        return $this;
    }

    /**
     * Konvertiert nach Double
     *
     * @return Basic_Datatype_Scalar_Double
     */
    public function toDouble()
    {
        return $this->toInteger()->toDouble();
    }

    /**
     * Konvertiert nach Integer
     *
     * @return Basic_Datatype_Scalar_Integer
     */
    public function toInteger()
    {
        return new Basic_Datatype_Scalar_Integer((($this->isTrue()) ? 1 : 0));
    }

    /**
     * Gibt den Boolean als String zurück
     *
     * @return Basic_Datatype_Scalar_String
     */
    public function toString()
    {
        return new Basic_Datatype_Scalar_String(($this->_value === true) ? 'True' : 'False');
    }
}
