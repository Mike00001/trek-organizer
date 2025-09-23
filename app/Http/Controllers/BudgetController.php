<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;
use App\Models\Transaction;


class BudgetController extends Controller
{
    public function index()
    {
        // Récupérer tous les budgets créés par l'utilisateur authentifié
        $budgets = Budget::where('createur_id', auth()->id())->get();

        // Retourner la vue avec la liste des budgets
        return view('budgets.index', compact('budgets'));
    }

    public function create()
    {
        return view('budgets.create');  // Retourne la vue avec le formulaire de création
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $budget = Budget::create([
            'nom' => $validated['nom'],
            'createur_id' => auth()->id(),
        ]);

        $budget->participants()->attach(auth()->id()); // Ajoute le créateur comme participant

        return redirect()->route('budgets.show', $budget->id)
            ->with('success', 'Budget créé avec succès.');
    }

    public function show(Budget $budget)
    {
        // Vérifiez si l'utilisateur est le créateur du budget
        if (auth()->id() !== $budget->createur_id) {
            abort(403, 'Accès interdit');
        }

        $transactions = $budget->transactions()->latest()->get();
        $participants = $budget->participants;

        return view('budgets.show', compact('budget', 'transactions', 'participants'));
    }


    public function addParticipant(Request $request, Budget $budget)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $budget->participants()->attach($validated['user_id']);

        return back()->with('success', 'Participant ajouté.');
    }

    public function storeTransaction(Request $request, Budget $budget)
    {
        // Validation des données de la transaction
        $validated = $request->validate([
            'montant' => 'required|numeric|min:0.01',
            'description' => 'required|string|max:255',
            'type' => 'required|in:credit,debit',  // Assurez-vous que le type est bien 'credit' ou 'debit'
        ]);

        // Créer une nouvelle transaction
        $transaction = new Transaction([
            'montant' => $validated['montant'],
            'description' => $validated['description'],
            'type' => $validated['type'],
            'budget_id' => $budget->id,
            'utilisateur_id' => auth()->id(),  // Utilisateur actuel qui crée la transaction
        ]);

        $transaction->save();

        return back()->with('success', 'Transaction ajoutée avec succès.');
    }

}
