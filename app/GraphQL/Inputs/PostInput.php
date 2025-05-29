<?php

namespace App\GraphQL\Inputs;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class PostInput extends InputType
{
    protected $attributes = [
        'name' => 'PostInput',
        'description' => 'Input type for posts'
    ];

    public function fields(): array
{
    return [
        'id' => [ 
            'type' => Type::int(),
            'description' => 'ID of post (only needed for updates)'
        ],
        'title' => [
            'type' => Type::string(), 
            'description' => 'The title of the post'
        ],
        'description' => [
            'type' => Type::string(),
            'description' => 'The description of the post'
        ]
    ];
}
}