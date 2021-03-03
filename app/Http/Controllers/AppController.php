<?php

namespace App\Http\Controllers;
use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
    
    public function __construct()
    {
        //$this->middleware('auth');
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myAppsDev()
    {
        if (auth()->guest()) return redirect( route('apps.index') );
        $apps = App\App::get()->where('created_by', '=', auth()->id());
        return view('apps/myAppsDev',compact('apps'));
    }

    public function myAppsUser()
    {
        if (auth()->guest()) return redirect( route('apps.index') );
        $purchases = App\User::find( auth()->id() )->purchases;
        foreach ($purchases as $purchase) $apps[] = App\App::withTrashed()->find($purchase->app_id);
        return view('apps/myAppsUser',compact('purchases','apps'));
    }

    public function index()
    {
        $apps = App\App::get();
        return view('apps/index',compact('apps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('apps/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'name' => 'required|unique:apps,name',
            'price' => 'required'
        ]);
        
        $newApp = new App\App;
        $newApp->category = $request->category;
        $newApp->name = $request->name;
        $newApp->price = $request->price;
        $newApp->logo = $request->logo;
        $newApp->description = $request->description;
        $newApp->created_by = auth()->id();
        $newApp->save();
        return redirect()->action('AppController@index')->with('returnedMessage', 'App agregada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $app = App\App::withTrashed()->findOrFail($id);
        $purchases = App\App::withTrashed()->find($id)->purchases;
        $activateBuyButton = true;
        foreach($purchases as $purchase)
            if($purchase->user_id == auth()->id())
                $activateBuyButton = false;
        return view('apps/details',compact('app','activateBuyButton'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $app = App\App::findOrFail($id);
        return view('apps/edit',compact('app'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'price' => 'required'
        ]);
        
        $app = App\App::findOrFail($id);
        $app->price = $request->price;
        $app->logo = $request->logo;
        $app->description = $request->description;
        $app->save();
        return redirect()->action('AppController@myAppsDev')->with('returnedMessage', 'App editada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $app = App\App::findOrFail($id);
        $app->delete();
        return back()->with("deleted" , $id );
    }

    public function restore($id)
    {
        $app = App\App::withTrashed()->where('id', '=', $id)->first();
        $app->restore();
        return back()->with('returnedMessage', 'App restaurada correctamente');
    }

    public function buy($id)
    {
        $app = App\App::where('id', '=', $id)->first();
        $purchase = new App\Purchase;
        $purchase->user_id = auth()->id();
        $purchase->app_id = $app->id;
        $purchase->save();
        //TODO: Proceso de verificación de tarjeta de crédito u otra forma de pago
        return redirect()->action('AppController@index')->with('returnedMessage', 'App comprada!');
    }
}
