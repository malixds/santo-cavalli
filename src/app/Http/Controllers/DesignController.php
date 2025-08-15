<?php

namespace App\Http\Controllers;

use App\DTOs\Kafka\DesignEventDTO;
use App\Http\Requests\UploadDesignRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class DesignController extends Controller
{

    public function __construct() {

    }
   public function getPage()
   {
       return view('pages.design');
   }

   public function storeDesign(UploadDesignRequest $request)
   {
       $user = Auth::user();
       if (!$user) {
           return redirect('/login');
       }
   
       $dto = DesignEventDTO::createDesignCreated(
           designId: Str::uuid()->toString(),
           userId: $user->id,
           title: $request->input('title'),
           description: $request->input('description', null),
           status: 'pending'
       );
   
       // Отправка в другой сервис
       $response = Http::post(
           env('DESIGN_SERVICE_URL') . '/api/designs',
           $dto->toArray()
       );
   
       if ($response->successful()) {
           return redirect()->back()->with('success', 'Дизайн отправлен');
       }
   
       return redirect()->back()->withErrors('Ошибка при отправке дизайна');
   }
   
}
