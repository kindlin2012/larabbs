<?php

namespace App\Http\Controllers\API;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Requests\Api\MessageRequest;
use App\Http\Resources\MessageResource;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;


class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //返回所有私信

        return MessageResource::collection(Message::paginate());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MessageRequest $request, Message $message)
    {
        $message->fill($request->all());
        $message->sender_id = $request->user()->id;
        $message->save();

        return new MessageResource($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        // $message->load(['sender', 'receiver']);
        $message=QueryBuilder::for(Message::where('id',$message->id))
            ->allowedIncludes('sender', 'receiver')
            ->firstOrFail();

        return new MessageResource($message);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {

            $this->authorize('destroy', $message);
            $message->delete();
            return response(null, 204);
    }

    //返回当前用户接收到的私信列表
    public function received(Request $request)
    {
        // $messages = $request->user()->receivedMessages()->paginate();
        $query = $request->user()->receivedMessages()->getQuery();
        $messages = QueryBuilder::for($query)
            ->allowedIncludes('sender', 'receiver')
            ->allowedFilters([
                'title',
                // AllowedFilter::exact('category_id'),
                // AllowedFilter::scope('withOrder')->default('recentReplied'),
            ])
            ->paginate();
        return MessageResource::collection($messages);
    }

    //返回当前用户发送的私信列表
    public function sent(Request $request)
    {
        // $this->authorize('show', $request->user());
        $query = $request->user()->sendMessages()->getQuery();
        $messages = QueryBuilder::for($query)
            ->allowedIncludes('sender', 'receiver')
            ->allowedFilters([
                'title',
                // AllowedFilter::exact('category_id'),
                // AllowedFilter::scope('withOrder')->default('recentReplied'),
            ])
            ->paginate();
        // $messages = $request->user()->sendMessages()->paginate();

        return MessageResource::collection($messages);
    }

}
