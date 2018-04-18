<?php

namespace App\Http\Resources;

use App\Models\Especialidade;
use App\Models\Profissao;
use Illuminate\Http\Resources\Json\JsonResource;

class EspecialidadeProfissoesResource extends JsonResource
{

    public function __construct(Especialidade $especialidade, Profissao $profissao)
    {
        // parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'pedro' => 'Diferente não, estraaaanho',
            'category' => $this->category
        ];
    }
}
