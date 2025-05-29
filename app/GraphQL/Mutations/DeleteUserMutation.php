<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class DeleteUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteUser',
        'description' => 'Delete a user and their related posts'
    ];

    public function type(): Type
    {
        return Type::nonNull(Type::boolean());
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID of the user to delete',
                'rules' => ['exists:users,id']
            ],
            'delete_posts' => [
                'type' => Type::boolean(),
                'description' => 'Whether to also delete all posts',
                'defaultValue' => false
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $user = User::findOrFail($args['id']);

        if ($args['delete_posts']) {
            $user->posts()->delete();
        }

        return $user->delete();
    }
}