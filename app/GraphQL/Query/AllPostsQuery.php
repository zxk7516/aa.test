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

    public function args()
    {
        return [

            'page' => [
                'name' => 'page',
                'type' => Type::getNullableType(Type::int()),
                'rules' => []
            ],
            'pagesize' => [
                'name' => 'pagesize',
                'type' => Type::getNullableType(Type::int()),
                'rules' => []
            ],

        ];
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
        return $posts->latest('id')->paginate($args['pagesize']??15,['*'],'page',$args['page']??1);
    }

}