<?php
/**
 * Created by PhpStorm.
 * User: jhonnyquest
 * Date: 21/12/17
 * Time: 12:42 PM
 */
?>
@extends('layouts.main')

@section('content')
    <section id="hero">
        <div class="hero-container">
            <div class="wow fadeIn">
                <div class="hero-logo">
                    <img class="" src="img/logo.gif" alt="Imperial">
                </div>
                <h1>Welcome to Cube Summation page</h1>
                <h2>calculates the sum of the value of blocks whose x coordinate is between x1 and x2 (inclusive), y
                    coordinate between y1 and y2 (inclusive) and z coordinate between z1 and z2 (inclusive).</h2>
                <div class="actions">
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#test_cases_modal">Start cube summation</button>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="test_cases_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" novalidate>
                    <div class="modal-header text-center">
                        <h3 class="modal-title">Cube calc</h3>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="col-lg-5">
                                <label for="test_cases">Number of test-cases:</label>
                            </div>
                            <div class="col-lg-7">
                                <input type="number" class="form-control" id="test_cases" placeholder="e.g. 3">
                            </div>
                        </div>
                        <br><br>
                    </div>
                    <div class="modal-footer">
                        <div class="col-lg-6 text-center">
                            <button type="button" onclick="setTestCases()" class="btn btn-info btn-lg text-center">next</button>
                        </div>
                        <div class="col-lg-6 text-center">
                            <button type="button" onclick="deleteCube()" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="settings_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" novalidate>
                    <div class="modal-header text-center">
                        <h3 class="modal-title">Cube settings</h3>
                    </div>
                    <div class="modal-body">
                        <br><br>
                        <div class="form-group">
                            <div class="col-lg-5">
                                <label for="matrix_dimension">Matrix dimension:</label>
                            </div>
                            <div class="col-lg-7">
                                <input type="number" class="form-control" id="matrix_dimension" placeholder="e.g. 4 for 4x4x4 matrix">
                            </div>
                        </div>
                        <br><br>
                        <div class="form-group">
                            <div class="col-lg-5">
                                <label for="quantity_commands">Quantity of commands:</label>
                            </div>
                            <div class="col-lg-7">
                                <input type="number" class="form-control" id="quantity_commands" placeholder="e.g. 5">
                            </div>
                        </div>
                        <br><br>
                    </div>
                    <div class="modal-footer">
                        <div class="col-lg-6 text-center">
                            <button type="button" onclick="createCube()" class="btn btn-info btn-lg text-center">next</button>
                        </div>
                        <div class="col-lg-6 text-center">
                            <button type="button" onclick="deleteCube()" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="calc_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" novalidate>
                    <div class="modal-header text-center">
                        <h3 class="modal-title">Cube calc</h3>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="col-lg-4">
                                <label for="update">Update comand:</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="update" placeholder="e.g. 2 2 2 4">
                            </div>
                            <div class="col-lg-2 text-center">
                                <button type="button" onclick="updateCube()" class="btn btn-success btn-sm text-center">Update</button>
                            </div>
                        </div>
                        <br><br>
                        <div class="form-group">
                            <div class="col-lg-4">
                                <label for="query">Query comand:</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="query" placeholder="e.g. 2 2 2 4 4 4">
                            </div>
                            <div class="col-lg-2 text-center">
                                <button type="button" onclick="queryCube()" class="btn btn-success btn-sm text-center">Query</button>
                            </div>
                        </div>
                        <br><br>
                        <div class="form-group">
                            <div class="col-lg-4">
                                <label for="result">Result:</label>
                            </div>
                            <div class="col-lg-8">
                                <input readonly type="text" class="form-control" id="result" placeholder="">
                            </div>
                        </div>
                        <br><br>
                    </div>
                    <div class="modal-footer">
                        <div class="col-lg-12 text-center">
                            <button type="button" onclick="deleteCube()" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection
