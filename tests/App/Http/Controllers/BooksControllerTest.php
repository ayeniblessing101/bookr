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
  public function testShouldGetAllBooks()
  {
    $this->get('api/v1/books')->seeJson([
      'title' => 'War of the Worlds'
    ])
    ->seeJson([
      'title' => 'A Wrinkle in Time'
    ]);
  }

  /**
   * Get a book controller test
   *
   * @return void
   */
  public function testShouldGetABook() {
    $this
      ->get('/api/v1/books/1')
      ->seeStatusCode(200)
      ->seeJson([
        'id' => 1,
        'title' => 'War of the Worlds',
        'description' => 'A science fiction masterpiece about Martians invading London',
        'author' => 'H. G. Wells'
      ]);
    }

  /**
   * Get a book controller test
   *
   * @return void
   */
  public function testShouldThrowAnErrorWhenBookIdNotFound() {
    $this
      ->get('/api/v1/books/9999')
      ->seeStatusCode(404)
      ->seeJson([
        'error' => [
          'message' => 'Book not found'
        ],
      ]);
  }
}
