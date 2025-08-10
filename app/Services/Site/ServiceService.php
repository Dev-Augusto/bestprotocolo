<?php
namespace App\Services\Site;

use App\Repositories\Site\ClientRepository;
use App\Repositories\Site\ServiceAboutRepository;
use App\Repositories\Site\ServiceRepository;
use App\Services\AbstractService;

class ServiceService extends AbstractService
{
    protected $aboutRepository;
    protected $clientsRepository;

    public function __construct(ServiceRepository $repository, ServiceAboutRepository $aboutRepository,
        ClientRepository $clientsRepository)
    {
        $this->aboutRepository = $aboutRepository;
        $this->clientsRepository = $clientsRepository;
        parent::__construct($repository);
    }

    public function updateAll(array $data, int $id)
    {
        $service = $this->repository->update($data, $id);
        $service->load(['about','images','clients']);

        // Atualizar About (HasOne)
        if (!empty($data['about'])) {
            $service->about()->updateOrCreate([], $data['about']);
        }

        // Atualizar Clients (HasMany)
        if (!empty($data['clients'])) {
            foreach ($data['clients'] as $key => $clientData) {
                if (!empty($clientData['name'])) {
                    // Atualiza cliente existente
                    $service->clients()->Where('id',$key)->update($clientData);
                } else {
                    dd('create');
                    // Cria novo cliente
                    $service->clients()->create($clientData);
                }
            }
        }

        // Atualizar Imagens (HasMany)
        if (!empty($data['images'])) {
            foreach ($data['images'] as $key => $imgData) {
                // Remover imagem se marcado
                if (!empty($imgData['remove']) && !empty($key)) {
                    $image = $service->images()->find($key);
                    if ($image) 
                        $image->delete();
                    continue;
                }

                // Substituir imagem existente
                if (!empty($imgData['img'])) {
                    $service->images()->updateOrCreate(
                        ['id' => $key],
                        [
                            'img' => $imgData['img'],
                        ]
                    );
                }
            }
        }

    }
}