<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DatabaseJson\Models\Person;
use Illuminate\Support\Facades\Validator;

class PersonController extends Controller {

    private $rules = [
        'name' => 'required|string',
        'surname' => 'required|',
        'birth_date' => 'required|date'
    ];

    private $messages = [
        'name.required' => 'Il campo è obbligatorio',
        'name.string' => 'Il campo deve essere una stringa',
        'surname.required' => 'Il campo è obbligatorio',
        'surname.string' => 'Il campo deve essere una stringa',
        'birth_date.required' => 'Il campo nascita è obbligatorio',
        'birth_date.date' => 'Il campo deve essere una data',
    ];

    public function index() {
        $people = Person::all();
        if ($people->count() == 0) {
            return response()->json(
                [
                    'message' => 'No data found'
                ],
                404
            );
        }
        return response()->json($people->map->toArray());
    }

    public function get($id) {
        $person = Person::find($id);
        if ($person == null) {
            return response()->json(
                [
                    'message' => 'No data found'
                ],
                404
            );
        }

        return response()->json($person->toArray());
    }

    public function insert(Request $request) {
        $validator = Validator::make($request->all(), $this->rules, $this->messages);
        if ($validator->fails()) {
            return response()->json(
                [
                    'message' => 'An error occurred',
                    'errors' => $validator->messages()
                ],
                422
            );
        }

        try {
            $person = Person::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'birth_date' => $request->birth_date,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
        } catch (\Exception $ex) {
            return response()->json(
                [
                    'message' => 'An error occurred',
                    'error' => $ex->getMessage()
                ],
                500
            );
        }

        return response()->json($person->toArray(), 201);
    }

    public function update(Request $request, $id) {
        $person = Person::find($id);
        if (!$person) {
            return response()->json(
                [
                    'message' => 'No data found'
                ],
                404
            );
        }

        $validator = Validator::make($request->all(), $this->rules, $this->messages);
        if ($validator->fails()) {
            return response()->json(
                [
                    'message' => 'An error occurred',
                    'errors' => $validator->messages()
                ],
                422
            );
        }

        try {
            $person->update(
                [
                    'name' => $request->name,
                    'surname' => $request->surname,
                    'birth_date' => $request->birth_date,
                    'email' => $request->email,
                    'phone' => $request->phone,
                ],
                $id
            );
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }

        return response()->json($person->toArray());
    }

    public function delete($id) {
        $person = Person::find($id);
        if (!$person) {
            return response()->json(
                [
                    'message' => 'No data found'
                ],
                404
            );
        }

        try {
            Person::find($id)->delete();
        } catch (\Exception $ex) {
            return response()->json(
                [
                    'message' => 'An error occurred',
                    'error' => $ex->getMessage()
                ],
                500
            );
        }

        return response()->json(
            [
                'message' => 'Record deleted correctly'
            ],
            204
        );
    }
}
