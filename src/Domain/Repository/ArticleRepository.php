<?

namespace App\Domain\Repository;

interface ArticleRepository
{
    public function findAllPublished(): iterable;
}
