<?php

namespace App\Services;

class PaginationService
{

  /**
   * The number of items displayed on each page of the table.
   *
   * @var int
   */
  const PER_PAGE = 2;

  /**
   * Pagiante data
   *
   * @return void
   */
  public function getPaginatedData($builder, $currentPage) {
    // Get the paginated data
    $data = $builder->paginate(self::PER_PAGE);
    // Get the last available page to display
    $lastPage = $data->total();
    // If the current page is more than the last available page
    if ($currentPage > $lastPage) {
      // Show the data in the last available page
      $data =  $builder->paginate(self::PER_PAGE, ['*'], 'page', $lastPage);
    }
    return $data;
  }
}
