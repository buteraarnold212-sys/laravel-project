<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Member;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['member', 'book'])->get();
        return view('borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        $members = Member::all();
        $books = Book::all();
        return view('borrowings.create', compact('members', 'books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'book_id' => 'required|exists:books,id',
            'borrowing_date' => 'required|date',
            'return_date' => 'nullable|date',
        ]);

        $book = Book::find($request->book_id);
        if (!$book || $book->quantity < 1) {
            return back()
                ->withErrors(['book_id' => 'This book is currently unavailable for borrowing.'])
                ->withInput();
        }

        DB::transaction(function () use ($request, $book) {
            $book->decrement('quantity');
            Borrowing::create($request->only(['member_id', 'book_id', 'borrowing_date', 'return_date']));
        });

        return redirect()->route('borrowings.index')->with('success', 'Borrowing recorded successfully.');
    }

    public function show(Borrowing $borrowing)
    {
        return redirect()->route('borrowings.index');
    }

    public function edit(Borrowing $borrowing)
    {
        $members = Member::all();
        $books = Book::all();
        return view('borrowings.edit', compact('borrowing', 'members', 'books'));
    }

    public function update(Request $request, Borrowing $borrowing)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'book_id' => 'required|exists:books,id',
            'borrowing_date' => 'required|date',
            'return_date' => 'nullable|date',
        ]);

        try {
            DB::transaction(function () use ($request, $borrowing) {
                $oldBook = Book::find($borrowing->book_id);
                $newBook = Book::find($request->book_id);
                $wasReturned = !is_null($borrowing->return_date);
                $willBeReturned = !blank($request->return_date);

                if (!$newBook) {
                    throw new \RuntimeException('Selected book was not found.');
                }

                if ($borrowing->book_id !== $newBook->id) {
                    if (!$wasReturned && $oldBook) {
                        $oldBook->increment('quantity');
                    }

                    if (!$willBeReturned) {
                        if ($newBook->quantity < 1) {
                            throw new \RuntimeException('The selected book is currently unavailable for borrowing.');
                        }
                        $newBook->decrement('quantity');
                    }
                } else {
                    if (!$wasReturned && $willBeReturned && $oldBook) {
                        $oldBook->increment('quantity');
                    } elseif ($wasReturned && !$willBeReturned && $oldBook) {
                        if ($oldBook->quantity < 1) {
                            throw new \RuntimeException('The selected book is currently unavailable for borrowing.');
                        }
                        $oldBook->decrement('quantity');
                    }
                }

                $borrowing->update($request->only(['member_id', 'book_id', 'borrowing_date', 'return_date']));
            });
        } catch (\RuntimeException $e) {
            return back()
                ->withErrors(['book_id' => $e->getMessage()])
                ->withInput();
        }

        return redirect()->route('borrowings.index')->with('success', 'Borrowing updated successfully.');
    }

    public function destroy(Borrowing $borrowing)
    {
        DB::transaction(function () use ($borrowing) {
            if (is_null($borrowing->return_date)) {
                $book = Book::find($borrowing->book_id);
                if ($book) {
                    $book->increment('quantity');
                }
            }

            $borrowing->delete();
        });

        return redirect()->route('borrowings.index')->with('success', 'Borrowing removed successfully.');
    }
}
