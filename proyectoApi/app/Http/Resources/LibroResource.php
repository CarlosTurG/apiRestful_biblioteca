<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LibroResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */


    /*public static $map = [
        'id' => 'identifier',
        'title' => 'title',
        'description' => 'details',
        'updated_at' => 'last_modified',
        'created_at' => 'creation_date',
    ];

    public function generateLinks($request)
    {
        return [
            [
                'rel' => 'self',
                'href' => route('products.show', $this->id),
            ],
            [
                'rel' => 'libro.users',
                'href' => route('libros.users.index', $this->id),
            ],
        ];
    }


    public function toArray($request)
    {
        return parent::toArray($request);
    }*/
}
