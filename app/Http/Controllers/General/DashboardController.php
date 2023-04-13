<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  /**
   * Main dashboard with all menu options
   * @return view  general.main
   */
    public function init($value='')
    {
      return view('general.inicio');
    }
}
