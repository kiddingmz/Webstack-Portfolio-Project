<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrescriptionRequest;
use App\Http\Requests\UpdatePrescriptionRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrescriptionController extends Controller
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
        $correspondences = Prescription::all();
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
        $correspondencesQuery = Prescription::query();

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
     * @param  \App\Http\Requests\StorePrescriptionRequest  $request
     * @return \Illuminate\Http\Response
     */

    public function store(StorePrescriptionRequest $request)
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
            $correspondence = Prescription::create($data);

            DB::commit();
            return $this->sendResponse($correspondence, 'Prescription created successfully', 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendResponse(null, 'Error while saving prescription', 500);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prescription  $correspondece
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $correspondence = Prescription::find($id);

        if (!$correspondence) {
            return $this->sendResponse(null, 'Prescription not found', 404);
        }

        return $this->sendResponse($correspondence, 'Prescription retrieved successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prescription  $correspondece
     * @return \Illuminate\Http\Response
     */
    public function edit(Prescription $correspondece)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePrescriptionRequest  $request
     * @param  \App\Models\Prescription  $correspondece
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePrescriptionRequest $request, $id)
    {
        $validatedData = $request->validate([
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

        // Encontre a correspondência pelo ID
        $correspondence = Prescription::find($id);

        if (!$correspondence) {
            return $this->sendResponse(null, 'Prescription not found', 404);
        }

        try {
            $data = $request->validated(); // Obtenha os dados validados da solicitação

            // Verifique se um arquivo PDF foi enviado
            if ($request->hasFile('pdf_path')) {
                $pdfFile = $request->file('pdf_path');
                $pdfFileName = time() . '_' . $pdfFile->getClientOriginalName();
                // Salve o arquivo PDF na pasta public
                $pdfFilePath = $pdfFile->move(public_path('pdfs'), $pdfFileName);
                // Adicione o caminho do arquivo PDF aos dados da correspondência
                $data['pdf_path'] = '/pdfs/' . $pdfFileName; // Caminho relativo ao diretório public
            }

            // Atualize a instância de correspondência com os dados recebidos
            $correspondence->update($data);

            return $this->sendResponse($correspondence, 'Prescription updated successfully');
        } catch (\Exception $e) {
            \Log::error('Error while updating Prescription: ' . $e->getMessage());
            return $this->sendResponse(null, 'Error while updating correspondence', 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prescription  $correspondece
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $correspondence = Prescription::find($id);

        if (!$correspondence) {
            return $this->sendResponse(null, 'Prescription not found', 404);
        }

        try {
            $correspondence->delete();
            return $this->sendResponse(null, 'Prescription deleted successfully');
        } catch (\Exception $e) {
            \Log::error('Error while deleting Prescription: ' . $e->getMessage());
            return $this->sendResponse(null, 'Error while deleting prescription', 500);
        }
    }
}
