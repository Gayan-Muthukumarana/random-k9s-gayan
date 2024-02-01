<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Random K9s",
 *     description="<h3>API-integration</h3>
<p>This API documentation includes the results for the particular user who are within following criteria:</p>
<ul>
 <li>Numberphiles who are prefer to see the facts with numbers</li>
 <li>Other group of people who don't need to see the facts with numbers</li>
 <li>The rest users who don't matter whether the facts include numbers or not</li>
</ul>
</div>
",
 * )
 *
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
