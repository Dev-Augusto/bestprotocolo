<?php
namespace App\Services\Site;

use App\Repositories\Site\PartnerRepository;
use App\Services\AbstractService;

class PartnerService extends AbstractService
{
    public function __construct(PartnerRepository $repository)
    {
        parent::__construct($repository);
    }

    public function updateAll(array $data)
    {
        // Atualizar Partners (HasMany)
        if (!empty($data['partner'])) {
            foreach ($data['partner'] as $key => $partner) {
                $item = $this->repository->findOneBy(['id'=>$key]);
                // Remover partners se marcado
                if (!empty($partner['remove']) && !empty($key)) {
                    $item = $this->repository->findOneBy(['id'=>$key]);
                    if ($item) 
                        $item->delete();
                    continue;
                }
                // Substituir partners existente
                if (isset($partner['name']) && isset($partner['profission'])) {
                    $partne = $this->repository->updateOrCreate(
                        ['id' => $key],
                        [
                            'name' => $partner['name'],
                            'profission' => $partner['profission'],
                            'image' => $partner['image'] ?? $item->image,
                        ]
                    );
                }
            }
        }
    }
}