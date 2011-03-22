<?php
/**
 * Wrapper für Datentyp Integer (signed)
 *
 */
class Basic_Datatype_Scalar_Integer extends Basic_Datatype_Object implements Basic_Datatype_Scalar_Interface
{
    /**
     * Minimaler Wert des Integers
     *
     * @var int
     */
    const MIN_VALUE = -2147483648;

    /**
     * Maximaler Wert des Integers
     * Der Wert ist abhängig vom System
     * @see http://php.net/manual/de/language.types.integer.php
     * @var int
     */
    const MAX_VALUE = 2147483647;

    /**
     * Wert
     *
     * @var int
     */
    protected $_value;

    /**
     * Initialisiert das Objekt
     *
     * @param int $value
     */
    public function __construct($value = 0)
    {
        $this->setValue($value);
    }

    /**
     * Setzt den Wert
     *
     * @param int $value
     */
    public function setValue($value)
    {
        if ($value >= self::MIN_VALUE && $value <= self::MAX_VALUE) {
            $this->_value = (int)$value;
            return $this;
        }
        throw new OutOfBoundsException(sprintf("Given value %s is not an integer. Try to cast.", $value));
    }

    /**
     * Gibt den Wert zurück
     *
     * @return int
     */
    public function getValue()
    {
        return $this->_value;
    }

    /**
     * Gibt zurück ob der angegebene Wert mit dem aktuellen Wert übereinstimmt
     *
     * @param Basic_Datatype_Scalar_Integer $value
     * @return Basic_Datatype_Scalar_Boolean
     */
    public function equals(Basic_Datatype_Scalar_Integer $value)
    {
        return new Basic_Datatype_Scalar_Boolean($this->getValue() == $value->getValue());
    }

    /**
     * Gibt zurück ob der interne Wert größer als der angegeben Wert ist
     *
     * @param Basic_Datatype_Scalar_Integer $value
     * @return Basic_Datatype_Scalar_Boolean
     */
    public function greaterThan(Basic_Datatype_Scalar_Integer $value)
    {
        return new Basic_Datatype_Scalar_Boolean($this->getValue() > $value->getValue());
    }

    /**
     * Gibt zurück ob der interne Wert kleiner als der angegebene Wert ist
     *
     * @param Basic_Datatype_Scalar_Integer $value
     * @return Basic_Datatype_Scalar_Boolean
     */
    public function lowerThan(Basic_Datatype_Scalar_Integer $value)
    {
        return new Basic_Datatype_Scalar_Boolean($this->getValue() < $value->getValue());
    }

    /**
     * Addiert einen Integer
     *
     * @param Basic_Datatype_Scalar_Integer $value
     */
    public function add(Basic_Datatype_Scalar_Integer $value)
    {
        $this->setValue($this->getValue() + $value->getValue());
    }

    /**
     * Addiert einen Double
     * Diese Addition ist u.U. verlusbehaftet, da Double erst konvertiert werden muss
     *
     * Hier kommt genau das Problem mit der fehlenden Überladung zum tragen.
     *
     * @param Basic_Datatype_Scalar_Double $value
     */
    public function addDouble(Basic_Datatype_Scalar_Double $value)
    {
        $this->setValue($this->getValue() + $value->toInteger()->getValue());
    }

    /**
     * Versucht aus dem gegebenen Objekt zu parsen
     * Diese Funktion ist erstmal sehr rudimentär und schneidet u.U. Stellen ab
     * Im Grunde genommen ein einfacher PHP cast
     *
     * @param mixed $value
     * @return Basic_Datatype_Scalar_Integer
     */
    public function parse($value)
    {
        $this->setValue((int)$value);
        return $this;
    }

    /**
     * Konvertiert nach Boolean
     *
     * @return Basic_Datatype_Scalar_Boolean
     */
    public function toBoolean()
    {
        $object = new Basic_Datatype_Scalar_Boolean();
        return $object->parse($this->getValue());
    }

    /**
     * Konvertiert nach Double
     *
     * @return Basic_Datatype_Scalar_Double
     */
    public function toDouble()
    {
        return new Basic_Datatype_Scalar_Double((float)$this->getValue());
    }

    /**
     * Gibt den Wert als Integer zurück
     * Erfüllt das Interface
     *
     * @return Basic_Datatype_Scalar_Integer
     */
    public function toInteger()
    {
        return $this;
    }

    /**
     * Gibt den Integer als String zurück
     *
     * @return Basic_Datatype_Scalar_String
     */
    public function toString()
    {
        return new Basic_Datatype_Scalar_String((string)$this->_value);
    }
}
