<?php
/**
 * Wrapper für Datentyp String
 *
 */
class Basic_Datatype_Scalar_String extends Basic_Datatype_Object implements Basic_Datatype_Scalar_Interface
{
    /**
     * Wert
     *
     * @var string
     */
    protected $_value;

    /**
     * Initialisiert das Objekt
     *
     * @param string $value
     */
    public function __construct($value = '')
    {
        $this->setValue($value);
    }

    /**
     * Setzt den Wert
     *
     * @param string $value
     */
    public function setValue($value)
    {
        $this->_value = (string)$value;
        return $this;
    }

    /**
     * Gibt den Wert zurück
     *
     * @return string
     */
    public function getValue()
    {
        return $this->_value;
    }

    /**
     * Der Wert wird in String umgewandelt
     * Bei diesem Cast kann nichts kaputt gehen
     *
     * @return Basic_Datatype_Scalar_String
     */
    public function parse($value)
    {
        $this->setValue($value);
        return $this;
    }

    /**
     * Gibt den String als Boolean zurück
     *
     * @return Basic_Datatype_Scalar_Boolean
     */
    public function toBoolean()
    {
        $object = new Basic_Datatype_Scalar_Boolean();
        return $object->parse($this->getValue());
    }

    /**
     * Gibt den String als Double zurück
     *
     * @return Basic_Datatype_Scalar_Double
     */
    public function toDouble()
    {
        $object = new Basic_Datatype_Scalar_Double();
        return $object->parse($this->getValue());
    }

    /**
     * Gibt den String als Integer zurück
     *
     * @return Basic_Datatype_Scalar_Integer
     */
    public function toInteger()
    {
        $object = new Basic_Datatype_Scalar_Integer();
        return $object->parse($this->getValue());
    }

    /**
     * Gibt das Stringobjekt zurück
     *
	 * @return Basic_Datatype_Scalar_String
     */
    public function toString()
    {
        return $this;
    }

    /**
     * Die magische Methode gibt den skalaren PHP string zurück.
     * Das ist für diese Klasse notwendig, da PHP manchmal automatisch
     * nach string konvertieren will (echo, printf). Andere Typen sollten vorher in
     * String konvertiert werden.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->_value;
    }

    /**
     * Gibt zurück ob der String Zeichen enthält
     *
     * @return Basic_Datatype_Scalar_Boolean
     */
    public function isEmpty()
    {
        return new Basic_Datatype_Scalar_Boolean((mb_strlen($this->getValue()) == 0) ? true : false);
    }

    /**
     * Teilt die Zeichenkette am angegebenen Zeichen auf
     *
     * @todo ArrayObjekt nehmen
     * @param Basic_Datatype_Scalar_String $delimiter
     * @return array
     */
    public function split(Basic_Datatype_Scalar_String $delimiter)
    {
        return explode($delimiter->getValue(), $this->getValue());
    }

    /**
     * Prüft ob die Zeichenkette mit dem angegebenen Wort anfängt
     *
     * @param Basic_Datatype_Scalar_String $value
     * @param Basic_Datatype_Scalar_Boolean $caseSensitive
     * @return Basic_Datatype_Scalar_Boolean
     */
    public function startsWith(Basic_Datatype_Scalar_String $value, Basic_Datatype_Scalar_Boolean $caseSensitive = null)
    {
        // Optionale Parameter prüfen und setzen
        if ($caseSensitive === null) $caseSensitive = new Basic_Datatype_Scalar_Boolean(false);

        if (mb_strlen($value) <= mb_strlen($this->getValue())) {
            // Nur prüfen, wenn der String auch kleiner als der interne Wert ist
            if ($caseSensitive->isTrue()) {
                // Groß/Kleinschreibung beachten
                if (mb_substr($this->getValue(), 0, mb_strlen($value)) == $value) {
                    return new Basic_Datatype_Scalar_Boolean(true);
                }
            } else {
                // Groß/Kleinschreibung nicht beachten
                if (mb_strtolower(mb_substr($this->getValue(), 0, mb_strlen($value))) == mb_strtolower($value)) {
                    return new Basic_Datatype_Scalar_Boolean(true);
                }
            }
        }
        return new Basic_Datatype_Scalar_Boolean(false);
    }

    /**
     * Prüft ob die Zeichenkette mit dem angegebenen Wort aufhört
     *
     * @param Basic_Datatype_Scalar_String $value
     * @param Basic_Datatype_Scalar_Boolean $caseSensitive
     * @return Basic_Datatype_Scalar_Boolean
     */
    public function endsWith(Basic_Datatype_Scalar_String $value, Basic_Datatype_Scalar_Boolean $caseSensitive = null)
    {
        // Optionale Parameter prüfen und setzen
        if ($caseSensitive === null) $caseSensitive = new Basic_Datatype_Scalar_Boolean(false);

        if (mb_strlen($value) <= mb_strlen($this->getValue())) {
            // Nur prüfen, wenn der String auch kleiner als der interne Wert ist
            if ($caseSensitive->isTrue()) {
                // Groß/Kleinschreibung beachten
                if (mb_substr($this->getValue(), -(mb_strlen($value))) == $value) {
                    return new Basic_Datatype_Scalar_Boolean(true);
                }
            } else {
                // Groß/Kleinschreibung nicht beachten
                if (mb_strtolower(mb_substr($this->getValue(), -(mb_strlen($value)))) == mb_strtolower($value)) {
                    return new Basic_Datatype_Scalar_Boolean(true);
                }
            }
        }
        return new Basic_Datatype_Scalar_Boolean(false);
    }

    /**
     * Entfernt alle Leerzeichen am Anfang und am Ende des internen Wertes
     *
     * @return Basic_Datatype_Scalar_String
     */
    public function trim()
    {
        return $this->setValue(trim($this->getValue()));
    }

    /**
     * Entfernt alle Leerzeichen am Anfang des internen Wertes
     *
     * @return Basic_Datatype_Scalar_String
     */
    public function trimStart()
    {
        return $this->setValue(ltrim($this->getValue()));
    }

    /**
     * Entfernt alle Leerzeichen am Ende des internen Wertes
     *
     * @return Basic_Datatype_Scalar_String
     */
    public function trimEnd()
    {
        return $this->setValue(rtrim($this->getValue()));
    }

    /**
     * Gibt eine in Großbuchstaben konvertierte Kopie dieser Zeichenfolge zurück.
     *
     * @return Basic_Datatype_Scalar_String
     */
    public function toUpper()
    {
        return new Basic_Datatype_Scalar_String(mb_strtoupper($this->getValue()));
    }

    /**
     * Gibt eine in Kleinbuchstaben konvertierte Kopie dieser Zeichenfolge zurück.
     *
     * @return Basic_Datatype_Scalar_String
     */
    public function toLower()
    {
        return new Basic_Datatype_Scalar_String(mb_strtolower($this->getValue()));
    }
}
