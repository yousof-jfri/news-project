<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function index()
    {
        return view('admin.topics.all');
    }

    public function create()
    {
        return view('admin.topics.create');
    }

    public function edit($id)
    {
        return view('admin.topics.edit', compact('id'));
    }
}
