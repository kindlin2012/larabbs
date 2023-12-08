<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Message;

class MessagePolicy extends Policy
{
    public function update(User $user, Message $message)
    {
        // return $message->user_id == $user->id;
        return true;
    }

    public function destroy(User $user, Message $message)
    {
        //如果私信时间不超过5分钟且sender_id是当前用户，可以删除
        if ($message->created_at->diffInMinutes() < 5 && $message->sender_id == $user->id) {
            return true;
        }

    }

    public function create(User $user, Message $message)
    {
        //用户是否已登录
        if ($user->id) {
            return true;
        }

    }

    //私信发送者和接收者才能查看私信内容
    public function show(User $user, Message $message)
    {
        if ($user->id == $message->sender_id || $user->id == $message->receiver_id) {
            return true;
        }
    }
}
