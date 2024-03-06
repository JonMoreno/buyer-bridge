<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\TimeCapsule;
use Illuminate\Http\Request;
use App\Http\Requests\TimeCapsulePostRequest;

class TimeCapsuleController extends Controller
{
    /**
     * Retrieve a listing of the resource.
     */
    public function index()
    {
        $timeCapsules = TimeCapsule::where('user_id', auth()->id())->get();
        return $timeCapsules;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TimeCapsulePostRequest $request)
    {
        return TimeCapsule::create([
            'title' => $request->title,
            'message' => $request->message,
            'open_at' => $request->openAtDate . ' ' . $request->openAtTime,
            'user_id' => auth()->user()->id,
        ]);
    }

    /**
     * Retrieve the specified resource.
     */
    public function show(string $id)
    {
        $timeCapsule = TimeCapsule::find($id);

        $authUser = auth()->user() ?? null;
        if ($authUser && $timeCapsule) {
            $isAdmin = $authUser->role  == 'admin' ? true : false;
            $belongsToUser = $timeCapsule->user_id === $authUser->id ?? null;

            $now = Carbon::parse()->endOfMinute();
            $openAt = Carbon::parse($timeCapsule->open_at)->startOfMinute();
            $canBeOpened = $openAt->lessThanOrEqualTo($now);

            if (($belongsToUser && $canBeOpened) || $isAdmin) {
                $timeCapsule->makeVisible('message');
                $timeCapsule->is_opened = true;
                $timeCapsule->save();

                return $timeCapsule;
            } else return response()->json(['message' => 'Access denied'], 403);
        } else return response()->json(['message' => 'Not Found'], 404);
    }
}
