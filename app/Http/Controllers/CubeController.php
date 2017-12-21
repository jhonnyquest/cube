<?php
/**
 * Created by PhpStorm.
 * User: jhonnyquest
 * Date: 21/12/17
 * Time: 01:18 PM
 */

namespace App\Http\Controllers;

/**
 * Cube controller.
 *
 * All operations related with processment of the cube operation commands.
 *
 */
class CubeController
{
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
        return response()->json(['success' => true]);

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

        return response()->json(['success' => true]);

    }
}