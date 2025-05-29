<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use App\Models\Post;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Facades\GraphQL;

class PostsQuery extends Query
{
      public function type(): Type
    {
        return Type::listOf(GraphQL::type('Post'));
    }

    public function resolve($root, $args)
    {
        return Post::with('comments')->get();
    }
}
