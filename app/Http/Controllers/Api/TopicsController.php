<?php

namespace App\Http\Controllers\Api;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Resources\TopicResource;
use App\Http\Requests\Api\TopicRequest;
// use Spatie\QueryBuilder\QueryBuilder;
// use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Queries\TopicQuery;
use App\Models\User;

class TopicsController extends Controller
{
    public function store(TopicRequest $request, Topic $topic)
    {
        // return 111;
        $topic->fill($request->all());
        $topic->user_id = $request->user()->id;
        $topic->save();

        return new TopicResource($topic);
    }

    // public function index(Request $request, Topic $topic)
    // {
    //     // $query = $topic->query();

    //     // if ($categoryId = $request->category_id) {
    //     //     $query->where('category_id', $categoryId);
    //     // }

    //     // // $topics = $query->withOrder($request->order)->paginate();
    //     // $topics = $query
    //     //     ->with('user', 'category')
    //     //     ->withOrder($request->order)
    //     //     ->paginate();

    //     //QueryBuilder用法
    //     $topics = QueryBuilder::for(Topic::class)
    //         ->allowedIncludes('user', 'category')
    //         ->allowedFilters([
    //             'title',
    //             AllowedFilter::exact('category_id'),
    //             AllowedFilter::scope('withOrder')->default('recentReplied'),
    //         ])
    //         ->paginate();

    //     return TopicResource::collection($topics);
    // }

    //抽象后调用TopicQuery
    public function index(Request $request, TopicQuery $query)
    {
        $topics = $query->paginate();

        return TopicResource::collection($topics);
    }

    public function update(TopicRequest $request, Topic $topic)
    {
        $this->authorize('update', $topic);

        $topic->update($request->all());
        return new TopicResource($topic);
    }

    public function destroy(Topic $topic)
    {
        $this->authorize('destroy', $topic);

        $topic->delete();

        return response(null, 204);
    }

    // public function userIndex(Request $request, User $user)
    // {
    //     $query = $user->topics()->getQuery();

    //     $topics = QueryBuilder::for($query)
    //         ->allowedIncludes('user', 'category')
    //         ->allowedFilters([
    //             'title',
    //             AllowedFilter::exact('category_id'),
    //             AllowedFilter::scope('withOrder')->default('recentReplied'),
    //         ])
    //         ->paginate();

    //     return TopicResource::collection($topics);
    // }
    //抽象后
    public function userIndex(Request $request, User $user, TopicQuery $query)
    {
        $topics = $query->where('user_id', $user->id)->paginate();

        return TopicResource::collection($topics);
    }

    // public function show(Topic $topic)
    // {
    //     return new TopicResource($topic);
    // }


    //为了使用 QueryBuilder不使用路由模型绑定
    // public function show($topicId)
    // {
    //     $topic = QueryBuilder::for(Topic::class)
    //         ->allowedIncludes('user', 'category')
    //         ->findOrFail($topicId);

    //     return new TopicResource($topic);
    // }

    //抽象后
    public function show($topicId, TopicQuery $query)
    {
        $topic = $query->findOrFail($topicId);
        return new TopicResource($topic);
    }
}
