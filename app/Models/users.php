<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class users extends Model
{
    use HasFactory, Loggable, SoftDeletes;

    protected $table = 'users';
    public $timestamps = true;

    protected $fillable = [
        'nip',
        'nik',
        'email',
        'gelar_depan',
        'nama_lengkap',
        'gelar_belakang',
        'nama',
        'name',
        'masuk_kerja',
        'tat',
        'tmt',
        'urutan_masuk',
        'ref_profesi',
        'ref_subprofesi',
        'nick',
        'no_hp',
        'jns_kelamin',
        'temp_lahir',
        'tgl_lahir',
        'status_kawin',

        'ktp_provinsi',
        'ktp_kabupaten',
        'ktp_kecamatan',
        'ktp_kelurahan',
        'alamat_ktp',

        'dom_provinsi',
        'dom_kabupaten',
        'dom_kecamatan',
        'dom_kelurahan',
        'alamat_dom',

        'fb','ig','tt',

        'rp','rpk','ro','rpo',

        // pendidikan
        'sd','smp','sma','d2','d3','d4','s1','s1_profesi','s2','s3',

        'th_sd','th_smp','th_sma','th_d2','th_d3','th_d4',
        'th_s1','th_s1_profesi','th_s2','th_s3',

        // filename ijazah
        'filename_sd','filename_smp','filename_sma',
        'filename_d2','filename_d3','filename_d4',
        'filename_s1','filename_s1_profesi','filename_s2','filename_s3',

        'user_hapus',
    ];
}
