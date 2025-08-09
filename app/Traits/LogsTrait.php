<?php
namespace App\Traits;

use App\Models\LogsApp;

use App\Http\Controllers\SendErrorsController;


use Illuminate\Support\Facades\Route;

trait LogsTrait{
    protected function errorCatch($message, $user = ""){
        $this->createLog($message, 500, 'error', $user);
    }

    protected function getRouteAction(){

        $RouteAction = explode("App\Http\Controllers\\",Route::currentRouteAction());
        $explodeAction = explode("@",$RouteAction[1]);

        return $explodeAction;
    }

    protected function createLog($message, $http_code, $status, $user = ""){

        $explodeAction = $this->getRouteAction();
        $controller = $explodeAction[0];
        $operation = $explodeAction[1];

        $infoLog = [
            'content'   => $message,
            'user_id'   => $user ,
            'operation' => $operation,
            'controller'=> $controller,
            'http_code' => $http_code,
            'route'     => Route::currentRouteName(),
            'status'    => $status,
        ];
        $sendError = new SendErrorsController();
        // $sendError->ErrorsMail($infoLog);
        LogsApp::create($infoLog);
    }
}
