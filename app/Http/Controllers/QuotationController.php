<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Quotation;
use App\Mail\SendQuotation;
use App\Models\Correlative;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\QuotationItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreQuotationRequest;
use App\Http\Requests\UpdateQuotationRequest;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('name', '!=' ,'Desarrollador')->get();
        $clients = Customer::all();
        return view('quotes.index', compact('users', 'clients'));
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('quotations')
                ->join('users', 'quotations.user_id', '=', 'users.id')
                ->join('customers', 'quotations.customer_id', '=', 'customers.id')
                ->join('quotation_items', 'quotations.id', '=', 'quotation_items.quotation_id')
                ->select('quotations.*', 'users.name as user', 'customers.business_name as customer',
                    'customers.rut as rut')
                ->orderBy('quotations.created_at', 'desc')
                ->groupBy('quotations.id', 'users.name', 'customers.business_name', 'customers.rut');
            return DataTables::of($data)
                ->filter(function ($query) use ($request) {
                    if ($request->has('user_id') && $request->get('user_id') != '') {
                        $query->where('quotations.user_id', $request->get('user_id'));
                    }

                    if ($request->has('customer_id') && $request->get('customer_id') != '') {
                        $query->where('quotations.customer_id', $request->get('customer_id'));
                    }

                    if ($request->has('start') && $request->has('end') && $request->get('start') != '' && $request->get('end') != '') {
                        $query->whereBetween('quotations.created_at', [$request->get('start'), $request->get('end')]);
                    }

                    if ($request->has('status') && $request->get('status') != '') {
                        $query->where('quotations.status', $request->get('status'));
                    }

                    if ($request->has('search') && $request->get('search')['value'] != '') {
                        $searchValue = $request->get('search')['value'];
                        $query->where(function ($subQuery) use ($searchValue) {
                            $subQuery->where('customers.business_name', 'like', "%{$searchValue}%")
                                     ->orWhere('users.name', 'like', "%{$searchValue}%")
                                     ->orWhere('customers.rut', 'like', "%{$searchValue}%");
                        });
                    }
                })
                ->addColumn('actions', function ($data) {
                    return view('quotes.partials.actions', ['data' => $data]);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $products = Category::all();
        return view('quotes.create', compact('customers', 'products'));
    }

    public function productjson($quotation)
    {
        $data = Product::find($quotation);
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuotationRequest $request)
    {
        $customer = Customer::where('business_name', $request->customer)->first();
        $productos = json_decode($request->array_products);

        $quote = Quotation::create([
            'customer_id'    => $customer->id,
            'user_id'        => auth()->user()->id,
            'subtotal'       => $request->subtotal,
            'iva'            => $request->iva,
            'discount'       => $request->discount,
            'grand_total'    => $request->total,
            'note'           => $request->note,
        ]);

        foreach ($productos as $key) {
            QuotationItem::create([
                'quotation_id'   => $quote->id,
                'reference'      => $key->reference,
                'product_name'   => $key->producto,
                'quantity'       => $key->quantity,
                'unit'           => $key->tipo,
                'price'          => $key->price,
                'subtotal'       => $key->subtotal,
            ]);
        }

        return redirect()->route('quote.index')->with('success', 'Cotización Guardada Exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($quotation)
    {
        $data = Quotation::with('items', 'customer')->find($quotation);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($quotation)
    {
        $customers = Customer::all();
        $categorys = Category::all();
        $quotation = Quotation::with('items')->find($quotation);
        return view('quotes.edit', compact('quotation', 'customers', 'categorys'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuotationRequest $request, $quotation)
    {
        $customer = Customer::where('business_name', $request->customer)->first();
        $productos = json_decode($request->array_products);
        $quote = Quotation::find($quotation);
        $quote->update([
            'customer_id'    => $customer->id,
            'user_id'        => auth()->user()->id,
            'subtotal'       => $request->subtotal,
            'iva'            => $request->iva,
            'discount'       => $request->discount,
            'grand_total'    => $request->total,
            'note'           => $request->note
        ]);

        $quote->items()->delete();

        foreach ($productos as $key) {
            QuotationItem::create([
                'quotation_id'   => $quote->id,
                'reference'      => $key->reference,
                'product_name'   => $key->producto,
                'quantity'       => $key->quantity,
                'unit'           => $key->tipo,
                'price'          => $key->price,
                'subtotal'       => $key->subtotal,
            ]);
        }

        return redirect()->route('quote.index')->with('success', 'Cotización Actualizada Exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($quotation)
    {
        $quotation = Quotation::find($quotation);
        $quotation->delete();

        $quotationItems = QuotationItem::where('quotation_id', $quotation->id)->get();
        foreach ($quotationItems as $key) {
            $key->delete();
        }

        return redirect()->route('quote.index')->with('success', 'Cotización eliminada con exito');
    }

    public function quotepdf($quotation)
    {
        $quotation = Quotation::find($quotation);
        return Pdf::loadView('quotes.pdfs.quotation', compact('quotation'))
                ->stream(''.config('app.name', 'Laravel').' - Cotizacion N '.$quotation->correlativo.'.pdf');
    }

    public function sendEmailQuotepdf($quotation)
    {
        $quotation = Quotation::with('customer')->find($quotation);

        if ($quotation->customer->email == null) {
            return redirect()->route('quote.index')->with('error', 'El Cliente no posee correo para enviar la cotizacion');
        }

        $publicpath = public_path('storage/cotizaciones/');
        $namepdf = config('app.name', 'Laravel').' - cotizacion - '.$quotation->customer->business_name.' - '.date('Y-m-d').'.pdf';
        $urlpdf = $publicpath.$namepdf;


        $pdf = Pdf::loadView('quotes.pdfs.quotation', compact('quotation'))
                ->save($urlpdf);

        try {
            Mail::to($quotation->customer->email)->send(new SendQuotation($quotation, $urlpdf, $namepdf));

            return redirect()->route('quote.index')->with('success', 'Cotizacion Enviada Exitosamente');
        } catch (\Throwable $th) {
            Log::error("error al enviar cotizacion: ".$th->getMessage());

            return redirect()->route('quote.index')->with('error', 'Error al enviar la cotizacion, verifique su correo');
        }

    }

    public function cambiarStatus(Request $request)
    {
        $quote = Quotation::find($request->id);
        $quote->update([
            'status' => $request->status
        ]);
        return redirect()->route('quote.index')->with('success', 'Status de Cotización Actualizada Correctamente');
    }



}
