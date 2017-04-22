<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CodesController extends Controller
{
  public function index()
  {
    return view('codes.index');
  }  

  public function store()
  {
    return redirect()->back()
      ->with('success', 'Dodano kody');
  }  

  public function destroy(Request $request)
  {
    return redirect()->back()
      ->with('success', 'Usunięto kody');
  }
}
