<?php

namespace App;

use App\Controller\ArchiveFilesController;
use App\Core\Response;
use App\Core\ResponseCodesEnum;

class Application
{
    public function run()
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json; charset=UTF-8');
        header('Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE');
        header('Access-Control-Max-Age: 3600');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
        try {
            $controller = new ArchiveFilesController();

            $response = $controller->getArchiveFiles();

            header(
                sprintf(
                    'HTTP/1.1 %s %s',
                    $response->getCode(),
                    ResponseCodesEnum::getCodeDescription($response->getCode())
                )
            );
            http_response_code($response->getCode());
            header('Content-Type: ' . $response->getCode() );
            print($response->getData());
        } catch (\Exception $exception) {
            header(
                sprintf(
                    'HTTP/1.1 %s %s',
                    Response::RESPONSE_ERROR,
                    ResponseCodesEnum::getCodeDescription(Response::RESPONSE_ERROR)
                )
            );
            http_response_code(Response::RESPONSE_ERROR);
            print(
                json_encode([
                    'message' => $exception->getMessage(),
                    'file' => $exception->getFile(),
                    'line' => $exception->getLine(),
                    'trace' => $exception->getTraceAsString()
                ])
            );
        }
    }
}