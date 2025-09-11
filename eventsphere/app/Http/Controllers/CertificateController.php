<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use App\Models\Certificate;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    // Organizer generates certificates
    public function generate($eventId)
    {
        $event = Event::findOrFail($eventId);

        if ($event->organizer_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $registrations = Registration::where('event_id', $eventId)->get();

        foreach ($registrations as $registration) {
            if (Certificate::where('event_id', $eventId)->where('student_id', $registration->student_id)->exists()) {
                continue;
            }

            $student = $registration->student;

            $pdf = Pdf::loadView('certificate', [
                'participant' => $student,
                'event' => $event
            ]);

            $fileName = 'certificates/event_'.$eventId.'_student_'.$student->id.'.pdf';
            Storage::put($fileName, $pdf->output());

            Certificate::create([
                'event_id' => $eventId,
                'student_id' => $student->id,
                'certificate_url' => $fileName,
                'issued_on' => now()
            ]);
        }

        return redirect()->back()->with('success', 'Certificates generated successfully!');
    }

    // Participant downloads certificate
    public function download()
    {
        $studentId = Auth::id();
        $certificate = Certificate::where('student_id', $studentId)->latest()->first();

        if (!$certificate || !Storage::exists($certificate->certificate_url)) {
            return back()->with('error', 'Certificate not yet generated.');
        }

        return Storage::download($certificate->certificate_url, 'certificate.pdf');
    }
}
