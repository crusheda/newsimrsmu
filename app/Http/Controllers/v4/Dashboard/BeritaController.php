<?php

namespace App\Http\Controllers\v4\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\berita;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | WEB
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        return view('pages.v4.dashboard.berita.index');
    }

    /*
    |--------------------------------------------------------------------------
    | API - LIST BERITA
    |--------------------------------------------------------------------------
    |
    | GET /api/v4/berita
    |
    | Contoh:
    | /api/v4/berita?page=1&per_page=10
    | /api/v4/berita?page=2&per_page=10
    | /api/v4/berita?per_page=5
    |
    */

    public function indexAPI(Request $request): JsonResponse
    {
        $perPage = (int) $request->get('per_page', 10);

        // Batasi supaya tidak ada request terlalu besar
        $perPage = max(1, min($perPage, 50));

        $berita = Berita::query()
            ->where('is_published', true)
            ->where(function ($query) {
                $query
                    ->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            })
            ->latest('published_at')
            ->latest('id')
            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'message' => 'Data berita berhasil diambil.',
            'data' => $berita->items(),

            'pagination' => [
                'current_page' => $berita->currentPage(),
                'last_page' => $berita->lastPage(),
                'per_page' => $berita->perPage(),
                'total' => $berita->total(),
                'has_more' => $berita->hasMorePages(),
            ],
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | API - DETAIL
    |--------------------------------------------------------------------------
    |
    | GET /api/v4/berita/{id}
    |
    */

    public function show(int $id): JsonResponse
    {
        $berita = Berita::query()
            ->where('is_published', true)
            ->where(function ($query) {
                $query
                    ->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            })
            ->find($id);

        if (!$berita) {
            return response()->json([
                'success' => false,
                'message' => 'Berita tidak ditemukan.',
                'data' => null,
            ], 404);
        }

        // Tambah views
        $berita->increment('views');

        return response()->json([
            'success' => true,
            'message' => 'Detail berita berhasil diambil.',
            'data' => $berita->fresh(),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | API - STORE
    |--------------------------------------------------------------------------
    |
    | POST /api/v4/berita
    |
    */

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'judul' => [
                'required',
                'string',
                'max:255',
            ],

            'ringkasan' => [
                'nullable',
                'string',
            ],

            'isi' => [
                'required',
                'string',
            ],

            'penulis' => [
                'nullable',
                'string',
                'max:255',
            ],

            'gambar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'gambar_lampiran_1' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'gambar_lampiran_2' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'gambar_lampiran_3' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'gambar_lampiran_4' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'gambar_lampiran_5' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'is_published' => [
                'nullable',
                'boolean',
            ],

            'published_at' => [
                'nullable',
                'date',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | SLUG
        |--------------------------------------------------------------------------
        */

        $slug = Str::slug($validated['judul']);

        $originalSlug = $slug;
        $counter = 1;

        while (
            Berita::withTrashed()
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter++;
        }

        /*
        |--------------------------------------------------------------------------
        | DATA
        |--------------------------------------------------------------------------
        */

        $data = [
            'judul' => $validated['judul'],
            'slug' => $slug,
            'ringkasan' => $validated['ringkasan'] ?? null,
            'isi' => $validated['isi'],
            'penulis' => $validated['penulis'] ?? null,

            'is_published' => $request->boolean(
                'is_published',
                true
            ),

            'published_at' =>
                $validated['published_at'] ?? now(),

            'views' => 0,
        ];

        /*
        |--------------------------------------------------------------------------
        | GAMBAR UTAMA
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('gambar')) {
            $data['gambar'] =
                $this->uploadBeritaImage(
                    $request->file('gambar')
                );
        }

        /*
        |--------------------------------------------------------------------------
        | LAMPIRAN 1 - 5
        |--------------------------------------------------------------------------
        */

        for ($i = 1; $i <= 5; $i++) {
            $field = "gambar_lampiran_{$i}";

            if ($request->hasFile($field)) {
                $data[$field] =
                    $this->uploadBeritaImage(
                        $request->file($field)
                    );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | SIMPAN
        |--------------------------------------------------------------------------
        */

        $berita = Berita::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil disimpan.',
            'data' => $berita,
        ], 201);
    }

    /*
    |--------------------------------------------------------------------------
    | API - UPDATE
    |--------------------------------------------------------------------------
    |
    | POST /api/v4/berita/{id}
    |
    */

    public function update(
        Request $request,
        int $id
    ): JsonResponse {
        $berita = Berita::find($id);

        if (!$berita) {
            return response()->json([
                'success' => false,
                'message' => 'Berita tidak ditemukan.',
            ], 404);
        }

        $validated = $request->validate([
            'judul' => [
                'required',
                'string',
                'max:255',
            ],

            'ringkasan' => [
                'nullable',
                'string',
            ],

            'isi' => [
                'required',
                'string',
            ],

            'penulis' => [
                'nullable',
                'string',
                'max:255',
            ],

            'gambar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'gambar_lampiran_1' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'gambar_lampiran_2' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'gambar_lampiran_3' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'gambar_lampiran_4' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'gambar_lampiran_5' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'hapus_gambar' => [
                'nullable',
                'boolean',
            ],

            'hapus_gambar_lampiran_1' => [
                'nullable',
                'boolean',
            ],

            'hapus_gambar_lampiran_2' => [
                'nullable',
                'boolean',
            ],

            'hapus_gambar_lampiran_3' => [
                'nullable',
                'boolean',
            ],

            'hapus_gambar_lampiran_4' => [
                'nullable',
                'boolean',
            ],

            'hapus_gambar_lampiran_5' => [
                'nullable',
                'boolean',
            ],

            'is_published' => [
                'nullable',
                'boolean',
            ],

            'published_at' => [
                'nullable',
                'date',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | SLUG
        |--------------------------------------------------------------------------
        */

        if ($berita->judul !== $validated['judul']) {
            $slug = Str::slug($validated['judul']);

            $originalSlug = $slug;
            $counter = 1;

            while (
                Berita::withTrashed()
                    ->where('slug', $slug)
                    ->where('id', '!=', $berita->id)
                    ->exists()
            ) {
                $slug = $originalSlug . '-' . $counter++;
            }

            $berita->slug = $slug;
        }

        /*
        |--------------------------------------------------------------------------
        | GAMBAR UTAMA
        |--------------------------------------------------------------------------
        */

        if ($request->boolean('hapus_gambar')) {
            $this->deleteBeritaImage(
                $berita->gambar
            );

            $berita->gambar = null;
        }

        if ($request->hasFile('gambar')) {
            $this->deleteBeritaImage(
                $berita->gambar
            );

            $berita->gambar =
                $this->uploadBeritaImage(
                    $request->file('gambar')
                );
        }

        /*
        |--------------------------------------------------------------------------
        | LAMPIRAN
        |--------------------------------------------------------------------------
        */

        for ($i = 1; $i <= 5; $i++) {
            $field = "gambar_lampiran_{$i}";
            $deleteField = "hapus_gambar_lampiran_{$i}";

            /*
            | Hapus attachment
            */

            if ($request->boolean($deleteField)) {
                $this->deleteBeritaImage(
                    $berita->{$field}
                );

                $berita->{$field} = null;
            }

            /*
            | Upload attachment baru
            */

            if ($request->hasFile($field)) {
                $this->deleteBeritaImage(
                    $berita->{$field}
                );

                $berita->{$field} =
                    $this->uploadBeritaImage(
                        $request->file($field)
                    );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | DATA
        |--------------------------------------------------------------------------
        */

        $berita->judul =
            $validated['judul'];

        $berita->ringkasan =
            $validated['ringkasan'] ?? null;

        $berita->isi =
            $validated['isi'];

        $berita->penulis =
            $validated['penulis'] ?? null;

        $berita->is_published =
            $request->boolean(
                'is_published',
                true
            );

        $berita->published_at =
            $validated['published_at'] ?? null;

        $berita->save();

        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil diubah.',
            'data' => $berita->fresh(),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | API - DELETE
    |--------------------------------------------------------------------------
    |
    | DELETE /api/v4/berita/{id}
    |
    */

    public function destroy(int $id): JsonResponse
    {
        $berita = Berita::find($id);

        if (!$berita) {
            return response()->json([
                'success' => false,
                'message' => 'Berita tidak ditemukan.',
            ], 404);
        }

        /*
        |--------------------------------------------------------------------------
        | Hapus gambar utama
        |--------------------------------------------------------------------------
        */

        $this->deleteBeritaImage(
            $berita->gambar
        );

        /*
        |--------------------------------------------------------------------------
        | Hapus semua lampiran
        |--------------------------------------------------------------------------
        */

        for ($i = 1; $i <= 5; $i++) {
            $field = "gambar_lampiran_{$i}";

            $this->deleteBeritaImage(
                $berita->{$field}
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Soft Delete
        |--------------------------------------------------------------------------
        */

        $berita->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil dihapus.',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER
    |--------------------------------------------------------------------------
    */

    private function uploadBeritaImage(
        \Illuminate\Http\UploadedFile $file
    ): string {
        return $file->store(
            'berita',
            'public'
        );
    }

    private function deleteBeritaImage(
        ?string $path
    ): void {
        if (!$path) {
            return;
        }

        $path = ltrim($path, '/');

        if (
            Storage::disk('public')
                ->exists($path)
        ) {
            Storage::disk('public')
                ->delete($path);
        }
    }
}
