<form method="POST"
action="{{ route('v4.meeting.store') }}">

@csrf


<div class="mb-3">

<label>
Judul Meeting
</label>

<input
class="form-control"
name="title"
placeholder="Rapat IT">

</div>


<button class="btn btn-primary">
Buat Meeting
</button>


</form>
