<?php

namespace App\Http\Controllers;

use App\Services\AbstractService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

/**
 * Ao usar o AbstractController é necessário criar manualmente os métodos store e update.
 */

abstract class AbstractController extends Controller
{
    protected AbstractService $service;
    protected string $uploadDirectory = 'uploads/all_files';

    public function __construct(AbstractService $service)
    {
        $this->service = $service;
    }

    public function handleFileUpload($validated)
    {
        Session::forget('temp_files');
        $tempFiles = [];
        $dataValidated = $validated->validated();

        // Função recursiva para lidar com uploads de arquivos
        $processUploads = function (&$data, $fieldPrefix = '') use (&$processUploads, &$tempFiles, $validated) {
            foreach ($data as $field => &$value) {
                $fullField = $fieldPrefix ? "{$fieldPrefix}.{$field}" : $field;

                if (is_array($value)) {
                    // Se o valor for um array, processa recursivamente
                    $processUploads($value, $fullField);
                } elseif ($validated->hasFile($fullField)) {
                    // Se o campo for um arquivo, faz o upload
                    $path = $this->uploadFile($validated->file($fullField));
                    $tempFiles[$fullField] = $path;
                    $value = $path;
                }
            }
        };

        // Inicia o processamento dos dados validados
        $processUploads($dataValidated);

        Session::put('temp_files', $tempFiles);
        return $dataValidated;
    }

    public function uploadFile($file)
    {
        $filename = now()->format('YmdHis') . '_' . $file->getClientOriginalName();
        $file->storeAs($this->uploadDirectory, $filename, 'public');
        return $filename;
    }

    public function deleteTempFiles()
    {
        $tempFiles = Session::pull('temp_files', []);

        foreach ($tempFiles as $paths) {
            foreach ((array) $paths as $path) {
                Storage::disk('public')->delete($this->uploadDirectory . '/' . $path);
            }
        }
        Session::forget('temp_files');
    }
}
