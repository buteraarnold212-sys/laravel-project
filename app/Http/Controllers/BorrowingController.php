<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Member;
use App\Models\Book;
use Illuminate\Http\Request;

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

        Borrowing::create($request->only(['member_id', 'book_id', 'borrowing_date', 'return_date']));

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

        $borrowing->update($request->only(['member_id', 'book_id', 'borrowing_date', 'return_date']));

        return redirect()->route('borrowings.index')->with('success', 'Borrowing updated successfully.');
    }

    public function destroy(Borrowing $borrowing)
    {
        $borrowing->delete();

        return redirect()->route('borrowings.index')->with('success', 'Borrowing removed successfully.');
    }
}
