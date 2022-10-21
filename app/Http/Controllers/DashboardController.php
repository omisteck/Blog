<?php

namespace App\Http\Controllers;

use App\Traits\HandleResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use HandleResponse;

    /**
     * @return \Inertia\Response
     */
    public function dashboard()
    {
        $limit = config('app.pagination');
        return $this->InertiaResponse(
            'Dashboard',
            $this->JsonResponse(
                ['posts' => auth()->user()->posts()->paginate($limit)]
            )
        );
    }
}
