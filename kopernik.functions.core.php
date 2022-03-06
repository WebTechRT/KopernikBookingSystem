<?php

defined( 'ABSPATH' ) || exit;

function kopernik_constant_definer($name, $varsion){
    if(!defined($name)) {
        defined($name, $varsion);
    }
}