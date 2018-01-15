<?php

function create($model,$attributes = [],$count =1){
    return factory($model,$count)->create($attributes);
}
