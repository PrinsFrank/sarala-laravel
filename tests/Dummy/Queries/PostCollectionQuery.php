<?php

declare(strict_types=1);

namespace Sarala\Dummy\Queries;

use Illuminate\Database\Eloquent\Builder;
use Sarala\Dummy\Post;
use Sarala\Filters;
use Sarala\Includes;
use Sarala\Query\CollectionQueryBuilder;

class PostCollectionQuery extends CollectionQueryBuilder
{
    public function init(): Builder
    {
        return Post::query();
    }

    public function fields()
    {
        // TODO: Implement fields() method.
    }

    public function filter(Filters $filters)
    {
        $this->query
            ->when($filters->has('my'), function ($query) {
                $query->composedBy($this->request->user());
            });
    }

    public function include(Includes $includes)
    {
        PostQuery::mergeCommonInclude($this->query, $includes);
    }

    public function orderBy(): array
    {
        return [];
    }
}
