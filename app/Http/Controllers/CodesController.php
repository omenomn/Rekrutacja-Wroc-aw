<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Code;
use Carbon\Carbon;
use App\Http\Requests\Code\DestroyRequest;

class CodesController extends Controller
{
  public function index()
  {
    $codes = Code::paginate();

    return view('codes.index', compact('codes'));
  }  

  public function store()
  {
    $codes = [];
    $date = Carbon::now()->format('Y-m-d H:i:s');

    for ($i = 1; $i <= 10; $i++) {
      $codes[] = [
        'code' => str_random(20),
        'created_at' => $date,
        'updated_at' => $date,
      ];
    }

    try {
      Code::insert($codes);
    } catch (\Exception $e) {
      return redirect()->back()
        ->with('errorMessage', $e->getMessage());      
    }

    return redirect()->back()
      ->with('success', 'Dodano kody');
  }  

  public function destroy(DestroyRequest $request)
  {
    try {
      Code::whereIn('code', $request->remove_codes)->delete();
    } catch (\Exception $e) {
      return redirect()->back()
        ->with('errorMessage', $e->getMessage());      
    }

    return redirect()->back()
      ->with('success', 'Usunięto kody');
  }
}
