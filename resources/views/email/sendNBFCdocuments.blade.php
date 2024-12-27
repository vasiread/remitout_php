<p>{{ $msg }}</p>

<h3>Here are your documents:</h3>

@foreach($attachments as $attachment)
    <p>
        <strong>{{ $attachment['file_name'] }}:</strong>
        <!-- You can modify this to show a download link if needed -->
        <a href="{{ Storage::disk('s3')->url($attachment['file_name']) }}" target="_blank">View Document</a>
    </p>
@endforeach
