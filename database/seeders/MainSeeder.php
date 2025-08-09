<?php

namespace Database\Seeders;

use App\Models\Site\About;
use App\Models\Site\Client;
use App\Models\Site\ImagesService;
use App\Models\Site\Partner;
use App\Models\Site\Service;
use App\Models\Site\ServiceAbout;
use App\Models\Site\Slider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class MainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::beginTransaction();
            $namesService = ['Garçons Profissionais', 'Serviço de Protocolo','Segurança para Eventos'];
            $icons = ['fa-wine-glass-alt', 'fa-user-tie','fa-shield-alt'];
            $descriptionsService= ['Equipe treinada e uniformizada para atender com excelência seus convidados.', 'Cerimonial completo para eventos formais e corporativos com o máximo de elegância.','Profissionais capacitados para garantir a segurança e tranquilidade do seu evento.'];
            $mainImage = ['img.jpg','img2.jpg','img2.jpg'];
            $imgService = ['img-1.jpg','img-r.jpg','img-s.jpg'];
            for($i = 0; $i <= 2; $i++)
            {
                $service = Service::create([
                    'name' => $namesService[$i],
                    'description' => $descriptionsService[$i],
                    'image' => $mainImage[$i],
                    'slug' => Str::slug($namesService[$i]),
                    'icon' => $icons[$i],
                ]);

                for($j = 0; $j <= 2; $j++){
                    ImagesService::create([
                        'id_service' => $service->id,
                        'img'=>$imgService[$j],
                    ]);
                }
            }

            $titlesSer = ['Serviço de Garçom de Alto Nível', 'Protocolo de Excelência','Segurança Profissional'];
            $descriptionsSer = [
                '<p>Nossa equipe de garçons é composta por profissionais treinados e experientes, capazes de proporcionar um atendimento impecável em qualquer tipo de evento, desde casamentos e festas corporativas até coquetéis sofisticados.</p>
                <p>Priorizamos a discrição, eficiência e elegância, garantindo que seus convidados tenham uma experiência memorável.</p>',
                '<p>Nossa equipe de protocolo é especializada em cerimoniais formais, garantindo que todos os detalhes do seu evento sejam executados com perfeição e no timing correto.</p>
                <p>Desde recepção de autoridades até organização de mesas de honra, oferecemos um serviço completo que valoriza a importância do seu evento.</p>',
                '<p>Nossa equipe de segurança é composta por profissionais treinados e credenciados, preparados para atuar em diversos tipos de eventos, garantindo a proteção de todos os participantes.</p>
                <p>Atuamos de forma discreta e eficiente, prevenindo situações indesejadas e garantindo que seu evento transcorra com total tranquilidade.</p>'
            ];
            $listsSer = [
                json_encode([
                    'Uniformes impecáveis e adequados ao evento',
                    'Treinamento em etiqueta e protocolo',
                    'Conhecimento em harmonização de bebidas',
                    'Atendimento personalizado'
                ]),
                json_encode([
                    'Cerimonial completo para eventos oficiais',
                    'Recepção e acomodação de autoridades',
                    'Organização de mesas de honra',
                    'Sequência cerimonial personalizada'
                ]),
                json_encode([
                    'Equipe credenciada e uniformizada',
                    'Controle de acesso eficiente',
                    'Monitoramento constante',
                    'Plano de emergência personalizado'
                ])

            ];
            for($i = 0; $i <= 2; $i++)
            {
                ServiceAbout::create([
                    'id_service'=>($i+1),
                    'title'=>$titlesSer[$i],
                    'description' => $descriptionsSer[$i],
                    'list' => $listsSer[$i]
                ]);
            }

            Slider::create([
                'title' => 'Excelência em Serviços para Eventos',
                'description' => 'Profissionalismo, elegância e segurança para tornar seu evento inesquecível.',
                'name_btn' => 'Fale Conosco',
                'url_btn'=>'https://api.whatsapp.com/send/?phone=5511999999999&text&type=phone_number&app_absent=0',
                'img'=>'hero-bg.jpg'
            ]);

            About::create([
                'home_title' => 'Transformando Eventos em Experiências Memoráveis',
                'home_list' => json_encode([
                    'Equipe altamente treinada',
                    'Uniformes impecáveis',
                    'Atendimento discreto e eficiente',
                    'Soluções personalizadas'
                ]),
                'home_description' => 'Com anos de experiência no mercado, nossa equipe se destaca pelo profissionalismo, atenção aos detalhes e compromisso com a excelência.',
                'description' => '
                    <p>Fundada em 2010, a Eventos Excellence surgiu da paixão por criar experiências memoráveis. Começamos como uma pequena equipe de garçons e hoje somos referência em serviços completos para eventos em todo o país.</p>
                    <p>Nosso crescimento foi orgânico, sempre pautado pela qualidade do atendimento e pela satisfação dos nossos clientes. A cada evento, buscamos superar expectativas e estabelecer novos padrões de excelência.</p>
                ',
                'list' => json_encode([
                    '2010 - Fundação com equipe de 8 garçons',
                    '2014 - Expansão para serviços de protocolo',
                    '2017 - Criação do departamento de segurança',
                    '2020 - Atuação em 5 estados brasileiros',
                ]),
                'img' =>'logo.png',
            ]);

            $names = ['Mariana e Rodrigo','Carlos Eduardo','Ana Paula'];
            $descriptions = [
                'A equipe de garçons foi perfeita no nosso casamento. Atendimento discreto e eficiente, todos os convidados elogiaram.',
                'Contratamos para nosso evento corporativo e superou todas as expectativas. Profissionais extremamente capacitados.',
                'Já contratamos várias vezes e sempre o mesmo padrão de excelência. Recomendo sem dúvidas!'
            ];
            $stars = [5,4,5];
            $types = ['Casamento','Evento Corporativo','Aniversário de 50 anos'];
            for($i = 0; $i <= 2; $i++)
            {
                Client::create([
                    'name' => $names[$i],
                    'description' => $descriptions[$i],
                    'stars' => $stars[$i],
                    'type' => $types[$i],
                    'id_service' => 1
                ]);
            }

            for($i = 0; $i <= 2; $i++)
            {
                Client::create([
                    'name' => $names[$i],
                    'description' => $descriptions[$i],
                    'stars' => $stars[$i],
                    'type' => $types[$i],
                    'id_service' => 2
                ]);
            }

            for($i = 0; $i <= 2; $i++)
            {
                Client::create([
                    'name' => $names[$i],
                    'description' => $descriptions[$i],
                    'stars' => $stars[$i],
                    'type' => $types[$i],
                    'id_service' => 3
                ]);
            }
            
            $partnerName = ['Buffet Sabor & Arte','Sonorizart','Florescer Decor','Élite Transportes','Cenário Perfeito','Click Fotografia','Vídeo Master','Vídeo Master'];
            $partnerProssion = ['Gastronomia de alto padrão','Soluções em áudio e iluminação','Decoração floral premium','Transporte executivo','Estruturas e cenografia','Registro profissional','Filmagem e edição','Confeitaria artística'];
            for($i = 0; $i <= 7; $i++){
                Partner::create([
                    'name' => $partnerName[$i],
                    'profission' => $partnerProssion[$i],
                    'image'=>'logo.png'
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }
}
