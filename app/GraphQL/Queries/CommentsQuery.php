<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use App\Models\Comment;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CommentsQuery extends Query
{
   public function type(): Type
    {
        return Type::listOf(GraphQL::type('Comment'));
    }

    public function resolve($root, $args)
    {
        return Comment::with('user')->get(); 
    }
 }

