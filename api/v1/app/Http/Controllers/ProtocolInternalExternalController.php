<?php

namespace App\Http\Controllers;

use App\Models\ProtocolInternalExternal;
use App\Http\Requests\StoreProtocolInternalExternalRequest;
use App\Http\Requests\UpdateProtocolInternalExternalRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProtocolInternalExternalController extends Controller
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
        $protocols = ProtocolInternalExternal::all();
        return $this->sendResponse($protocols, 'Protocols retrieved successfully');
    }

    public function list($quantity, $orderBy)
    {
        // Verifica se a quantidade é especificada e se é um número positivo
        if ($quantity && !is_numeric($quantity)) {
            return $this->sendError('Invalid quantity parameter', 400);
        }

        // Verifica se o orderBy está definido como 'asc' ou 'desc'
        if (!in_array($orderBy, ['asc', 'desc'])) {
            return $this->sendError('Invalid orderBy parameter. Use "asc" or "desc"', 400);
        }

        // Obtenha os protocolos de acordo com a quantidade e a forma de ordenação
        $protocolsQuery = ProtocolInternalExternal::query();

        if ($quantity) {
            $protocolsQuery->take($quantity);
        }

        $protocolsQuery->orderBy('created_at', $orderBy);

        $protocols = $protocolsQuery->get();

        return $this->sendResponse($protocols, 'Protocols retrieved successfully');
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
     * @param  \App\Http\Requests\StoreProtocolInternalExternalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProtocolInternalExternalRequest $request)
    {
        DB::beginTransaction();
        try {

            $validatedData = $request->validate([
                'year' => 'required',
                'number' => 'required',
                'provenance' => 'required',
                'classification_code' => 'required',
                'doc_date' => 'required',
                'subject' => 'required',
                'destination' => 'required',
                'name_of_expander' => 'required',
                'date_of_receipt' => 'required',
                'name_of_recipient' => 'nullable',
                'pdf_path' => 'nullable',
            ]);

            $data = $request->validated(); // Obter os dados validados do request

            // Verifica se um arquivo PDF foi enviado
            if ($request->hasFile('pdf_path')) {
                $pdfFile = $request->file('pdf_path');
                $pdfFileName = time() . '_' . $pdfFile->getClientOriginalName();
                // Salva o arquivo PDF no sistema de arquivos
                $pdfFilePath = $pdfFile->storeAs('pdfs', $pdfFileName); // Armazena o arquivo no diretório 'pdfs' dentro do armazenamento padrão do Laravel
                // Adiciona o caminho do arquivo PDF aos dados do protocolo
                $data['pdf_path'] = '/pdfs/' . $pdfFileName; // Caminho relativo ao diretório public
            }

            // Cria o protocolo com os dados recebidos, incluindo o caminho do arquivo PDF
            $protocol = ProtocolInternalExternal::create($data);

            DB::commit();
            return $this->sendResponse($protocol, 'Protocol created successfully', 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendResponse(null, 'Error while saving protocol', 500);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProtocolInternalExternal  $protocolInternalExternal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $protocol = ProtocolInternalExternal::find($id);

        if (!$protocol) {
            return $this->sendResponse(null, 'Protocol not found', 404);
        }

        return $this->sendResponse($protocol, 'Protocol retrieved successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProtocolInternalExternal  $protocolInternalExternal
     * @return \Illuminate\Http\Response
     */
    public function edit(ProtocolInternalExternal $protocolInternalExternal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProtocolInternalExternalRequest  $request
     * @param  \App\Models\ProtocolInternalExternal  $protocolInternalExternal
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProtocolInternalExternalRequest $request, $id)
    {
        $validatedData = $request->validate([
            'year' => 'required',
            'number' => 'required',
            'provenance' => 'required',
            'classification_code' => 'required',
            'doc_date' => 'required',
            'subject' => 'required',
            'destination' => 'required',
            'name_of_expander' => 'required',
            'date_of_receipt' => 'required',
            'name_of_recipient' => 'nullable',
            'pdf_path' => 'nullable',
        ]);

        $protocol = ProtocolInternalExternal::find($id);

        if (!$protocol) {
            return $this->sendResponse(null, 'Protocol not found', 404);
        }

        DB::beginTransaction();
        try {
            $data = $request->validated(); // Obter os dados validados do request

            // Verifica se um arquivo PDF foi enviado
            if ($request->hasFile('pdf_path')) {
                $pdfFile = $request->file('pdf_path');
                $pdfFileName = time() . '_' . $pdfFile->getClientOriginalName();
                // Salva o arquivo PDF no sistema de arquivos
                $pdfFilePath = $pdfFile->storeAs('pdfs', $pdfFileName); // Armazena o arquivo no diretório 'pdfs' dentro do armazenamento padrão do Laravel
                // Adiciona o caminho do arquivo PDF aos dados do protocolo
                $data['pdf_path'] = '/pdfs/' . $pdfFileName; // Caminho relativo ao diretório public
            }

            // Atualiza os dados do protocolo com os dados recebidos da solicitação, incluindo o caminho do arquivo PDF, se aplicável
            $protocol->update($data);

            DB::commit();
            return $this->sendResponse($protocol, 'Protocol updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendResponse(null, 'Error while updating protocol', 500);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProtocolInternalExternal  $protocolInternalExternal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $protocol = ProtocolInternalExternal::find($id);

        if (!$protocol) {
            return $this->sendResponse(null, 'Protocol not found', 404);
        }

        try {
            $protocol->delete();
            return $this->sendResponse(null, 'Protocol deleted successfully');
        } catch (\Exception $e) {
            \Log::error('Error while deleting Protocol Internal External: ' . $e->getMessage());
            return $this->sendResponse(null, 'Error while deleting protocol', 500);
        }
    }
}
