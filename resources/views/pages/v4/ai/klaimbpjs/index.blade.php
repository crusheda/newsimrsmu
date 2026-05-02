<!DOCTYPE html>
<html>
<head>
    <title>AI Klaim BPJS</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: Arial; margin: 40px; }
        textarea { width: 100%; margin-bottom: 10px; }
        button { padding: 10px 20px; }
        pre { background: #f4f4f4; padding: 10px; }
    </style>
</head>
<body>

<h2>AI Assist Klaim BPJS</h2>

<label>Diagnosa</label>
<textarea id="diagnosa" rows="3"></textarea>

<label>Tindakan</label>
<textarea id="tindakan" rows="3"></textarea>

<button onclick="kirim()">Analisa AI</button>

<h3>Hasil:</h3>
<pre id="hasil">-</pre>

<script>
function kirim() {
    let diagnosa = document.getElementById('diagnosa').value;
    let tindakan = document.getElementById('tindakan').value;

    fetch('/api/v4/ai/bpjs/klaim/coder', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            diagnosa: diagnosa,
            tindakan: tindakan
        })
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById('hasil').innerText = JSON.stringify(data, null, 2);
    })
    .catch(err => {
        document.getElementById('hasil').innerText = 'Error: ' + err;
    });
}
</script>

</body>
</html>