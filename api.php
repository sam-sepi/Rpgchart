<?php

require('vendor/autoload.php');

$data = [];

if(strtolower($_SERVER['REQUEST_METHOD']) == 'post')
{
    if($qstring = strtolower($_SERVER['QUERY_STRING']))
    {
        $api = new Rpgchart\Api($qstring);

        if($api->error === FALSE)
        {
            $input = json_decode(file_get_contents('php://input'));

            $data = $api->getData($input->fvar, $input->svar);

            if(isset($data['error']))
            {
                echo json_encode($data, JSON_PRETTY_PRINT);

                header("HTTP/1.1 " . $data['http_error']);
                exit();
            }

            echo json_encode($data, JSON_PRETTY_PRINT);
        }
        else
        {
            $data['error'] = 'RPGs request error';
            $data['http_error'] = '400 Bad Request';
            echo json_encode($data, JSON_PRETTY_PRINT);

            header("HTTP/1.1 " . $data['http_error']);
            exit();
        }
    }
    else
    {
        $data['error'] = 'RPGs request empty';
        $data['http_error'] = '400 Bad Request';
        echo json_encode($data, JSON_PRETTY_PRINT);

        header("HTTP/1.1 " . $data['http_error']);
        exit();
    }
}
else
{
    $data['error'] = 'Method not allowed';
    $data['http_error'] = '405 Method Not Allowed';
    echo json_encode($data, JSON_PRETTY_PRINT);

    header("HTTP/1.1 " . $data['http_error']);
    exit();
}