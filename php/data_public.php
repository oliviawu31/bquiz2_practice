<?php
function dd($data)
{
    echo"<pre>";
    print_r($data);
    echo"</pre>";
}

$data = [

    's1'=> 'aaa',
    's2'=> 'bbb',
    's3'=> 'ccc'

];
header('Access-Control-Allow-Origin: http://127.0.0.1:5502');

// dd($data);

echo json_encode($data);