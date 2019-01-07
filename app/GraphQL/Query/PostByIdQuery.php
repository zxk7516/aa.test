<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/7
 * Time: 13:45
 */

namespace App\GraphQL\Query;

use App\Post;
use GraphQL;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\Type;

class PostByIdQuery extends Query
{
    protected  $attributes = [
        'name'=>'根据 id 查找文章',
    ];

    public function type()
    {
        return GraphQL::type('Post');
    }

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required']
            ],
        ];
    }

    public function resolve($root, $args)
    {
        if (!$post = Post::find($args['id'])) {
            throw new \Exception('Resource not found');
        }

        return $post;
    }


}