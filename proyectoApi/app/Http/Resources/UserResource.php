<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    
    public static $map = [
        'id' => 'identifier',
        'name' => 'full_name',
        'password' => 'password',
        'email' => 'email_address',
        'updated_at' => 'last_modified',
        'created_at' => 'creation_date',
    ];
    
    public function generateLinks($request)
    {
        return [
            [
                'rel' => 'self',
                'href' => route('users.show', $this->id),
            ],
            [
                'rel' => 'user.libros',
                'href' => route('users.libros.index', $this->id),
            ],
        ];
    }
	
	public function toArray($request)
    {
		$transformedAttributes = parent::toArray($request);
		
		//inyecto el token, para jwt
        if (isset($request->email_address)) {
			$data_token = [
				"email" => $request->email_address,
			];
			$token = new Token($data_token);
			$token = $token->encode();
			$transformedAttributes['token'] = $token;
		}		
		return $transformedAttributes;

    }
}
