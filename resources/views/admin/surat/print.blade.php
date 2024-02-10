<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $fileName }}</title>
</head>
<body>
    <script>
        var newWindow = window.open();
        newWindow.document.write('<html><head><title>{{ $fileName }}</title></head><body>');
        newWindow.document.write('<iframe src="data:application/pdf;base64,{{ base64_encode($pdf->output()) }}" type="application/pdf" width="100%" height="600px"></iframe>');
        newWindow.document.write('</body></html>');
        window.location.href = "{{ url('admin/infosurat') }}"; // Redirect ke halaman asal jika perlu
    </script>
</body>
</html>
