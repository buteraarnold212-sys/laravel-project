<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');

        if ($q) {
            $members = Member::where('name', 'like', "%{$q}%")
                ->orWhere('address', 'like', "%{$q}%")
                ->orWhere('phone', 'like', "%{$q}%")
                ->get();
        } else {
            $members = Member::all();
        }

        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
        ]);

        Member::create($request->only(['name', 'address', 'phone']));

        return redirect()->route('members.index')->with('success', 'Member created successfully.');
    }

    public function show(Member $member)
    {
        return redirect()->route('members.index');
    }

    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
        ]);

        $member->update($request->only(['name', 'address', 'phone']));

        return redirect()->route('members.index')->with('success', 'Member updated successfully.');
    }

    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route('members.index')->with('success', 'Member deleted successfully.');
    }
}
