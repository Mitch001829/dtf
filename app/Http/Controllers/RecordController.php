<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Participant;


class RecordController extends Controller
{
    public function index()
    {
        return view("pages.record.index");
    }
}
