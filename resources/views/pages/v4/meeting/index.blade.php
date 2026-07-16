@extends('layouts.v4')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1">
                Video Meeting
            </h4>
            <small class="text-muted">
                Daftar meeting SIMRSMU
            </small>
        </div>

        <a href="{{ route('v4.meeting.create') }}"
           class="btn btn-primary">
            <i class="ti ti-video-plus"></i>
            Buat Meeting
        </a>

    </div>


    <div class="card">

        <div class="card-body">


            @if($meetings->count() == 0)

                <div class="text-center py-5">

                    <i class="ti ti-video-off fs-1 text-muted"></i>

                    <h5 class="mt-3">
                        Belum ada meeting
                    </h5>

                    <p class="text-muted">
                        Silahkan buat meeting baru
                    </p>

                </div>


            @else


                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead>
                            <tr>
                                <th width="5%">
                                    No
                                </th>

                                <th>
                                    Judul Meeting
                                </th>

                                <th>
                                    Dibuat Oleh
                                </th>

                                <th>
                                    Waktu
                                </th>

                                <th width="15%">
                                    Aksi
                                </th>
                            </tr>
                        </thead>


                        <tbody>

                        @foreach($meetings as $meeting)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>


                                <td>

                                    <strong>
                                        {{ $meeting->title }}
                                    </strong>

                                    <br>

                                    <small class="text-muted">
                                        {{ $meeting->room_name }}
                                    </small>

                                </td>


                                <td>

                                    {{ $meeting->creator->name ?? '-' }}

                                </td>


                                <td>

                                    {{ $meeting->created_at->format('d-m-Y H:i') }}

                                </td>


                                <td>

                                    <a href="{{ route('v4.meeting.room',$meeting->room_name) }}"
                                       class="btn btn-success btn-sm">

                                        <i class="ti ti-video"></i>
                                        Join

                                    </a>

                                </td>

                            </tr>


                        @endforeach

                        </tbody>


                    </table>

                </div>


            @endif


        </div>

    </div>


</div>


@endsection
