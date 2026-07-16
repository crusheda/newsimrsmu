@extends('layouts.v4')

@section('content')


<div id="jitsi-container"
style="height:700px">
</div>



<script src="https://meet.jit.si/external_api.js"></script>


<script>


const domain = "meet.jit.si";


const options = {

    roomName:
    "{{ $room }}",


    width:"100%",


    height:700,


    parentNode:
    document.querySelector(
        "#jitsi-container"
    ),


    userInfo:{

        displayName:
        "{{ auth()->user()->name }}"

    }

};



const api =
new JitsiMeetExternalAPI(
    domain,
    options
);



</script>


@endsection
