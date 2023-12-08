<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index()
	{
		$messages = Message::paginate();
		return view('messages.index', compact('messages'));
	}

    public function show(Message $message)
    {
        return view('messages.show', compact('message'));
    }

    // public function create(Message $message,  Request $request ,$receiver_id = null)
    public function create(Message $message,  Request $request)
    {
        $receiver_id = $request->query('receiver_id');
        //输出请求参数
        //  dd($receiver_id);

        //权限验证
        $this->authorize('create', $message);

        // 将登录用户的 ID 赋值给 $message->sender_id
        $message->sender_id = \Auth::id();

        if ($receiver_id) {
            $message->receiver_id = $receiver_id;
        }
        //dd($message);
        return view('messages.create_and_edit', compact('message'));
    }

	public function store(MessageRequest $request)
	{
		$message = Message::create($request->all());
		return redirect()->route('messages.show', $message->id)->with('message', 'Created successfully.');
	}

	public function edit(Message $message)
	{
        $this->authorize('update', $message);
		return view('messages.create_and_edit', compact('message'));
	}

	public function update(MessageRequest $request, Message $message)
	{
		$this->authorize('update', $message);
		$message->update($request->all());

		return redirect()->route('messages.show', $message->id)->with('message', 'Updated successfully.');
	}

	public function destroy(Message $message)
	{
		$this->authorize('destroy', $message);
		$message->delete();

		return redirect()->route('messages.index')->with('message', 'Deleted successfully.');
	}

    // 发送的消息
    public function sent(Request $request)
    {
        // dd($request->user()->sentMessages()->get());
        $messages = $request->user()->sendMessages()->paginate(10);

        return view('messages.sent', compact('messages'));
    }

    // 收到的消息
    public function received(Request $request)
    {
        // dd($request->user()->receivedMessages()->get());
        $messages = $request->user()->receivedMessages()->paginate(10);

        return view('messages.received', compact('messages'));
    }
}
