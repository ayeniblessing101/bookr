<?php

  namespace App\Http\Controllers;

  use App\Book;
  use Illuminate\Database\Eloquent\ModelNotFoundException;


  /**
   * Class BooksController
   * @package App\Http\Controllers
   */
  class BooksController extends Controller {
    /**
     * GET /api/v1/books
     * @return array
     */
    public function getAllBooks() {
      return Book::all();
    }

    /**
     * Get /api/v1/books/{id}
     *
     * @param integer $id
     * @return mixed
     */
    public function getABook($id) {
      try {
        return Book::findOrFail($id);
      } catch(ModelNotFoundException $e) {
        return response()->json([
          'error' => [
            'message' => 'Book not found'
          ]
        ], 404);
      }
    }
  }
