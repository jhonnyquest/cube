<?php
/**
 * Created by PhpStorm.
 * User: jhonnyquest
 * Date: 21/12/17
 * Time: 01:18 PM
 */

namespace App\Http\Controllers;

use App\CubeData;
use Illuminate\Http\Request;

/**
 * Cube controller.
 *
 * All operations related with processment of the cube operation commands.
 *
 */
class CubeController
{
    /**
     * index function.
     *
     * Dispatch main home page.
     *
     *
     * @return view home.index, variable active
     */
    public function index()
    {
        return view('home.index', ['active' => false]);
    }

    /**
     * get current cube.
     *
     * get current user's processing cube
     *
     * @return json success, error, cube
     */
    public function getCurrent()
    {
        $cube = new CubeData();
        return response()->json(['success' => true, 'error' => false, 'cube' => $cube->returnValue('cube')]);
    }

    /**
     * set test cases.
     *
     * setup of the test cases
     *
     * @return json success, error
     */
    public function setTestCases(Request $request)
    {
        $cube = new CubeData();
        $input = $request->all();
        $cube->setKeyValue('test_cases', $input['test_cases']);
        return response()->json(['success' => true, 'error' => false]);
    }

    /**
     * create function.
     *
     * Create a new cube to make operation with it.
     *
     * @param request $request Object that contains all attributes an operations related with
     *    the new cube creation.
     *
     * @return json response
     */
    public function create(Request $request)
    {
        $cube = new CubeData();
        $input = $request->all();
        for ($i = 0; $i < $input['matrix_dimension']; $i++) {
            for ($j = 0; $j < $input['matrix_dimension']; $j++) {
                for ($k = 0; $k < $input['matrix_dimension']; $k++) {
                    $newCube[$i][$j][$k] = 0;
                }
            }
        }
        $cube->setCube($newCube, $input['quantity_commands']);
        $cube->setKeyValue('actions', $input['quantity_commands']);
        return response()->json(['success' => true, 'error' => false], 201);
    }

    /**
     * update function.
     *
     * Update operation as part of the commands accepted by cube.
     *
     * @param request $request Object that contains all attributes an operations related with
     *    the cube update command.
     *
     * @return json response
     */
    public function update(Request $request)
    {
        $cube = new CubeData();
        $this->checkDisponibility($cube);
        $currCube = $cube->returnValue('cube');
        if (!$currCube) {
            return response()->json(['success' => false, 'error' => 'Cube not set'], 500);
        }
        $dimension = count($currCube);
        $input = $request->all();
        if ($input['x'] > $dimension || $input['y'] > $dimension || $input['z'] > $dimension) {
            return response()->json(['error' => 'Values out of range'], 400);
        }
        $cube->setCubeValue($input['x'] - 1, $input['y'] - 1, $input['z'] - 1, $input['value']);
        $cube->setKeyValue('actions', $cube->returnValue('actions') - 1);
        return response()->json(['success' => true]);
    }

    /**
     * update function.
     *
     * Update operation as part of the commands accepted by cube.
     *
     * @param request $request Object that contains all attributes an operations related with
     *    the cube query command.
     *
     * @return json response
     */
    public function query(Request $request){
        $cube = new CubeData();
        $resp = $this->checkDisponibility($cube);
        if(!$resp['success'])
            return response()->json(['success' => false, 'error' => $resp['error']]);
        $currCube = $cube->returnValue('cube');
        if(!$currCube){
            return response()->json(['success' => false, 'error' => 'Cube not set'], 500);
        }
        $values = $request->all();
        if($values['x2']-1 < $values['x1']-1 || $values['y2']-1 < $values['y1']-1 || $values['z2']-1 < $values['z1']-1){
            return response()->json(['error' => 'Values out of range'], 400);
        }
        $cube->setKeyValue('actions', $cube->returnValue('actions') - 1);
        return response()->json(['success' => true, 'result' => $cube->getQuery($values['x1']-1, $values['y1']-1, $values['z1']-1, $values['x2']-1, $values['y2']-1, $values['z2']-1)]);
    }

    /**
     * delete cube.
     *
     * delete current user's cube.
     *
     *
     * @return view home.index, variable active
     */
    public function delete()
    {
        $cube = new CubeData();
        $cube->deleteSession();
        return response()->json(['success' => true, 'error' => false]);
    }

    /**
     * check disponibility.
     *
     * check disponibility of actions for a given cube.
     *
     *
     * @return array success, error
     */
    private function checkDisponibility($cube)
    {
        if($cube->returnValue('actions') <= 0){
            if ($cube->returnValue('test_cases') == 1){
                $cube->deleteSession();
                return ['success' => false, 'error' => 'No more test cases'];
            }else{
                $cube->setKeyValue('test_cases', $cube->returnValue('test_cases') - 1);
                $cube->setKeyValue('actions', $cube->returnValue('initial_actions'));
                return ['success' => false, 'error' => 'actions restored'];
            }
        }else{
            return ['success' => true];
        }
    }
}