<?php

namespace App\Http\Controllers;

use App\Http\Requests\IncomingItemRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\IncomingItemRepository;
use App\Repositories\SubCategoryRepository;
use App\Repositories\UserRepository;
use Barryvdh\DomPDF\Facade\Pdf;

class IncomingItemController extends Controller
{
    protected $userRepository, $categoryRepository, $subCategoryRepository, $incomingItemRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->categoryRepository = new CategoryRepository();
        $this->subCategoryRepository = new SubCategoryRepository();
        $this->incomingItemRepository = new IncomingItemRepository();
    }

    public function index()
    {
        return view('incoming-items/index', [
            'menu' => 'Barang Masuk',
            'incomingItems' => $this->incomingItemRepository->all(),
            'category' => $this->categoryRepository->all(),
        ]);
    }

    public function create()
    {
        return view('incoming-items/create', [
            'menu' => 'Barang Masuk',
            'operator' => $this->userRepository->operator(),
            'category' => $this->categoryRepository->all(),
        ]);
    }

    public function edit($id)
    {
        return view('incoming-items/edit', [
            'menu' => 'Edit Barang Masuk',
            'operator' => $this->userRepository->operator(),
            'category' => $this->categoryRepository->all(),
            'data' => $this->incomingItemRepository->find($id)->toArray(),
        ]);
    }

    public function store(IncomingItemRequest $request)
    {
        try {
            $this->incomingItemRepository->create($request->validated());
            return response()->json(['message' => 'Barang berhasil ditambahkan']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(IncomingItemRequest $request)
    {
        try {
            $this->incomingItemRepository->update($request->validated());
            return response()->json(['message' => 'Barang berhasil diubah']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->incomingItemRepository->destroy($id);
            return redirect()->route('incoming.items')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('incoming.items')->with('error', $e->getMessage());
        }
    }

    public function updateStatusItem($id)
    {
        try {
            $this->incomingItemRepository->updateStatusItem($id);
            return redirect()->route('incoming.items')->with('success', 'Data berhasil diverifikasi');
        } catch (\Exception $e) {
            return redirect()->route('incoming.items')->with('error', $e->getMessage());
        }
    }

    public function pdf($headerId) {
        $data = $this->incomingItemRepository->find($headerId)->toArray();
        $pdf = Pdf::loadView('incoming-items/pdf', ['data' => $data]);
        return $pdf->stream('laporan-barang-masuk.pdf');
    }
}
