<?php

namespace App\GraphQL\Mutations;

use App\Models\Post;
use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;

class UpdateUserWithPostsMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateUserWithPosts',
        'description' => 'Update a user and their posts'
    ];

    public function type(): Type
    {
        return GraphQL::type('User');
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID of the user'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'Name of the user'
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'Email of the user',
                'rules' => ['email']
            ],
            'posts' => [
                'type' => Type::listOf(GraphQL::type('PostInput')),
                'description' => 'Posts to update/create'
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $user = User::findOrFail($args['id']);
        
        if (isset($args['name'])) {
            $user->name = $args['name'];
        }
        
        if (isset($args['email'])) {
            $user->email = $args['email'];
        }
        
        $user->save();

        if (isset($args['posts'])) {
            foreach ($args['posts'] as $postData) {
                if (isset($postData['id'])) {
                    $post = Post::find($postData['id']);
                    if ($post) {
                        $post->update($postData);
                    }
                } else {
                    $user->posts()->create($postData);
                }
            }
        }

        return $user->load('posts'); 
    }
}