<?php

namespace App\GraphQL\Mutations;

use App\Models\Post;
use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CreateUserWithPostsMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createUserWithPosts'
    ];

    public function type(): Type
    {
        return GraphQL::type('User');
    }

    public function args(): array
    {
        return [
            'name' => [
                'type' => Type::nonNull(Type::string())
            ],
            'email' => [
                'type' => Type::nonNull(Type::string())
            ],
            'posts' => [
                'type' => Type::listOf(GraphQL::type('PostInput'))
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $user = User::create([
            'name' => $args['name'],
            'email' => $args['email']
        ]);

        if (isset($args['posts'])) {
            foreach ($args['posts'] as $postData) {
                $user->posts()->create($postData);
            }
        }

        return $user;
    }
}