<?php

namespace App\Http\Controllers\People;

use App\Events\PersonCapturedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePerson;
use App\Models\Language;
use App\Models\People\Person;
use App\Rules\inLanguageSet;
use App\Rules\validId;
use App\Services\People\InterestCrud;
use App\Services\People\InterestsParse;
use App\Services\SanitizeMobileNumbers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $people = Person::with('language', 'interests')->where('user_id', Auth::id())->get();

        return view('People.index', [
            'people' => $people,
            'languages' => Language::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePerson $request)
    {
        $person = Person::updateOrCreate(
            [
                'sa_id' => $request->sa_id
            ],
            $request->except(['sa_id', 'interests'])
        );

        $interestParse = new InterestsParse($request->interests);
        $personInterestCrud = new InterestCrud();
        $personInterestCrud->linkInterests($person->id, $interestParse->getInterestIds());

        PersonCapturedEvent::dispatch($person);
        session()->flash('success', "Person Created Successfully");
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\People\Person $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\People\Person $person
     */
    public function edit(Person $person)
    {
        return view('People.edit', [
            'person' => $person,
            'languages' => Language::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\People\Person $person
     */
    public function update(StorePerson $request, Person $person)
    {
        $person->update(
            $request->except('interests')
        );
        $interestParse = new InterestsParse($request->interests);
        $personInterestCrud = new InterestCrud();
        $personInterestCrud->linkInterests($person->id, $interestParse->getInterestIds());
        session()->flash('success', "Person Updated Successfully");
        return redirect()->route('persons.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\People\Person $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        $person->delete();
        session()->flash('success', "Person deleted successfully");
        return back();
    }
}
