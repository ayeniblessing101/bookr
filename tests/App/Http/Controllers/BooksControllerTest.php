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
   * Get all books test
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
   * Get a book test
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

  /**
   * Create a new book test
   *
   * @return array
   */
  public function testShouldCreateBook() {
    $this->post('/api/v1/books', [
      'title' => 'The Invisible Man',
      'description' => 'An invisible man is trapped in the terror of his own
creation',
      'author' => 'H. G. Wells'
    ]);

    $this
      ->seeJson(['created' => true])
      ->seeInDatabase('books', ['title' => 'The Invisible Man']);
  }



  /**
   * Update book test
   *
   * @return array
   */
  public function testUpdateShouldOnlyChangeRequestedField() {
    $this->notSeeInDatabase('books', [
      'title' => 'War of the Worlds'
    ]);

    $this->put('/api/v1/books/1', [
      'id' => '5',
      'title' => 'War of the Worlds',
      'description' => 'The book is way better than the movie.',
      'author' => 'Wells, H. G.'
    ]);

    $this
      ->seeStatusCode(200)
      ->seeJson([
        'id' => '1',
        'title' => 'War of the Worlds',
        'description' => 'The book is way better than the movie.',
        'author' => 'Wells, H. G.'
      ]);

    $this->seeInDatabase('books', [
      'title' => 'War of the Worlds'
    ]);
  }

//  public function updateShouldFailWithAnInvalidId() {
//    $this->markTestIncomplete();
//  }
//
//  public function updateShouldNotMatchAnInvalidRoute() {
//    $this->markTestIncomplete();
//  }

}
