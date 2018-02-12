<?php

  namespace App\Http\Controllers;

  use App\Book;

  use Illuminate\Database\Eloquent\ModelNotFoundException;

  use Illuminate\Http\Request;
  use Mockery\Exception;


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

    /**
     * Post /api/v1/books
     *
     * @param integer $request
     * @return mixed
     */
    public function createBook(Request $request) {

        $book = Book::create($request->all());

      return response()->json(['created' => true], 201,
        [
          'Location' => route('book.get', ['id' => $book->id])
        ]);
    }
  }
