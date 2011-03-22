<?php
/**
 * Wrapper für Datentyp Double (signed)
 *
 */
class Basic_Datatype_Scalar_Double extends Basic_Datatype_Object implements Basic_Datatype_Scalar_Interface
{
    /**
     * Minimaler Wert des Doubles
     *
     * @var int
     */
    const MIN_VALUE = -1.8e307;

    /**
     * Maximaler Wert des Doubles
     * Der Wert ist abhängig vom System
     * @see http://www.php.net/manual/de/language.types.float.php
     * @var int
     */
    const MAX_VALUE = 1.8e307;

    /**
     * Wert
     *
     * @var float
     */
    protected $_value;

    /**
     * Initialisiert das Objekt
     *
     * @param float $value
     */
    public function __construct($value = 0)
    {
        $this->setValue($value);
    }

    /**
     * Setzt den Wert
     * @todo Es muss noch eine Prüfung auf das Gesamtvolumen gemacht werden
     * @param float $value
     */
    public function setValue($value)
    {
        if ($value >= self::MIN_VALUE && $value <= self::MAX_VALUE) {
            $this->_value = (float)$value;
            return $this;
        }
        throw new OutOfBoundsException(sprintf("Given value %s is not a double. Try to cast.", $value));
    }

    /**
     * Gibt den Wert zurück
     *
     * @return float
     */
    public function getValue()
    {
        return $this->_value;
    }

    /**
     * Versucht aus dem gegebenen Objekt zu parsen
     * Diese Funktion ist erstmal sehr rudimentär
     * Im Grunde genommen ein einfacher PHP cast
     *
     * @param mixed $value
     * @return Basic_Datatype_Scalar_Double
     */
    public function parse($value)
    {
        $this->setValue((float)$value);
        return $this;
    }

    /**
     * Konvertiert nach Boolean
     *
     * @return Basic_Datatype_Scalar_Boolean
     */
    public function toBoolean()
    {
        return new Basic_Datatype_Scalar_Boolean((($this->getValue() != 0) ? true : false));
    }

    /**
     * Gibt den Wert als Double zurück
     * Erfüllt das Interface
     *
     * @return Basic_Datatype_Scalar_Double
     */
    public function toDouble()
    {
        return $this;
    }

    /**
     * Konvertiert nach Integer
     *
     * Dieser Cast kann verlusbehaftet sein. Es werden nur die Vorkommastellen übernommen
     *
     * @return Basic_Datatype_Scalar_Double
     */
    public function toInteger()
    {
        return new Basic_Datatype_Scalar_Integer((int)$this->getValue());
    }

    /**
     * Gibt den Float als String zurück
     *
     * @return Basic_Datatype_Scalar_String
     */
    public function toString()
    {
        return new Basic_Datatype_Scalar_String((string)$this->_value);
    }
}
