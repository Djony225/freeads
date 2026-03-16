<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;
use App\Models\Category;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $ads=Ad::with('category')->latest()->paginate(10);
        return view('ads.index', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('ads.create', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'photo'       => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'price'       => 'required|numeric|min:0',
            'location'    => 'required|string|max:100',
        ]);

    $path = $request->file('photo')->store('photos', 'public');

    Ad::create([
        'user_id'     => auth()->id(),
        'category_id' => $request->category_id,
        'title'       => $request->title,
        'description' => $request->description,
        'photo'       => $path,
        'price'       => $request->price,
        'location'    => $request->location,
    ]);

    return redirect()->route('ads.index')->with('success', 'Annonce publiée !');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $ad = Ad::findOrFail($id);
        return view('ads.show', compact('ad'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $ad = Ad::findOrFail($id);
        $categories = Category::all();
        return view('ads.edit', compact('ad', 'categories'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $ad = Ad::findOrFail($id);
        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'location'    => 'required|string|max:100',
        ]);

        $data = $request->only(['title','category_id','description','price','location']);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

        $ad->update($data);
        return redirect()->route('ads.index')->with('success', 'Annonce modifiée !');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Ad::findOrFail($id)->delete();
        return redirect()->route('ads.index')->with('success', 'Annonce supprimée !');

    }

   public function home(Request $request) 
    {
    
        $query = Ad::with('category');

        
        
        // Recherche par mot-clé (Titre ou Description)
        if($request->filled('search')){
            $query->where(function($q) use ($request){
                $q->where('title', 'like', '%'. $request->search. '%')
                ->orWhere('description', 'like', '%'. $request->search. '%');  
            });
        }

        // Filtre par prix (Min et Max)
        if($request->filled('min_price')){
            $query->where('price', '>=', $request->min_price);
        }
        if($request->filled('max_price')){
            $query->where('price', '<=', $request->max_price);
        }

        // Filtre par Localisation
        if($request->filled('location')){
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        // Filtre par État (Status)
        if($request->filled('status')){
            $query->where('status', $request->status);
        }

        // Filtre par Catégorie
        if($request->filled('category')){
            $query->where('category_id', $request->category);
        }

        // --- FIN DE LA LOGIQUE DE FILTRE ---

        // On récupère les résultats avec lA pagination
        $ads = $query->latest()->paginate(12);
        
        // On récupère toutes les catégories pour les afficher dans le menu déroulant
        $categories = \App\Models\Category::all();

        return view('ads.home', compact('ads', 'categories'));
    }
    
    public function voir(string $id)
    {
        //
        $ad = Ad::findOrFail($id);
        return view('ads.voir', compact('ad'));
    }
}
