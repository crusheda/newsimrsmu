<?php

namespace App\Http\Controllers\v4\Kalender;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\CarbonPeriod;
use App\Models\eruang_ref;
use App\Models\eruang;
use Carbon\Carbon;
use Auth, DB;
use Validator,Redirect,Response,File,Storage;

class KalenderController extends Controller
{
    function index()
    {
        return view('pages.v4.kalender.index');
    }

    function dataKalender()
    {
        // Mapping warna berdasarkan id_ruangan
        $colors = [
            1 => '#007bff', // Aula Ahmad Dahlan
            2 => '#28a745', // Perpustakaan
            3 => '#ffc107', // Komite Medik
            4 => '#dc3545', // Ruang Direksi
        ];

        // include relasi ruangan
        $data = eruang::with('ruangan')
                        ->leftJoin('users','eruang.id_user','=','users.id')
                        ->select('eruang.*','users.nama as nama_user')
                        ->whereNull('eruang.deleted_at')
                        ->whereNull('eruang.status_penolakan')
                        ->get();

        $events = [];

        foreach ($data as $row) {

            $color = $colors[$row->id_ruangan] ?? '#6c757d'; // default abu-abu

            $start = $row->tgl . 'T' . ($row->jam_mulai ?? '00:00:00');
            $end   = $row->tgl . 'T' . ($row->jam_selesai ?? $row->jam_mulai ?? '00:00:00');

            $events[] = [
                'id'    => $row->id,
                'title' => $row->agenda, // . ' (' . ($row->ruangan->nama ?? '-') . ')',

                'start' => $start,
                'end'   => $end,

                'color' => $color,
                'textColor' => '#fff',

                'extendedProps' => [
                    'ruangan'    => $row->ruangan->nama ?? '-',
                    'ket'        => $row->ket,
                    'added_by'   => $row->nama_user,
                    'jam_mulai'  => $row->jam_mulai,
                    'jam_selesai'=> $row->jam_selesai,
                    'added_at'   => $row->created_at,
                ],
            ];
        }

        return response()->json($events);
    }

    function tambahKalender(Request $request)
    {
        DB::table('events')->insert([
            'title' => $request->title,
            'start' => $request->start,
        ]);
        return response()->json(['success' => true]);
    }
}
