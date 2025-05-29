<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\Models\Post;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class PostType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Post',
        'model' => Post::class,
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::nonNull(Type::int())],
            'title' => ['type' => Type::string()],
            'description' => ['type' => Type::string()],
            'comments' => [
                'type' => Type::listOf(GraphQL::type('Comment')),
                'resolve' => function ($post) {
                    return $post->comments;
                },
            ],
            'user' => [
                'type' => GraphQL::type('User'), // Back-reference
                'resolve' => function($post) {
                    return $post->user;
                }
            ],
        ];
    }
}