<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/7
 * Time: 13:13
 */

namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => '一个用户',
    ];

    public function fields(){
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => '用户id',
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => '昵称'
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => '邮箱r'
            ],
            'posts' => [
                'type' => Type::listOf(GraphQL::type('Post')),
                'description' => '发布的文章'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => '创建日期'
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => '更新日期'
            ],
        ];
    }

    protected function resolveCreatedAtField($root, $args)
    {
        return (string) $root->created_at;
    }

    protected function resolveUpdatedAtField($root, $args)
    {
        return (string) $root->updated_at;
    }

}