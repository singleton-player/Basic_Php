<?php
/**
 * Index Controller
 *
 */
class IndexController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $php = new Basic_Php();

        for ($bb = 0; $bb < 4; $bb++) {

            $managedArray = array();
            for ($a = 0; $a < 10000; $a++) {
                $managedArray[] = $php->managedInteger($a);
            }

            $php->managedDebug($php->getElapsedScoreTime(), $php->managedString('Zeit MANAGED'));

            $unManagedArray = array();
            for ($a = 0; $a < 10000; $a++) {
                $unManagedArray[] = $a;
            }

            $php->managedDebug($php->getElapsedScoreTime(), $php->managedString('Zeit UNMANAGED'));
        }

        $boolean = $php->managedBoolean(true);
        $double = $php->managedDouble(39.233);
        $integer = $php->managedInteger(23);
        $string = $php->managedString('     1Ich teste ob die Lisa Müller aus Bayern isasdt      ');
        $null = $php->managedNull();

        $string2 = $php->managedCopy($string);

        $string2->trim();


        $php->debugRuntimeTrace();

//        Zend_Debug::dump(array(
//            $boolean,
//            $double,
//            $integer->toBoolean(),
//            $string,
//            $string2,
//            $null->toString()->isEmpty()->isTrue()
//        )); exit;

        exit;
    }
}
