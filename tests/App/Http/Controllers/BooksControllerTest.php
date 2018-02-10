<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\App\Http\Controllers;

class BooksControllerTest extends TestCase
{
  /**
   * Get all books controller test.
   *
   * @return void
   */
  public function testGetAllBooks()
  {
    $this->get('/books')->seeJson([
      'title' => 'War of the Worlds'
    ])
    ->seeJson([
      'title' => 'A Wrinkle in Time'
    ]);
  }
}
