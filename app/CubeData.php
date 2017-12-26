<?php
/**
 * Created by PhpStorm.
 * User: jhonnyquest
 * Date: 22/12/17
 * Time: 09:26 AM
 */

namespace App;


class CubeData
{

    /**
     * Create test cases rules
     */
    public static $createTestCasesRules = array(
        'test_cases' => 'required|numeric|min:1|max:50'
    );

    /**
     * Create cube rules
     */
    public static $createCubeRules = array(
        'matrix_dimension' => 'required|numeric|min:1|max:100',
        'quantity_commands' => 'required|numeric|min:1|max:1000'
    );

    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public function returnValue($key)
    {
        $value = null;
        if (isset($_SESSION[$key])) {
            $value = $_SESSION[$key];
        }
        return $value;
    }

    public function setKeyValue($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function setCubeValue($x, $y, $z, $value){
        $_SESSION['cube'][$x][$y][$z] = $value;
    }

    public function getQuery($x1, $y1, $z1, $x2, $y2, $z2){
        $sum = 0;
        for ($i = $x1; $i <= $x2; $i++) {
            for ($j = $y1; $j <= $y2; $j++) {
                for ($k = $z1; $k <= $z2; $k++) {
                    $sum = $sum + $_SESSION['cube'][$i][$j][$k];
                }
            }
        }
        return $sum;
    }

    public function setCube($newCube, $actions){

        $_SESSION['cube'] = $newCube;
        $_SESSION['initial_actions'] = $actions;
    }

    public function deleteSession(){
        session_destroy();
    }

    /**
     * Create test case validation
     */
    public function validate($input, $type)
    {
        $dimension = (isset($_SESSION['dimension'])?$_SESSION['dimension']:0);
        $rules = array(
            'create_test_cases' => static::$createTestCasesRules,
            'create_cube' => static::$createCubeRules,
            'update_cube' => [
                'x' => 'required|numeric|min:1|max:'.$dimension,
                'y' => 'required|numeric|min:1|max:'.$dimension,
                'z' => 'required|numeric|min:1|max:'.$dimension,
                'value' => 'required|numeric|min:-1000000000|max:1000000000'
            ],
            'query_cube' => [
                'x1' => 'required|numeric|min:1|max:'.(isset($input['x2'])?$input['x2']:0),
                'y1' => 'required|numeric|min:1|max:'.(isset($input['y2'])?$input['y2']:0),
                'z1' => 'required|numeric|min:1|max:'.(isset($input['z2'])?$input['z2']:0),
                'x2' => 'required|numeric|min:'.(isset($input['x1'])?$input['x1']:0).'|max:'.$dimension,
                'y2' => 'required|numeric|min:'.(isset($input['y1'])?$input['y1']:0).'|max:'.$dimension,
                'z2' => 'required|numeric|min:'.(isset($input['z1'])?$input['z1']:0).'|max:'.$dimension,
            ],
        );

        $result = \Validator::make($input, $rules[$type]);
        if ($result->passes()) {
            return true;
        }
        $this->setErrors($result->messages());
        return false;
    }

    /**
     * Set error message bag
     *
     * @var Illuminate\Support\MessageBag
     */
    protected function setErrors($errors)
    {
        $this->errors = $errors;
    }

    /**
     * Retrieve error message bag
     */
    public function getErrors()
    {
        //dd(implode(' ',$this->errors->all()));
        return $this->errors;
    }

    /**
     * Inverse of wasSaved
     */
    public function hasErrors()
    {
        return !empty($this->errors);
    }
}