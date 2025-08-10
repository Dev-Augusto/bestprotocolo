<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\AbstractController;
use App\Services\Message\MessageService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MessageController extends AbstractController
{
    public function __construct(MessageService $service)
    {
        $this->service = $service;
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->service->store($request->all());
            DB::commit();
            return redirect()->back()->with('success','Mensagem enviada!');
        } catch (\Throwable $e) {
            DB::rollBack();
             Log::channel('errors')->error('Erro capturado: ' . $e->getMessage(), [
                'file' => $e->getFile() . "\n",
                'line' => $e->getLine() . "\n",
                'trace' => $e->getTraceAsString() . "\n",
            ]);
            return redirect()->back();
        }
    }


    public function destroy(int $id)
    {
        try {
            DB::beginTransaction();
            $this->service->destroy($id);
            DB::commit();
            return redirect()->back()->with('success','Mensagem eliminada!');
        } catch (\Throwable $e) {
            DB::rollBack();
             Log::channel('errors')->error('Erro capturado: ' . $e->getMessage(), [
                'file' => $e->getFile() . "\n",
                'line' => $e->getLine() . "\n",
                'trace' => $e->getTraceAsString() . "\n",
            ]);
            return redirect()->back();
        }
    }
}