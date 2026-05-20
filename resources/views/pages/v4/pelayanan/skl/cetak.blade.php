<!DOCTYPE html>
<html>
<head>
    <title>SKL - {{ $list['show']->ibu }} - {{ $list['tgl'] }}</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="shortcut icon" href="{{ asset('images/logo/onlylogo/logo_dark_verysmall.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/logo/onlylogo/logo_dark_verysmall.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/logo/onlylogo/logo_dark_verysmall.png') }}">
    <meta charset="utf-8">

    <style>
        @page {
            size: F4;
            margin: 12mm 10mm 25mm 10mm;
        }

        body {
            /* position: relative; */
            font-family: "Times New Roman", Times, serif;
            font-size: 15pt;
            margin: 0;
            padding: 0;
            line-height: 1.5;
        }

        .page {
            width: 100%;
        }

        .kop-atas img {
            width: 100%;
        }

        .kop-bawah {
            position: fixed;
            bottom: 0px;
            left: 0;
            right: 0;
            width: 100%;
        }

        .kop-bawah img {
            width: 100%;
            display: block;
        }

        .bismillah img {
            margin-top: 5px;
            width: 25%;
        }

        .title {
            text-align: center;
            /* margin-top: 5px; */
        }

        .title h1 {
            font-size: 14pt;
            margin: 0;
            text-decoration: underline;
        }

        .title h3 {
            font-size: 12pt;
            margin-top: 0px;
        }

        .content {
            margin-top: 5px;
            margin-left: 45px;
            margin-right: 30px;
            font-size: 12pt;
        }

        .content p {
            margin: 0;
            margin-left: 15px;
            margin-bottom: 5px;
            /* margin-top: 5px;
            padding-left: 45px;
            padding-right: 30px; */
            font-size: 12pt;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-left: 50px;
            margin-right: 30px;
            margin-bottom: 5px;
            table-layout: fixed;
        }

        td {
            vertical-align: top;
            font-size: 12pt;
            /* margin-bottom: 5px; */
            /* padding: 12px 0; */

            word-wrap: break-word;
            overflow-wrap: break-word;
            word-break: break-word;
            white-space: normal;
        }

        .label {
            width: 150px;
            /* width: 28%; */
        }

        .separator {
            width: 15px;
            /* width: 3%; */
        }

        .value {
            width: auto;
            /* width: 69%;
            max-width: 69%;
            overflow-wrap: anywhere; */
        }

        .spacer {
            height: 15px;
        }

        .signature {
            width: 100%;
            margin-top: 40px;
        }

        .signature-box {
            font-size: 12pt;
            width: 35%;
            margin-left: auto;
            margin-right: 30px;
            text-align: center;
        }

        .signature-box img {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .doctor-name {
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="page">

    {{-- KOP SURAT --}}
    <div class="kop-atas">
        <img src="{{ asset('/images/pku/kop-new-top.png') }}">
    </div>

    {{-- BISMILLAH --}}
    <div class="bismillah">
        <center><img src="{{ asset('/images/pku/bismillah.png') }}"></center>
    </div>

    {{-- JUDUL --}}
    <div class="title">
        <h1>SURAT KETERANGAN</h1>

        <h3>
            Nomor :
            {{ $list['show']->no_surat }}/KET/IKP/III.6.AU/PKUSKH/{{ $list['thn'] }}
        </h3>
    </div>

    {{-- ISI --}}
    <div class="content">

        <p>
            Telah lahir pada:
        </p>

        <table>
            <tr>
                <td class="label">Hari</td>
                <td class="separator">:</td>
                <td class="value">{{ $list['show']->hari }}</td>
            </tr>

            <tr>
                <td class="label">Tanggal</td>
                <td class="separator">:</td>
                <td class="value">{{ $list['tgl'] }}</td>
            </tr>

            <tr>
                <td class="label">Waktu</td>
                <td class="separator">:</td>
                <td class="value">{{ $list['jam'] }} WIB</td>
            </tr>
        </table>

        {{-- <div class="spacer"></div> --}}

        <p>
            Di Rumah Sakit PKU Muhammadiyah Sukoharjo seorang bayi
            @if($list['show']->kelamin != 'unknown')
                {{ $list['show']->kelamin }}
            @endif
            hidup.
        </p>

        <table>
            <tr>
                <td class="label">NIK Ibu</td>
                <td class="separator">:</td>
                <td class="value">{{ $list['show']->nik_ibu }}</td>
            </tr>

            <tr>
                <td class="label">Nama Ibu</td>
                <td class="separator">:</td>
                <td class="value">{{ $list['show']->ibu }}</td>
            </tr>

            <tr>
                <td class="label">NIK Ayah</td>
                <td class="separator">:</td>
                <td class="value">{{ $list['show']->nik_ayah }}</td>
            </tr>

            <tr>
                <td class="label">Nama Ayah</td>
                <td class="separator">:</td>
                <td class="value">{{ $list['show']->ayah }}</td>
            </tr>

            <tr>
                <td class="label">Alamat</td>
                <td class="separator">:</td>
                <td class="value">{!! nl2br(e($list['show']->alamat)) !!}</td>
            </tr>
        </table>

        <div class="spacer"></div>

        <table>
            <tr>
                <td class="label">Nama Anak</td>
                <td class="separator">:</td>
                <td class="value">{{ $list['show']->anak ?? '-' }}</td>
            </tr>

            <tr>
                <td class="label">Berat Badan</td>
                <td class="separator">:</td>
                <td class="value">{{ $list['show']->bb }} gram</td>
            </tr>

            <tr>
                <td class="label">Panjang Badan</td>
                <td class="separator">:</td>
                <td class="value">{{ $list['show']->tb }} cm</td>
            </tr>
        </table>

    </div>

    {{-- TANDA TANGAN --}}
    <div class="signature">

        <div class="signature-box">

            <p>
                Sukoharjo, {{ $list['tgl'] }}
            </p>

            <p style="margin-top: -10px;">
                Dokter Penanggungjawab
            </p>

            @if ($list['show']->dr == 1)

                <br><br><br>

                <div class="doctor-name">
                    dr. Gede Sri Dhyana M. A., Sp.OG
                </div>

            @elseif ($list['show']->dr == 2)

                <img
                    src="{{ asset('images/pku/kebidanan/ttd-ahmad.png') }}"
                    width="180"
                >

                <div class="doctor-name">
                    dr. H. Ahmad Sutamat, Sp.OG
                </div>

            @elseif ($list['show']->dr == 3)

                <img
                    src="{{ asset('images/pku/kebidanan/ttd-febrian.png') }}"
                    width="140"
                >

                <div class="doctor-name">
                    dr. Febrian Andhika A., Sp.OG
                </div>

            @elseif ($list['show']->dr == 4)

                <br><br><br>

                <div class="doctor-name">
                    dr. Putri Eka Pratiwi, Sp.OG
                </div>

            @endif

        </div>

    </div>

    {{-- KOP SURAT BAWAH --}}
    <div class="kop-bawah">
        <img src="{{ asset('/images/pku/kop-new-bottom.png') }}">
    </div>

</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script>
    window.print();
    window.onafterprint = function() {
        window.close();
    }
    // window.onload = window.print;
    // document_focus = true;
    // win = window.open();
    // Now our event handlers.
    // setInterval(function() { if (document_focus === true) { window.close(); }  }, 300);
</script>

</body>
</html>
