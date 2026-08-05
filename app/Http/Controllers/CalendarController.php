<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\CrmEvent;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        return view('calendar.index');
    }

    public function events()
    {
        $events = [];

        /*
        |--------------------------------------------------------------------------
        | EVENEMENTS CRM
        |--------------------------------------------------------------------------
        */

        foreach (CrmEvent::all() as $event) {

            $events[] = [

                'id' => 'crm_'.$event->id,

                'title' => $event->title,

                'start' => $event->start_date,

                'end' => $event->end_date,

                'allDay' => $event->all_day,

                'backgroundColor' => $event->color ?? '#D4AF37',

                'borderColor' => $event->color ?? '#D4AF37',

                'textColor' => '#fff',

            ];
        }

        /*
        |--------------------------------------------------------------------------
        | LEADS
        |--------------------------------------------------------------------------
        */

        $leads = Lead::with('user')->get();

        foreach ($leads as $lead) {

            /*
            |--------------------------------------------------------------------------
            | RAPPEL
            |--------------------------------------------------------------------------
            */

            if ($lead->rappel_at) {

                $events[] = [

                    'id' => 'rappel_'.$lead->id,

                    'title' => '📞 '.$lead->raison_sociale,

                    'start' => $lead->rappel_at,

                    'backgroundColor' => '#D4AF37',

                    'borderColor' => '#D4AF37',

                    'textColor' => '#111827',

                    'url' => route('leads.show', $lead),

                ];
            }

            /*
            |--------------------------------------------------------------------------
            | VISITE TECHNIQUE
            |--------------------------------------------------------------------------
            */

            if ($lead->vt_at) {

                $events[] = [

                    'id' => 'vt_'.$lead->id,

                    'title' => '🏠 VT - '.$lead->raison_sociale,

                    'start' => $lead->vt_at,

                    'backgroundColor' => '#2563eb',

                    'borderColor' => '#2563eb',

                    'textColor' => '#fff',

                    'url' => route('leads.show', $lead),

                ];
            }

            /*
            |--------------------------------------------------------------------------
            | CHANTIER
            |--------------------------------------------------------------------------
            */

            if ($lead->chantier_at) {

                $events[] = [

                    'id' => 'chantier_'.$lead->id,

                    'title' => '🔨 '.$lead->raison_sociale,

                    'start_date' => $lead->chantier_at,

                    'backgroundColor' => '#16a34a',

                    'borderColor' => '#16a34a',

                    'textColor' => '#fff',

                    'url' => route('leads.show', $lead),

                ];
            }

            /*
            |--------------------------------------------------------------------------
            | SAV
            |--------------------------------------------------------------------------
            */

            if ($lead->sav_at) {

                $events[] = [

                    'id' => 'sav_'.$lead->id,

                    'title' => '🛠 SAV - '.$lead->raison_sociale,

                    'start_date' => $lead->sav_at,

                    'backgroundColor' => '#dc2626',

                    'borderColor' => '#dc2626',

                    'textColor' => '#fff',

                    'url' => route('leads.show', $lead),

                ];
            }

        }

        return response()->json($events);
    }
    public function store(Request $request)
{
    $validated = $request->validate([

        'title' => 'required|max:255',

        'start_date' => 'required|date',

        'end_date' => 'nullable|date',

        'type' => 'required',

        'description' => 'nullable',

        'color' => 'nullable',

        'lead_id' => 'nullable|exists:leads,id',

    ]);

    $event = CrmEvent::create([

        'user_id' => auth()->id(),

        'lead_id' => $validated['lead_id'] ?? null,

        'title' => $validated['title'],

        'description' => $validated['description'] ?? null,

        'type' => $validated['type'],

        'start_date' => $validated['start_date'],

        'end_date' => $validated['end_date'] ?? null,

        'color' => $validated['color'] ?? '#D4AF37',

        'all_day' => false,

    ]);

    return response()->json($event);
}
}