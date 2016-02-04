<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author christopher.matecki
 */
interface IModule {

    public function init();

    public function render($action);
}
