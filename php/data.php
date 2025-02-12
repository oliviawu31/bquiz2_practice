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

// dd($data);

echo json_encode($data);