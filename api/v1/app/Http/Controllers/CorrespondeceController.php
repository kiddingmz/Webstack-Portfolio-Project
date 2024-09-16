<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCorrespondeceRequest;
use App\Http\Requests\UpdateCorrespondeceRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Correspondece;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CorrespondeceController extends Controller
{

    private function sendResponse($data, $message = null, $status = 200)
    {
        $response = [
            'data' => $data,
            'message' => $message,
            'status' => $status
        ];

        return response()->json($response, $status);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $correspondences = Correspondece::all();
        return $this->sendResponse($correspondences, 'Correspondences retrieved successfully');
    }

    public function list($quantity = null, $orderBy = 'asc')
    {
        // Verifica se a quantidade é especificada e se é um número positivo
        if ($quantity && !is_numeric($quantity)) {
            return $this->sendError('Invalid quantity parameter', 400);
        }

        // Verifica se o orderBy está definido como 'asc' ou 'desc'
        if (!in_array($orderBy, ['asc', 'desc'])) {
            return $this->sendError('Invalid orderBy parameter. Use "asc" or "desc"', 400);
        }

        // Obtenha as correspondências de acordo com a quantidade e a forma de ordenação
        $correspondencesQuery = Correspondece::query();

        if ($quantity) {
            $correspondencesQuery->take($quantity);
        }

        $correspondencesQuery->orderBy('created_at', $orderBy);

        $correspondences = $correspondencesQuery->get();

        return $this->sendResponse($correspondences, 'Correspondences retrieved successfully');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCorrespondeceRequest  $request
     * @return \Illuminate\Http\Response
     */

    public function store(StoreCorrespondeceRequest $request)
    {
        DB::beginTransaction();
        try {
            $validatedData = $request->validate([
                'pdf_path' => 'nullable|file|mimes:pdf',
                'year' => 'required',
                'reference_number' => 'required',
                'provenance' => 'required',
                'classification_code' => 'required',
                'doc_date' => 'required',
                'subject' => 'required',
                'forwarded_to' => 'nullable',
                'dispatch' => 'nullable',
                'observition' => 'nullable',
                'order_number' => 'nullable',
                'pdf_path' => 'nullable'
            ]);

            $data = $request->validated(); // Obter os dados validados do request
            // Verifica se um arquivo PDF foi enviado
            if ($request->hasFile('pdf_path')) {
                $pdfFile = $request->file('pdf_path');
                $pdfFileName = time() . '_' . $pdfFile->getClientOriginalName();
                // Salva o arquivo PDF na pasta public
                $pdfFilePath = $pdfFile->move(public_path('pdfs'), $pdfFileName);
                // Adiciona o caminho do arquivo PDF aos dados da correspondência
                $data['pdf_path'] = '/pdfs/' . $pdfFileName; // Caminho relativo ao diretório public
            }

            // Cria a correspondência com os dados recebidos, incluindo o caminho do arquivo PDF
            $correspondence = Correspondece::create($data);

            DB::commit();
            return $this->sendResponse($correspondence, 'Correspondence created successfully', 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendResponse(null, 'Error while saving correspondence', 500);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Correspondece  $correspondece
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $correspondence = Correspondece::find($id);

        if (!$correspondence) {
            return $this->sendResponse(null, 'Correspondence not found', 404);
        }

        return $this->sendResponse($correspondence, 'Correspondence retrieved successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Correspondece  $correspondece
     * @return \Illuminate\Http\Response
     */
    public function edit(Correspondece $correspondece)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCorrespondeceRequest  $request
     * @param  \App\Models\Correspondece  $correspondece
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCorrespondeceRequest $request, $id)
    {

        $validatedData = $request->validate([
            'pdf_path' => 'nullable|file|mimes:pdf',
            'year' => 'required',
            'reference_number' => 'required',
            'provenance' => 'required',
            'classification_code' => 'required',
            'doc_date' => 'required',
            'subject' => 'required',
            'forwarded_to' => 'nullable',
            'dispatch' => 'nullable',
            'observition' => 'nullable',
            'order_number' => 'nullable',
            'pdf_path' => 'nullable'
        ]);

        $correspondence = Correspondece::find($id);

        if (!$correspondence) {
            return $this->sendResponse(null, 'Correspondence not found', 404);
        }

        try {
            $data = $request->validated(); // Obter os dados validados do request

            // Verifica se um arquivo PDF foi enviado
            if ($request->hasFile('pdf_path')) {
                $pdfFile = $request->file('pdf_path');
                $pdfFileName = time() . '_' . $pdfFile->getClientOriginalName();
                // Salva o arquivo PDF na pasta public
                $pdfFilePath = $pdfFile->move(public_path('pdfs'), $pdfFileName);
                // Adiciona o caminho do arquivo PDF aos dados da correspondência
                $data['pdf_path'] = '/pdfs/' . $pdfFileName; // Caminho relativo ao diretório public
            }

            // Atualiza os dados da correspondência com os dados recebidos da solicitação
            $correspondence->update($data);

            return $this->sendResponse($correspondence, 'Correspondence updated successfully');
        } catch (\Exception $e) {
            \Log::error('Error while updating Correspondence: ' . $e->getMessage());
            return $this->sendResponse(null, 'Error while updating correspondence', 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Correspondece  $correspondece
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $correspondence = Correspondece::find($id);

        if (!$correspondence) {
            return $this->sendResponse(null, 'Correspondence not found', 404);
        }

        try {
            $correspondence->delete();
            return $this->sendResponse(null, 'Correspondence deleted successfully');
        } catch (\Exception $e) {
            \Log::error('Error while deleting Correspondence: ' . $e->getMessage());
            return $this->sendResponse(null, 'Error while deleting correspondence', 500);
        }
    }
}
