<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AbstractController;
use App\Http\Requests\SliderRequest;
use App\Http\Requests\UpdatePartnerRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Services\Admin\AdminService;
use App\Services\Message\MessageService;
use App\Services\Site\AboutService;
use App\Services\Site\ClientService;
use App\Services\Site\PartnerService;
use App\Services\Site\ServiceService;
use App\Services\Site\SliderService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminController extends AbstractController
{
    protected $serviceService;
    protected $sliderService;
    protected $aboutService;
    protected $clientsService;
    protected $partnerService;
    protected $messageService;

    public function __construct(AdminService $service, ServiceService $serviceService,
        SliderService $sliderService, AboutService $aboutService, ClientService $clientsService,
        PartnerService $partnerService, MessageService $messageService)
    {
        $this->service = $service;
        $this->sliderService = $sliderService;
        $this->serviceService = $serviceService;
        $this->aboutService = $aboutService;
        $this->clientsService = $clientsService;
        $this->partnerService = $partnerService;
        $this->messageService = $messageService;
    }

    public function index()
    {
         try {
            $messages = $this->messageService->findAllBy([]);
            return view('admin.home', compact('messages'));
        } catch (\Throwable $e) {
            Log::channel('errors')->error('Erro capturado: ' . $e->getMessage(), [
                'file' => $e->getFile() . "\n",
                'line' => $e->getLine() . "\n",
                'trace' => $e->getTraceAsString() . "\n",
            ]);
            return redirect()->back()->withErrors('Tente Novamente se o erro persistir entre em contacto com o apoio técnico');
        }
    }

    public function home()
    {
        try {
            $slider = $this->sliderService->findOneBy([]);
            return view('admin.pages.index', compact('slider'));
        } catch (\Throwable $e) {
            Log::channel('errors')->error('Erro capturado: ' . $e->getMessage(), [
                'file' => $e->getFile() . "\n",
                'line' => $e->getLine() . "\n",
                'trace' => $e->getTraceAsString() . "\n",
            ]);
            return redirect()->back()->withErrors('Tente Novamente se o erro persistir entre em contacto com o apoio técnico');
        }
    }

    public function updateHome(SliderRequest $request, $id)
    {
        try {
            $data = $this->handleFileUpload($request);
            DB::beginTransaction();
            $this->sliderService->update($data, $id);
            DB::commit();
            return redirect()->back()->with('success','Registro actualizado com succeso!');
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

    public function services()
    {
        try {
             $services = $this->serviceService->findAllBy([]);
            return view('admin.pages.services.index', compact('services'));
        } catch (\Throwable $e) {
            Log::channel('errors')->error('Erro capturado: ' . $e->getMessage(), [
                'file' => $e->getFile() . "\n",
                'line' => $e->getLine() . "\n",
                'trace' => $e->getTraceAsString() . "\n",
            ]);
            return redirect()->back()->withErrors('Tente Novamente se o erro persistir entre em contacto com o apoio técnico');
        }
    }

    public function showService(string $slug)
    {
        try {
            $service = $this->serviceService->findOneByWithRelationships(['slug'=>$slug],['about','images','clients']);
            return view('admin.pages.services.show', compact('service'));
        } catch (\Throwable $e) {
            Log::channel('errors')->error('Erro capturado: ' . $e->getMessage(), [
                'file' => $e->getFile() . "\n",
                'line' => $e->getLine() . "\n",
                'trace' => $e->getTraceAsString() . "\n",
            ]);
            return redirect()->back()->withErrors('Tente Novamente se o erro persistir entre em contacto com o apoio técnico');
        }
    }

    public function updateService(UpdateServiceRequest $request, $id)
    {
        try {
            $service = $this->serviceService->findOneBy(['id'=>$id]);
            $data = $this->handleFileUpload($request, 'img/services/'.$service->slug);
            DB::beginTransaction();
            $this->serviceService->updateAll($data, $id);
            DB::commit();
            return redirect()->back()->with('success','Registro actualizado com succeso!');
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

    public function partners()
    {
        try {
            $partners = $this->partnerService->findAllBy([]);
            return view('admin.pages.partners.index', compact('partners'));
        } catch (\Throwable $e) {
            Log::channel('errors')->error('Erro capturado: ' . $e->getMessage(), [
                'file' => $e->getFile() . "\n",
                'line' => $e->getLine() . "\n",
                'trace' => $e->getTraceAsString() . "\n",
            ]);
            return redirect()->back()->withErrors('Tente Novamente se o erro persistir entre em contacto com o apoio técnico');
        }
    }

    public function updatePartners(UpdatePartnerRequest $request)
    {
        //try {
            $data = $this->handleFileUpload($request, 'img/partners/');
            DB::beginTransaction();
            $this->partnerService->updateAll($data);
            DB::commit();
            return redirect()->back()->with('success','Registro actualizado com succeso!');
        /*} catch (\Throwable $e) {
            DB::rollBack();
             Log::channel('errors')->error('Erro capturado: ' . $e->getMessage(), [
                'file' => $e->getFile() . "\n",
                'line' => $e->getLine() . "\n",
                'trace' => $e->getTraceAsString() . "\n",
            ]);
            return redirect()->back();
        }*/
    }
}