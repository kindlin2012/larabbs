<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
          'id' => $this->id,
          //sender_id,receiver_id,content
          'sender_id' => $this->sender_id,
          'receiver_id' => $this->receiver_id,
          'content' => $this->content,




          'has_read' => $this->has_read,
          'created_at' => $this->created_at->toDateTimeString(),
          'updated_at' => $this->updated_at->toDateTimeString(),
          //预加载user
            'sender' => new UserResource($this->whenLoaded('sender')),
            'receiver' => new UserResource($this->whenLoaded('receiver')),
        ];
    }
}
