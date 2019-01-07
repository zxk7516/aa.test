<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/7
 * Time: 13:38
 */

namespace App\GraphQL\Mutation;


use GraphQL;
use App\Post;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class NewPost extends Mutation
{
    protected $attributes = [
        'name' => '新文章'
    ];

    public function type()
    {
        return GraphQL::type('Post');
    }

    public function args()
    {
        return [
            'title' => [
                'name' => 'title',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required'],
            ],
            'content' => [
                'name' => 'content',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required'],
            ],

        ];
    }

    public function authenticated($root, $args, $currentUser)
    {
        return !!$currentUser;
    }

    public function resolve($root, $args)
    {
        $post = new Post();
        $post->title = $args['title'];
        $post->content = $args['content'];
        $post->user_id = auth('api')->user()->id;
        $post->save();

        return $post;
    }
}