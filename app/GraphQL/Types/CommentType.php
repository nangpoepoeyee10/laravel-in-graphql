<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\Models\Comment;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class CommentType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Comment',
        'model' => Comment::class,
    ];

     public function fields(): array
    {
        return [
            'id' => ['type' => Type::nonNull(Type::int())],
            'text' => ['type' => Type::string()],
            'user' => [
                'type' => GraphQL::type('User'),
                'resolve' => function ($comment) {
                    return $comment->user;
                },
            ],
        ];
    }
}