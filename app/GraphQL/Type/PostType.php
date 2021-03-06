<?php

namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class PostType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Post',
        'description' => 'Article post'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of a post'
            ],
            'user' => [
                'type' => Type::nonNull(GraphQL::type('User')),
                'description' => 'The user that posted a post'
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => '标题'
            ],
            'content' => [
                'type' => Type::nonNull(Type::string()),
                'description' => '内容'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'Date a post was created'
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'Date a post was updated'
            ]
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