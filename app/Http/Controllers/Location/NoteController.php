<?php

namespace App\Http\Controllers\Location;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Note;
use App\Http\Controllers\Controller;

class NoteController extends Controller
{
    public function store(Request $request, $location) {
        $location = Location::find($location);

        if ($location) {
            if (trim($request->text) == "") {
                // Detach (Remove)
                if ($location->noteByUser()) {
                    $note = $location->noteByUser()->get()->first();
                    $location->notes()->detach($note);
                    $note->delete();
                    return('removed');
                } else {
                    return('removed');
                }
            } else {
                // Update (TODO: Check id?)
                if (count($location->noteByUser()->get())) {
                    $note = $location->noteByUser()->get()->first();
                    if ($note) {
                        $note->text = $request->text;
                        $note->save();
                        return('updated');
                    }
                    return('error');
                } else {
                    // Create
                    $note = new Note;
                    $note->text = $request->text;
                    $note->user_id = auth()->id();
                    $note->location_id = $location->id;
                    $note->save();
                    $location->notes()->attach($note);
                    return('saved');
                }
            }
        } else {
            return('error');
        }
    }
}
