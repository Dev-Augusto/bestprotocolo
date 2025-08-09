<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController;
use App\Services\HomeService;
use App\Services\Site\AboutService;
use App\Services\Site\ClientService;
use App\Services\Site\PartnerService;
use App\Services\Site\ServiceService;
use App\Services\Site\SliderService;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class HomeController extends AbstractController
{
    protected $serviceService;
    protected $sliderService;
    protected $aboutService;
    protected $clientsService;
    protected $partnerService;

    public function __construct(HomeService $service, ServiceService $serviceService,
        SliderService $sliderService, AboutService $aboutService, ClientService $clientsService,
        PartnerService $partnerService)
    {
        $this->service = $service;
        $this->sliderService = $sliderService;
        $this->serviceService = $serviceService;
        $this->aboutService = $aboutService;
        $this->clientsService = $clientsService;
        $this->partnerService = $partnerService;
    }

    public function index()
    {
        try {
            $slider = $this->sliderService->findOneBy([]);
            $services = $this->serviceService->findAllBy([])->take(3);
            $about = $this->aboutService->findOneBy([]);
            $clients = $this->clientsService->findAllBy([])->take(3);
            return view('pages.home', compact('slider','services','about','clients'));
        } catch (\Throwable $e) {
            Log::channel('errors')->error('Erro capturado: ' . $e->getMessage(), [
                'file' => $e->getFile() . "\n",
                'line' => $e->getLine() . "\n",
                'trace' => $e->getTraceAsString() . "\n",
            ]);
            return redirect()->back()->withErrors('Tente Novamente se o erro persistir entre em contacto com o apoio técnico');
        }
    }

    public function service($slug)
    {
        try {
            $service = $this->serviceService->findOneByWithRelationships(['slug'=>$slug],['about','images','clients']);
            return view('pages.service', compact('service'));
        } catch (\Throwable $e) {
            Log::channel('errors')->error('Erro capturado: ' . $e->getMessage(), [
                'file' => $e->getFile() . "\n",
                'line' => $e->getLine() . "\n",
                'trace' => $e->getTraceAsString() . "\n",
            ]);
            return redirect()->back()->withErrors('Tente Novamente se o erro persistir entre em contacto com o apoio técnico');
        }
    }

    
    public function partners()
    {
        try {
            $partners = $this->partnerService->findAllBy([]);
            return view('pages.partners', compact('partners'));
        } catch (\Throwable $e) {
            Log::channel('errors')->error('Erro capturado: ' . $e->getMessage(), [
                'file' => $e->getFile() . "\n",
                'line' => $e->getLine() . "\n",
                'trace' => $e->getTraceAsString() . "\n",
            ]);
            return redirect()->back()->withErrors('Tente Novamente se o erro persistir entre em contacto com o apoio técnico');
        }
    }

    public function about()
    {
        try {
            $about = $this->aboutService->findOneBy([]);
            return view('pages.about', compact('about'));
        } catch (\Throwable $e) {
            Log::channel('errors')->error('Erro capturado: ' . $e->getMessage(), [
                'file' => $e->getFile() . "\n",
                'line' => $e->getLine() . "\n",
                'trace' => $e->getTraceAsString() . "\n",
            ]);
            return redirect()->back()->withErrors('Tente Novamente se o erro persistir entre em contacto com o apoio técnico');
        }
    }
}