<?php
if(isset($_POST['action'])){
    switch($_POST['action']) {
        case 'filterButton':
            filterAscStatus();
            break;
        case 'filterDescButton':
            filterDescStatus();
            break;
    }
}