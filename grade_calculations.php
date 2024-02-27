<?php

function subjectPoints($grade)
{
    $grade = strtolower($grade);
    $cluster = 0;
    switch ($grade) {
        case "e":
            $cluster = 1;
            break;
        case "d-":
            $cluster = 2;
            break;
        case "d":
            $cluster = 3;
            break;
        case "d+":
            $cluster = 4;
            break;
        case "c-":
            $cluster = 5;
            break;
        case "c":
            $cluster = 6;
            break;
        case "c+":
            $cluster = 7;
            break;
        case "b-":
            $cluster = 8;
            break;
        case "b":
            $cluster = 9;
            break;
        case "b+":
            $cluster = 10;
            break;
        case "a-":
            $cluster = 11;
            break;
        case "a":
            $cluster = 12;
            break;
    }
    return $cluster;
}