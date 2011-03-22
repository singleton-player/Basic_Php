<?php
/**
 * Gemanagter PHP Funktionswrapper
 *
 */
class Basic_Php extends Basic_Datatype_Object
{
    /**
     * Hält die Gesamtzahl der erstellten Objekte
     * Dann muss man die nicht immer ausrechnen
     *
     * @var Basic_Datatype_Scalar_Integer
     */
    protected $_objectCount = null;

    /**
     * Zwischenspeicher für aktuelle angelegte Objekte
     *
     * Für irgendwas muss es ja gut sein, die PHP Schicht als Klasse anzulegen und nicht
     * nur als Funktionssammlung. Hier wird jedes über Basic_Php gemanagetes Objekt
     * zwischengespeichert. Damit lassen sich zum Beispiel Auswertungen machen.
     * @todo ArrayObjekt
     */
    protected $_objects = array(
        'boolean' => array(),
        'double' => array(),
        'integer' => array(),
        'string' => array(),
        'other' => array());

    /**
     * Die Erstellungszeit der Klasse.
     * Einfach nur damit ich Verwendung für die Datetime Klasse habe
     *
     * @var Basic_Datatype_Datetime
     */
    protected $_startTime = null;

    /**
     * Die Erstellungszeit der Klasse als microtime.
     *
     * @todo Microtime auch als Klasse anlegen
     * @var Basic_Datatype_Scalar_Double
     */
    protected $_startMicrotime = null;

    /**
     * Entspricht der Zeit, an der das letzte Mal die Score Zeit abgerufen wurde
     *
     * @var Basic_Datatype_Scalar_Double
     */
    protected $_lapStartMicrotime = null;

    /**
     * Initialisiert das Objekt
     *
     * @return Basic_Php
     */
    public function __construct()
    {
        $this->_objectCount = new Basic_Datatype_Scalar_Integer(0);
        $this->_startTime = Basic_Datatype_Datetime::now();
        $this->_startMicrotime = Basic_Datatype_Microtime::now();
        $this->_lapStartMicrotime = $this->_startMicrotime->copy();
    }

    /**
     * Gibt die Sekunden (Microsekunden genau) zurück, die seit Erstellung der Klasse
     * vergangen sind.
     *
     * @return Basic_Datatype_Scalar_Double
     */
    public function getElapsedTime()
    {
        return new Basic_Datatype_Scalar_Double(Basic_Datatype_Microtime::now()->getValue() - $this->_startMicrotime->getValue());
    }

    /**
     * Gibt die Sekunden (Microsekunden genau) zurück, die seit der letzten Zeitabfrage
     * vergangen sind.
     *
     * @return Basic_Datatype_Scalar_Double
     */
    public function getElapsedScoreTime()
    {
        $microtimeNow = Basic_Datatype_Microtime::now();
        $result = new Basic_Datatype_Scalar_Double($microtimeNow->getValue() - $this->_lapStartMicrotime->getValue());
        // Score Time auffrischen
        $this->_lapStartMicrotime = $microtimeNow;
        return $result;
    }

    /**
     * Managed Echo
     *
     * @param Basic_Datatype_Scalar_String $value
     * @return void
     */
    public function managedEcho(Basic_Datatype_Scalar_String $value)
    {
        echo $value;
    }

    /**
     * Managed Debug
     *
     * Proxy für Zend_Debug::dump()
     *
     * @param Basic_Datatype_Object $object
     * @param Basic_Datatype_Scalar_String $label
     * @param Basic_Datatype_Scalar_Boolean $exit
     * @return void
     */
    public function managedDebug(Basic_Datatype_Object $object, Basic_Datatype_Scalar_String $label = null, Basic_Datatype_Scalar_Boolean $exit = null)
    {
        // Da man bei Klassen Typehints nun keine Standardwerte außer NULL mehr angeben kann
        // muss man auf diesen Workaround zurückgreifen. Man kann also programmatisch jetzt
        // die Standardobjekte erstellen, wenn das Argument null ist. Die Objekte müssen aber
        // auf jeden Fall vorhanden sein, weil sie zur Laufzeit ja ausgewertet werden.
        if ($exit === null) $exit = new Basic_Datatype_Scalar_Boolean(false);
        if ($label === null) $label = new Basic_Datatype_Scalar_String('');

        Basic_Debug::dump($object, $label->getValue());
        if ($exit->isTrue()) exit();
    }

    /**
     * Gibt einen Boolean als gemanagetes Objekt zurück
     *
     * @return Basic_Datatype_Scalar_Boolean
     */
    public function managedBoolean($value)
    {
        $this->_objectCount->add(new Basic_Datatype_Scalar_Integer(1));
        $object = new Basic_Datatype_Scalar_Boolean();
        $object->parse($value);
        $this->_objects['boolean'][] = $object;
        return $object;
    }

    /**
     * Gibt einen Double/Float als gemanagetes Objekt zurück
     *
     * @return Basic_Datatype_Scalar_Double
     */
    public function managedDouble($value)
    {
        $this->_objectCount->add(new Basic_Datatype_Scalar_Integer(1));
        $object = new Basic_Datatype_Scalar_Double();
        $object->parse($value);
        $this->_objects['double'][] = $object;
        return $object;
    }

    /**
     * Gibt einen Integer als gemanagetes Objekt zurück
     *
     * @return Basic_Datatype_Scalar_Integer
     */
    public function managedInteger($value)
    {
        $this->_objectCount->add(new Basic_Datatype_Scalar_Integer(1));
        $object = new Basic_Datatype_Scalar_Integer();
        $object->parse($value);
        $this->_objects['integer'][] = $object;
        return $object;
    }

    /**
     * Gibt NULL als gemanagetes Objekt zurück
     *
     * @return Basic_Datatype_Null
     */
    public function managedNull()
    {
        $this->_objectCount->add(new Basic_Datatype_Scalar_Integer(1));
        $object = new Basic_Datatype_Null();
        $this->_objects['other'][] = $object;
        return $object;
    }

    /**
     * Gibt einen String als gemanagetes Objekt zurück
     *
     * @return Basic_Datatype_Scalar_String
     */
    public function managedString($value)
    {
        $this->_objectCount->add(new Basic_Datatype_Scalar_Integer(1));
        $object = new Basic_Datatype_Scalar_String((string)$value);
        $this->_objects['string'][] = $object;
        return $object;
    }

    /**
     * Kopiert ein Objekt (Klonen)
     *
     * @return Basic_Datatype_Object
     */
    public function managedCopy(Basic_Datatype_Object $object)
    {
        $this->_objectCount->add(new Basic_Datatype_Scalar_Integer(1));
        $object = $object->copy();
        if ($object instanceof Basic_Datatype_Scalar_Boolean) {
            $key = 'boolean';
        } elseif ($object instanceof Basic_Datatype_Scalar_Double) {
            $key = 'double';
        } elseif ($object instanceof Basic_Datatype_Scalar_Integer) {
            $key = 'integer';
        } elseif ($object instanceof Basic_Datatype_Scalar_String) {
            $key = 'string';
        } else {
            $key = 'other';
        }
        $this->_objects[$key][] = $object;
        return $object;
    }

    /**
     * Gibt die aktuelle Basic Php Runtime aus
     * Enter description here ...
     */
    public function debugRuntimeTrace()
    {
        $this->managedDebug($this);
    }
}
