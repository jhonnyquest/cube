<?php
/**
 * Created by PhpStorm.
 * User: jhonnyquest
 * Date: 21/12/17
 * Time: 12:20 PM
 */


namespace App\Http\Controllers;

/**
 * Main controller.
 *
 * Here the basic operation from the landing page will be implemented.
 *
 */
class MainController
{
    /**
     * Main controller.
     *
     * Here the basic operation from the landing page will be implemented.
     *
     * @param string $myArgument With a *description* of this argument, these may also
     *    span multiple lines.
     *
     * @return void
     */
    public function index()
    {
        return view('home.index');
    }

}