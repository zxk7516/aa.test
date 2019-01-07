<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/7
 * Time: 13:43
 */

namespace App\GraphQL\Query;

use GraphQL;
use App\Post;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;

class AllPostsQuery extends Query
{
    protected $attributes = [
        'name' => '所有文章'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Post'));
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $fields = $info->getFieldSelection();

        $posts = Post::query();

        foreach ($fields as $field => $keys) {
            if ($field === 'user') {
                $posts->with('user');
            }
        }

        return $posts->latest()->get();
    }

}